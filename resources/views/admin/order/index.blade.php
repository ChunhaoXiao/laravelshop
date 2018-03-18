@extends('layouts.admin')
@section('content')
<p>
  <form class="form-inline col-sm-offset-1">
      <!-- <div class="form-group">
        <select name="category" class="form-control"><option>dfsgdfs</option></select>
      </div> -->
      <div class="form-group">
        
        <input name="order_sn" class="form-control" size="10" placeholder="订单号">
      </div>
      <div class="form-group">
        
        <input name="username" class="form-control" size="10" placeholder="会员名称">
      </div>
      <div class="form-group">
        
        <input name="consignee" class="form-control" size="10" placeholder="收货人">
      </div>

      <div class="form-group">
        <select name="order_status" class="form-control">
          <option value="">订单状态</option> 
          @foreach(config('app.order_status') as $k => $v)
            <option value="{{$k}}">{{$v}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group"><input type="submit" value="搜索" class="btn btn-primary"></div>
  </form>
</p>
   <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th><input type="checkbox"></th>	
          <th>订单编号</th>
          <th>所属会员</th>
          <th>订单状态</th>
          <th>订单金额</th>
          <th>创建时间</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
       @foreach($orders as $order) 	
        <tr>
          <td><input type="checkbox"></td>
          <td><a href="{{route('order.show', $order)}}">{{$order->order_sn}}</a></td>
          <td>{{$order->user->name}}</td>
          <td>{{$order->status()}}</td>
          <td>{{$order->order_amount}}</td>
          <td>{{$order->created_at}}</td>
        </tr>
       @endforeach 
        </tbody>	
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