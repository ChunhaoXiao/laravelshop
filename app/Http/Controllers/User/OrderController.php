<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\OrderInfo ;
use App\Service\OrderService ;
use Pay ;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $OrderService ;
    public function __construct(OrderService $OrderService)
    {
        $this->middleware('auth');
        $this->middleware('checkaddress')->only('store');
        $this->OrderService = $OrderService ;

    }
    public function index(Request $request)
    {
        $orders = $this->OrderService->getOrderList($request);
        return view('home.user.order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order =  $this->OrderService->CreateOrder($request);
        return Pay::alipay()->web([
            'out_trade_no' => $order->order_sn,
            'total_amount' => $order->order_amount,
            'subject' => '商品支付',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OrderInfo $order)
    {
        $orderProduct = $order->orderproducts()->with('product')->get();
        return view('home.user.order.show', ['order'=> $order, 'orderproduct' => $orderProduct]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
