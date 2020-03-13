@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>


        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @forelse($orders as $key => $order)
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse{{$key}}" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                    Pedido nº: {{$order->reference}}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif"
                             aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                               <ul class="">
{{--                                   <dd>{{$order}}</dd>--}}
{{--                                   @php $items = unserialize($order->items); @endphp--}}
                                   @php $total = 0;@endphp
                                   @foreach(filterItemsByStoreId($items = unserialize($order->items), auth()->user()->store->id) as $item)

                                       <dd><strong>Produto: </strong>{{$item['name']}} | R$ {{number_format($item['price'], 2, ',', '.')}}</dd>
                                       <dd><strong>Quantidade:</strong> {{$item['amount']}} | <strong>Total do produto:</strong> R$ {{number_format($item['price'] * $item['amount'], 2, ',', '.')}}</dd>
                                       <br>
                                       @php $total += $item['amount'] * $item['price'];@endphp
                                   @endforeach
                                   <dd><strong>Total Geral: </strong>R$ {{number_format($total, 2, ',', '.')}}</dd>
                               </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">
                        Nenhum pedido recebido!.
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-12">
            <hr>
            {{$orders->links()}}
        </div>
    </div>
@endsection
