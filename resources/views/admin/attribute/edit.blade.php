@extends('layouts.admin')
@section('content')

    <form class="form form-horizontal" action="{{route('attributes.update', $attribute)}}"  method="post">
		<div class="form-group">
			<label class="control-label col-sm-2">属性名称：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  name="name" value="{{$attribute->name}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">字段类型：</label>
			<div class="col-sm-5">
				
				<select name="input_type" class="form-control">
					<option @if($attribute->input_type == 1) selected  @endif value="1">文本字段</option>
					<option @if($attribute->input_type == 2) selected @endif value="2">下拉列表</option>
					<option @if($attribute->input_type == 3) selected @endif value="3">多行文本</option>
				</select>
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-2">属性类型：</label>
			<div class="col-sm-5">
				<select class="form-control" name="attribute_type">
					<option @if($attribute->attribute_type == 0) selected @endif value="0">单独属性</option>
					<option @if($attribute->attribute_type == 1) selected @endif value="1">可选属性</option>
				</select>	
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">属性可选值：</label>
			<div class="col-sm-5">
				<textarea rows="5" class="form-control" name="attribute_value">{{$attribute->attribute_value}}</textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">属性索引：</label>
			<div class="col-sm-5">
				<select name="attribute_index" class="form-control">
					<option @if($attribute->attribute_index ==0) selected @endif value="0">不可以检索</option>
					<option @if($attribute->attribute_index ==1) selected @endif value="1">关键字检索</option>
					<option @if($attribute->attribute_index ==2) selected @endif value="2">范围检索</option>
				</select>	
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">排序：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="{{$attribute->sort_order}}"  name="sort_order">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">分组：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="{{$attribute->group}}"  name="group">
			</div>
		</div>
		{{csrf_field()}}
		{{method_field('PUT')}}
		<input type="hidden" name="category" value="{{$attribute->category_id}}">
		<div class="form-group">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"> 确定 </button>
				
			</div>
		</div>
	</form>
@endsection