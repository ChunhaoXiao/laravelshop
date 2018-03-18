@extends('layouts.admin')
@section('content')
<p>
  <!-- <form class="form-inline col-sm-offset-4">
      <div class="form-group">
        <select name="category" class="form-control"><option>dfsgdfs</option></select>
      </div>
      <div class="form-group">
        
        <input name="keywords" class="form-control" size="10" placeholder="关键字">
      </div>
      <div class="form-group">
        
        <input name="product_sn" class="form-control" size="10" placeholder="商品编号">
      </div>
      <div class="form-group">
        
        <input name="start_price" class="form-control" size="6" placeholder="起始价">
      </div>-
      <div class="form-group">
       
        <input name="end_price" class="form-control" size="6" placeholder="结束价">
      </div>
      <div class="form-group"><input type="submit" value="搜索" class="btn btn-default"></div>
  </form> -->
</p>
   <table id="example2" class="table table-bordered table-hover">
        <tr class="bg-info"><td colspan="2">订单信息</td></tr>
        <tr>
          <td class="text-right">订单号</td>
          <td>{{$order->order_sn}}</td>
          <td class="text-right">订单状态</td>
          <td>{{$order->status()}}</td>
        </tr>
        <tr>
          <td class="text-right">会员名称</td>
          <td>{{$order->user->name}}</td>
          <td class="text-right">创建时间</td>
          <td>{{$order->created_at}}</td>
        </tr>
        <tr>
          <td class="text-right">支付方式</td>
          <td></td>
          <td class="text-right">支付时间</td>
          <td></td>
        </tr>
        <tr>
          <td class="text-right">收货人</td>
          <td>{{$order->address->name}}</td>
          <td class="text-right">收货地址</td>
          <td>{{$order->address->province}}{{$order->address->city}}{{$order->address->district}}{{$order->address->detail_address}}</td>
        </tr>
        <tr>
          <td class="text-right">联系电话</td>
          <td>{{$order->address->phone}}</td>
        </tr>
   </table>  

   <table class="table table-bordered table-hover">
    <tr class="bg-info">
      <td colspan="6">商品信息</td>

    </tr>
    <tr>
      <th>商品名称</th>
      <th>货号</th>
      <th>价格</th>
      <th>数量</th>
      <th>属性</th>
      <th>小计</th>
    </tr>
    @foreach($products as $product)
    <tr>
      <td>{{$product->product->name}}</td>
      <td>{{$product->product->product_sn}}</td>
      <td>{{$product->price}}</td>
      <td>{{$product->number}}</td>
      <td>{{$product->product_attribute}}</td>
      <td>{{$product->price * $product->number}}</td>
    </tr>
    @endforeach
    <tr><td class="text-right" colspan="6">共计：<strong>{{$order->order_amount}}</strong></td></tr>
   </table>     
   <form method="post" action="{{ route('order.update', $order) }}">
   <table class="table">
       <tr class="bg-info"><td colspan="2">修改订单状态</td></tr>
       <tr>
        <td class="text-right">订单状态</td>
        <td>
          <select name="order_status" class="forn-control">
              @foreach(config('app.order_status') as $k => $status)
                <option value="{{$k}}"> {{$status}} </option>
              @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <td class="text-right">备注</td>
        <td> <textarea rows="3" cols="10" name="note" class="form-control"> </textarea></td>
      </tr>
      {{csrf_field()}}
      {{method_field('PUT')}}
      <tr><td></td><td><button>确定</button></td></tr>
   </table>     	
@endsection
@section('js')
<script>
  $("a[data-type='delete']").on('click', function(){
    var url = $(this).data('url');
    $.ajax({
      url:url,
      type:'delete',
      success:function(data){
        console.log(data);
      }
    });

  });
</script>
@endsection