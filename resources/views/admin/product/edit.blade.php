@extends('layouts.admin')
@section('content')

    <form class="form-horizontal" action="{{route('products.update', $product)}}"  method="post" enctype="multipart/form-data">
    	<div class="form-group">
			<label class="control-label col-sm-2">商品编号：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  name="product_sn" value="{{$product->product_sn}}" >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">商品名称：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  name="name" value="{{$product->name}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">所属分类：</label>
			<div class="col-sm-5">
				@inject('category', 'App\Service\CategoryService')
				<select id="category" name="category_id" class="form-control">
					@foreach($category->categoryTree() as $cate)
						<option @if($product->category_id == $cate['id']) selected @endif value="{{$cate['id']}}">{{$cate['name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2"></label>
			<div id="attribute" class="col-sm-8">
				@if($attribute->count())
					
					@foreach($attribute as $attr)
					<ul class="list-inline">
						<li class="col-sm-2">{{$attr->name}}</li> 
						@if($attr->input_type == 1)
						    <li><input  name="attribute[{{$attr->id}}][attribute_value]" type="text" value="{{$productattribute[$attr->id]['attribute_value'] or '' }}"></li><li>价格：</li>
						    <li><input name="attribute[{{$attr->id}}][attribute_price]" value="{{$productattribute[$attr->id]['attribute_price'] or ''}}"></li> 
						@else($attr->input_type == 2)   
						     <li>
						     	<select name="attribute[{{$attr->id}}][attribute_value]">
						     	
						     		@foreach(explode("\r\n", $attr->attribute_value) as $item)
						     			<option @if(isset($productattribute[$attr->id]) && 
						     				$productattribute[$attr->id]['attribute_value'] ==$item) selected @endif
						     				value="{{$item}}">{{$item}}</option>
						     		@endforeach
						        </select>
						     </li>
						@endif
				    </ul>		
					@endforeach
				@endif
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-2">市场价(元)：</label>
			<div class="col-sm-5">
				<input type="text" name="market_price" class="form-control" value="{{$product->market_price}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">本店售价(元)：</label>
			<div class="col-sm-5">
				<input type="text" name="price" class="form-control" value="{{$product->price}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">虚拟销量：</label>
			<div class="col-sm-5">
				<input type="text" name="sales" class="form-control" value="{{$product->sales}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">数量单位：</label>
			<div class="col-sm-5">
				<input type="text" name="unit" class="form-control" value="{{$product->unit}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">是否热销：</label>
			<div class="col-sm-5">
				<input type="checkbox" name="is_hot" class="checkbox" value="1">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">库存量：</label>
			<div class="col-sm-5">
				<input type="text" name="number" class="form-control" value="{{$product->number}}">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">简单描述：</label>
			<div class="col-sm-5">
				<textarea rows="5" class="form-control" name="brief">{{$product->brief}}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">缩略图：</label>
			<div class="col-sm-5">
				<input type="file" name="thumb" class="form-control">
				@if($product->thumb)
					<img width="100" height="100" src="{{asset('Storage/'.$product->thumb)}}">
				@endif
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">商品描述：</label>
			<div class="col-sm-9">
				<textarea id="txtEditor" class="textarea" name="description"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$product->productinfo->description}}</textarea>
			</div>
		</div>
		<div id="gallery_list">
			@foreach($product->productgalleries as $gallery)
				<input name="galleries[]" type="hidden" value="{{$gallery->img_name}}">
			@endforeach
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">上传商品图片：</label>
			<div class="formControls col-xs-8 col-sm-8">
				<input id="gallery" type="file" class="btn btn-primary" data-url="{{route('image.upload')}}" name="gallery[]">
			</div>
		</div>
		<div class="form-group"></div>
			<label class="control-label col-sm-2"></label>
			<!--图片预览-->
		    <div class="col-sm-8" id="files">
		    	@if($product->productgalleries->count()>0)
		    		@foreach($product->productgalleries as $gallery)
		    			<div style="float:left;margin-left:3px"><p><a href="javascript:;">删除</a></p><p><img src="{{asset('Storage/gallery/thumb/'.$gallery->img_name)}}" width='100' height='100'></p><p><input name="+file.fname+" size='10'><input type="hidden" value="{{$gallery->img_name}}"></p></div>
		    		@endforeach
		    	@endif
		    </div>
	    </div>
	    
	    {{csrf_field()}}
	    {{method_field('PUT')}}
		<div class="form-group">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"> 确定 </button>
				
			</div>
		</div>
	</form>
	@include('error');
@endsection

@section('js')
    <script src="{{ asset('js/editor.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('js/upload/jquery.fileupload.js') }}"></script>
    <script>
    	$(function(){
    		//$('#txtEditor').Editor();
    		$('.textarea').wysihtml5();

    		//上传相册
    		$("#gallery").fileupload({
                dataType: 'json',
                done: function (e, data) {
                    console.log(data.result.data);
		            $.each(data.result.data, function (index, file) {
		                    console.log(file.savepath);
		                 //alert(file.savepath);
		                    $("<div style='float:left;margin-left:3px'><p><img src="+file.showpath+" width='100' height='100'></p><p><input name="+file.fname+" size='10'></p></div>").appendTo('#files');
		                    $("<input>").attr({name:"galleries[]",type:"hidden"}).val(file.savepath).appendTo("#gallery_list") ;
		                });
	                }
            });

            //删除相册
            $("#files a").on('click', function(){
            	var img = $(this).parent().parent().find("input[type=hidden]").val();
            	$("input[value='"+img+"']").remove();
            	$(this).parent().parent().remove();

            });

            //获取属性
            $("#category").on('change',function(){
            	var category = $(this).val() ;
            	$.ajax({
            		url:"{{route('attribute.get')}}",
            		type:'get',
            		data:{category:category},
            		success:function(data){

            			$("#attribute").empty().append(data.success);
            		}
            	});
            });

    	});
    </script>
@endsection