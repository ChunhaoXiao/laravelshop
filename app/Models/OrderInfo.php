<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\OrderUpdated ;

class OrderInfo extends Model
{
    protected $fillable = ['order_sn', 'user_id', 'order_status', 'shipping_status', 'pay_status', 'user_note', 'consignee', 'address_id', 'mobile', 'pay_name', 'order_amount'] ;

    protected $dispatchesEvents = [
        'updated' => OrderUpdated::class,
    ] ;

    public function orderproducts()
    {
    	return $this->hasMany('App\Models\OrderProduct','orderinfo_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function status()
    {
        $status = config('app.order_status');
        return $status[$this->order_status];
    }

   
    function scopeFilter($query, $where)
    {
        if(isset($where['daterange']))
        {
            $query = $query->whereDate('created_at', '<' , $where['daterange'][0])->whereDate('created_at', '>', $where['daterange'][1]);
        }

        if(isset($where['order_sn']))
        {
            $query->where('order_sn', 'like', $where['order_sn'].'%');
        }

        if(isset($where['order_status']))
        {
            $query = $query->where('order_status', $where['order_status']);
        }

        if(isset($where['username']))
        {
            $query = $query->whereHas('user', function($query) use ($where){
                $query->where('name', $where['username']);
            }) ;
        }

        if(isset($where['consignee']))
        {
            $query = $query->whereHas('address', function($query) use($where){
                $query->where('name', $where['consignee']);
            });
        }
        
        return $query ;
    }


   /* public function add($request)
    {
    	$amount = 0 ;
    	foreach($request->user()->carts as $k=>  $cart)
    	{
    		$amount += $cart->number * $cart->price ;
    		$order_product[$k]['product_id'] =  $cart->product_id;
    		$order_product[$k]['product_number'] = $cart->number ;
    		$order_product[$k]['product_attribute'] = $cart->product_attribute;

    	}
    	$data['order_amount'] = $amount ;
    	$data['address'] = $request->address;
    	$data['order_sn'] = $this->order_sn();
    	//return static::create($data);
    	//$this->ordergoods()->createMany([]);
        $order = $request->user()->orders()->create($data);
        $order->orderproducts()->createMany($order_product);
    }*/

    
}
