@extends('layouts.admin')

@section('content')
<p>分类列表</p>
<div class="cl pd-5 bg-1 bk-gray mt-20">  <a href="{{route('categories.create')}}"  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类 </a></span></div>
    <div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="80">ID</th>
				 <th width="400">分类名称</th>
				<!--<th width="40">性别</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="">地址</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th> -->
				<th>属性</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($categories as $category)
			<tr class="text-c">
				
				<td>{{$category['id']}}</td>
				<td class="text-l">{{$category['name']}} </td>
				<td><a href="{{route('attributes.index', ['category' => $category['id']])}}">属性管理 [{{$category['attributes_count']}}]</a></td>
				
				<td class="td-manage"><a title="编辑" href="{{route('categories.edit', $category['id'])}}"  class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">修改   | </i></a> <a data-type='delete' data-url="{{route('categories.destroy', $category['id'])}}" title="删除" href="javascript:;" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">删除</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>

@endsection
@section('js')
    <script type="text/javascript" src="{{asset('js/h-ui/WdatePicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/h-ui/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/h-ui/jquery.dataTables.min.js')}}"></script>
    <script>
    	$(function(){
    		$("a[data-type=delete]").on('click', function(){
    			var url = $(this).data('url');
    			$.ajax({
    				url:url,
    				type:'delete',
    				success:function(data){
    					location.reload();
    				}
    			});
    		});
    	});
    </script>	
@endsection