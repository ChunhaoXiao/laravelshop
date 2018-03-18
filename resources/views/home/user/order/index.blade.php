@extends('layouts.user')


@section('style')
   <!--  <style>
        th, td {
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px 10px;
        }
        td a.uuid {
            color: #00a0e9;
        }
    </style> -->
@endsection

@section('main')
    <div class="main-wrap">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单列表</strong> / <small>Electronic&nbsp;bill</small></div>
        </div>
       

        

       <!--  <div class="order-time">
            <label class="form-label">交易时间：</label>
            <div class="show-input">
                <select class="am-selected" data-am-selected>
                    <option value="today">今天</option>
                    <option value="sevenDays" selected="">最近一周</option>
                    <option value="oneMonth">最近一个月</option>
                    <option value="threeMonths">最近三个月</option>
                    <option class="date-trigger">自定义时间</option>
                </select>
            </div>
            <div class="clear"></div>
        </div> -->
        <form method="get" action="{{ route('orders.index') }}">
        <ul class="list-inline">
            <li>日期范围</li>

            <li>
                <select class="form-control" name="daterange">
                    <option value="">全部</option>
                    <option value="1">最近一个月</option>
                    <option value="3">最近三个月</option>
                    <option value="6">最近半年</option>
                    
                </select>
            </li>
            <li>订单状态：</li>
            <li><select class="form-control" name="order_status">
                <option value="">全部</option> 
                @foreach(config('app.order_status') as $key=> $status)
                    <option value="{{$key}}">{{$status}}</option>
                @endforeach
            </select></li>
            <li><input class="btn btn-default" type="submit" value="搜索"> </li>
        </ul>
        </form>

        
        <table class="table table-bordered">

            <thead>
            <tr>
                <th class="time">订单编号</th>
                <th class="name">创建时间</th>
                <th>订单状态</th>
                <th class="amount">金额</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr style="padding-left: 20px;">
                        <td class="time">
                            <p>
                                <a class="uuid" href="{{ url("/user/orders/{$order->id}") }}">{{ $order->order_sn }}</a>
                            </p>
                        </td>
                        <td class="title name">
                            <p class="content">
                                {{ $order->created_at }}
                            </p>
                        </td>
                        <td>{{$order->status()}}</td>

                        <td class="amount">
                            <span class="amount-pay">{{ $order->order_amount }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection