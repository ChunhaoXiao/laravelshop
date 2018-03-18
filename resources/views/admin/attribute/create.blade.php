@extends('layouts.admin')
@section('content')

    <form class="form form-horizontal" action="{{route('attributes.store')}}"  method="post">
		<div class="form-group">
			<label class="control-label col-sm-2">属性名称：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  name="name">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">字段类型：</label>
			<div class="col-sm-5">
				
				<select name="input_type" class="form-control">
					<option value="1">文本字段</option>
					<option value="2">下拉列表</option>
					<option value="3">多行文本</option>
				</select>
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-2">属性类型：</label>
			<div class="col-sm-5">
				<select class="form-control" name="attribute_type">
					<option value="0">单独属性</option>
					<option value="1">可选属性</option>
				</select>	
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">属性可选值：</label>
			<div class="col-sm-5">
				<textarea rows="5" class="form-control" name="attribute_value"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">属性索引：</label>
			<div class="col-sm-5">
				<select name="attribute_index" class="form-control">
					<option value="0">不可以检索</option>
					<option value="1">关键字检索</option>
					<option value="2">范围检索</option>
				</select>	
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">排序：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="0"  name="sort_order">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">分组：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="0"  name="group">
			</div>
		</div>
		{{csrf_field()}}
		<input type="hidden" name="category" value="{{$category}}">
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"> 确定 </button>
				
			</div>
		</div>
	</form>
@endsection