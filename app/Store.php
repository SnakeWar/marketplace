<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'description', 'slug', 'phone', 'mobile_phone', 'logo'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id');
    }
    public function notifyStoreOwners(array $storeId = [])
    {
        $stores = $this->whereIn('id', $storeId)->get();

        $stores->map(function ($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}
