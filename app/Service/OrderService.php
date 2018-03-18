<?php
namespace App\Service ;
use App\Models\OrderInfo;
use Illuminate\Http\Request ;
use Auth ;
use Carbon\Carbon ;

class OrderService
{
	/*private $carts ;

	public function __construct()
	{
		//$this->carts = Auth::user()->carts ;
		dump(Auth::user()->carts);
	}
*/
    //获取订单列表
	public function getOrderList($request)
	{
		$where =  [] ;

		foreach($request->all() as $k => $value)
		{
			if(strlen(trim($value)))
			{   if($k == 'daterange')
				{
					$where[$k] = $this->makeRange($value);
					continue ;
				}
				$where[$k] = $value ;
			}
		}
		if(Auth::guard('admin')->user())
		{
			return OrderInfo::filter($where)->with('user')->orderBy('created_at', 'desc')->paginate();
		}
		return Auth::user()->orders()->filter($where)->orderBy('created_at', 'desc')->paginate();
	}
    
    //创建订单
	public function createOrder($request)
	{
		$order['order_sn'] = $this->generate_order_sn();
		$order['address_id'] = $request->address_id ;
		$order['order_amount'] = $this->getAmount() ;
		//dump($order);
		$orderInfo = Auth::user()->orders()->create($order); 
		$this->createOrderProduct($orderInfo);
		return $orderInfo ;
	}

	private function getAmount()
	{
		$amount = 0 ;
		foreach(Auth::user()->carts as $cart)
		{
			$amount += $cart->number * $cart->price ;
		}
		return $amount ;
	}

	private function generate_order_sn()
	{
		return date('YmdHis', time());
	}

	private function createOrderProduct($orderinfo)
	{
		foreach(Auth::user()->carts as $k => $cart)
		{
			$product[$k] = $cart->toArray();
		}
		$orderinfo->orderproducts()->createMany($product);
		$this->clearCart();
	}

	private function clearCart()
	{
		Auth::user()->carts()->delete() ;
	}

    private function makeRange($number)
    {
    	$now =  Carbon::now() ;
    	//$now = $dt->toDateTimeString(); 
    	$end = Carbon::now()->subMonths($number);
    	return [$now, $end] ;
    }
}