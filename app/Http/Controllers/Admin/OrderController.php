<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\OrderService ;
use App\Models\OrderInfo ;

class OrderController extends Controller
{
    //
    private $OrderService ;

    public function __construct(OrderService $OrderService)
    {
    	$this->OrderService = $OrderService ;
    }

    public function index(Request $request)
    {
    	$orders = $this->OrderService->getOrderList($request);
    	return view('admin.order.index', ['orders' => $orders]) ;
    }

    public function show(OrderInfo $order)
    {
    	$products = $order->orderproducts()->with('product')->get();
    	return view('admin.order.show', ['order' => $order, 'products'=>$products]);
    }

    public function update(Request $request, OrderInfo $order)
    {
        $order->update(['order_status' => $request->order_status]);
    }
}
