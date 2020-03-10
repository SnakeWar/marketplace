<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use PagSeguro\Services\Session;
use PagSeguro\Configuration\Configure;
use App\Payment\PagSeguro\CreditCard;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!auth()->check()) {
            return redirect()->route('login');
        }

        if(!session()->has('cart')) return redirect()->route('home');

        $this->makePagSeguroSession();

        $cartItems = array_map(function ($line){
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

//        dd($cartItems);

        var_dump(session()->get('pagseguro_session_code'));

        return  view('checkout', compact('cartItems'));
    }

    public function process(Request $request)
    {

        try{

            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = 'XPTO';

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

//        var_dump($result);
            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'store_id' => 1,
            ];
            $userOrder = $user->orders()->create($userOrder);

            $userOrder->stores()->sync($stores);

            //Notificar loja de novo pedido

            $store = (new Store())->notifyStoreOwners($stores);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference,
                ]
            ]);

        }catch (\Exception $e){

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message,
                ]
            ], 401);
        }

    }

    public function thanks()
    {
        return view('thanks');
    }

    private function makePagSeguroSession()
    {
//        if(!session()->has('pagseguro_session_code')){

            $sessionCode = Session::create(
                Configure::getAccountCredentials()
            );

            return session()->put('pagseguro_session_code', $sessionCode->getResult());

//        }
    }
}
