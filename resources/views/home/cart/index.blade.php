@extends('layouts.home')


@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container">
            <div class="container">
                <div class="cart-area ptb-60">
                    <div class="container">
                        <div class="cart-wrapper">
                            <div class="cart-price">
                                <h5 class="t-uppercase mb-20">购物车总价</h5>
                                <ul class="panel mb-20">
                                    <li>
                                        <div class="item-name">
                                            <strong class="t-uppercase">订单总价</strong>
                                        </div>
                                        <div class="price">
                                            <span id="cars_price">
                                                0
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="t-right">
                                    <!-- Checkout Area -->
                                    <section class="section checkout-area panel prl-30 pt-20 pb-40">
                                        <h2 class="h3 mb-20 h-title">支付信息</h2>
                                        @if (session()->has('status'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form class="mb-30" method="post" action="{{ route('orders.store') }}">
                                            {{ csrf_field() }}

                                            <div class="row">

                                                @if ($errors->has('address_id'))
                                                    <div class="alert alert-danger" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        {{ $errors->first('address_id') }}
                                                    </div>
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>选择收货地址</label>
                                                        <select class="form-control" name="address_id">
                                                            <option value="">请选择收货地址</option>
                                                            @if (Auth::check())
                                                                @foreach (Auth::user()->addresses as $address)
                                                                    <option value="{{ $address->id }}">{{ $address->name }}/{{ $address->phone }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            @auth
                                            <button type="submit"  class="btn btn-lg btn-rounded mr-10">下单</button>
                                            @endauth
                                            @guest
                                            <a href="{{ url('login') }}?redirect_url={{ url()->current() }}"  class="btn btn-lg btn-rounded mr-10">下单</a>
                                            @endguest
                                        </form>
                                    </section>
                                </div>
                            </div>
                            <h3 class="h-title mb-30 t-uppercase">我的购物车</h3>
                            <table id="cart_list" class="cart-list mb-30">
                                <thead class="panel t-uppercase">
                                <tr>
                                    <th>商品名字</th>
                                    <th>商品属性</th>
                                    <th>商品价格</th>
                                    <th>数量</th>
                                    <th>删除</th>
                                </tr>
                                </thead>
                                <tbody id="cars_data">
                                @foreach ($carts as $key => $car)
                                <tr class="panel alert">
                                    <td>
                                        {{ $car['product']['name'] }}
                                                
                                    </td>
                                    <td>{{$car['product_attribute']}}</td>
                                    <td class="prices">{{ $car['price'] }}</td>
                                    <td>
                                        <input class="quantity-label" type="number" value="{{ $car['number'] }}">
                                    </td>

                                    <td>
                                        <input type="hidden" name="cartkey" value="{{$key}}">
                                        <button data-id="" class="close delete_car" type="button" 
                                        @auth
                                             data-url="{{route('cart.destroy',['cart'=>$car['id']])}}" 
                                         @else
                                            data-url="{{route('cart.destroy',['cart'=>$key])}}"
                                         @endauth>
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection

@section('script')
    <!-- <script src="{{ asset('assets/user/layer/2.4/layer.js') }}"></script> -->
    <script>

        $('.delete_car').click(function () {
            var that = $(this);

            var cartkey = $(this).parent().find("input[type='hidden']").val();
           //var id = that.data('id');
            var _url = $(this).data('url');
           // alert(_url);
            $.post(_url, {cartkey:cartkey}, function(res){
                //if (res.code == 302) {
                    //localStorage.removeItem(id);
                //}
                console.log(res);
                that.parent().parent().remove();
                //getTotal();
            });
        });

    </script>
@endsection