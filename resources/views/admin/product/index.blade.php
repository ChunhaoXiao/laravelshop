@extends('layouts.admin')
@section('content')
<p>商品列表</p>
<p>
  <form class="form-inline col-sm-offset-1">
      <div class="form-group">
        @inject('category', 'App\Service\CategoryService')
        <select name="category" class="form-control">
           <option value="">分类</option> 
          @foreach($category->categoryTree() as $cate)
            <option value="{{$cate['id']}}">{{$cate['name']}}</option>
          @endforeach
        </select>
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
  </form>
</p>
   <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th><input type="checkbox"></th>	
          <th>商品编号</th>
          <th>缩略图</th>
          <th>商品名称</th>
          <th>所属分类</th>
          <th>售价</th>
          <th>虚拟销量</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
            	<td><input type="checkbox" value="{{$product->id}}"></td>
              <td>{{$product->product_sn}}</td>
            	<td><img width="100" height="100" src="{{asset('Storage/'.$product->thumb)}}"></td>
            	<td>{{$product->name}}</td>
            	<td>{{$product->category->name}}</td>
            	<td>{{$product->price}}</td>
            	<td>{{$product->sales}}</td>
            	<td><a href="{{route('products.edit',$product)}}">修改</a> <a href="javascript:;" data-type="delete" data-url="{{ route('products.destroy',$product) }}">删除</a></td>
            </tr>
        @endforeach 	
        <tr>
        </tr>
        </tbody>	
    </table>            	
@endsection
@section('js')
<script>
  $("a[data-type='delete']").on('click', function(){
    var url = $(this).data('url');
    var tr = $(this).parent().parent();
    $.ajax({
      url:url,
      type:'delete',
      success:function(data){
        console.log(data);
        $(tr).remove();

      }
    });

  });
</script>
@endsection