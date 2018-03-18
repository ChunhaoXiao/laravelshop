@extends('layouts.admin')
@section('content')
<p>@isset($category)编辑分类@else添加分类@endisset</p>
    <form class="form form-horizontal" @isset($category) action="{{route('categories.update', $category)}}"  
    @else action="{{route('categories.store')}}" @endisset  method="post">
		<div class="form-group">
			<label class="control-label col-sm-2">分类名称：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" @isset($category) value="{{$category->name}}" @endisset  name="name">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">上级分类：</label>
			<div class=" col-sm-5">
				@inject('categories', 'App\Service\CategoryService')
				<select name="parent_id" class="form-control">
					<option value="0">顶级分类</option>
					@foreach($categories->categoryTree() as $cate)
						<option @if(isset($category->parent_id) && $category->parent_id == $cate['id']) selected @endif value="{{ $cate['id'] }}">{{ $cate['name'] }}</option>

					@endforeach
				</select>
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-2">数量单位：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="{{$category->unit or ''}}" name="unit">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">是否热门：</label>
			<div class="col-sm-9">
				<input type="checkbox" name="is_hot" class="checkbox" value="1" >
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">排序值：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  value="{{$category->sort_order or '0'}}"  name="sort_order">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">价格分级：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="0"  name="sort_order">
			</div>
		</div>
		{{csrf_field()}}
		@isset($category)
		{{ method_field('PUT') }}
		@endisset
		<div class="form-group">
			<label class="control-label col-sm-2"></label>
			<div class="col-sm-5">
				<button  class="btn btn-primary radius" type="submit"> 确定 </button>
				
			</div>
		</div>
	</form>
@endsection