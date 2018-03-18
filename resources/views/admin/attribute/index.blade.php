@extends('layouts.admin')
@section('content')
<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="{{route('attributes.create',['category'=>$category])}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加属性</a></span>  </div>
    <div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="80">ID</th>
				 <th width="100">属性名称</th>
				<th width="100">字段类型</th>
				<th width="100">属性类型</th>
				<th width="150">属性值</th>
				<th width="100">索引类型</th>
				<th width="60">排序</th>
				<th width="70">分组</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($attributes as $attribute)
			<tr class="text-c">
				
				<td>{{$attribute->id}}</td>
				<td class="text-l">{{$attribute->name}}</td>
				<td>{{$attribute->input_type()}}</td>
				<td>{{$attribute->attribute_type()}}</td>
				<td>{{$attribute->attribute_value}}</td>
				<td>{{$attribute->attribute_index()}}</td>
				<td>{{$attribute->sort_order}}</td>
				<td>{{$attribute->group}}</td>
				
				<td class="td-manage"><a title="编辑" href="{{route('attributes.edit', $attribute)}}"  class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">修改</i> </a>    | <a data-type='delete' data-url="{{route('attributes.destroy', $attribute)}}" title="删除"  class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">删除</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@endsection	
@section('js')
<script>
    $("a[data-type='delete']").on('click', function(){
    	var url = $(this).data('url');
    	var obj = $(this).parents('tr').first();
    	$.ajax({
    		url:url,
    		type:'delete',
    		success:function(data){
    			$(obj).remove();
    		}
    	});

    });
</script>
@endsection