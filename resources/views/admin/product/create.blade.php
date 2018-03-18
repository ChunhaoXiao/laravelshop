@extends('layouts.admin')
@section('content')
<p>添加商品</p>
    <form class="form-horizontal" action="{{route('products.store')}}"  method="post" enctype="multipart/form-data">
    	 {{csrf_field()}}
    	<div class="form-group">
			<label class="control-label col-sm-2">商品编号：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  name="product_sn" >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">商品名称：</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"  name="name">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">所属分类：</label>
			<div class="col-sm-5">
				@inject('category', 'App\Service\CategoryService')
				<select id="category" name="category_id" class="form-control">
					<option value="">请选择</option> 
					@foreach($category->categoryTree() as $cate)
						<option value="{{$cate['id']}}">{{$cate['name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2"></label>
			<div id="attribute" class="col-sm-8"></div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-2">市场价(元)：</label>
			<div class="col-sm-5">
				<input type="text" name="market_price" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">本店售价(元)：</label>
			<div class="col-sm-5">
				<input type="text" name="price" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">虚拟销量：</label>
			<div class="col-sm-5">
				<input type="text" name="sales" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">数量单位：</label>
			<div class="col-sm-5">
				<input type="text" name="unit" class="form-control">
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
				<input type="text" name="number" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">简单描述：</label>
			<div class="col-sm-5">
				<textarea rows="5" class="form-control" name="brief"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">缩略图：</label>
			<div class="col-sm-5">
				<input type="file" name="thumb" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">商品描述：</label>
			<div class="col-sm-9">
				<textarea id="txtEditor" class="textarea" name="description"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
			</div>
		</div>
		<div id="gallery_list"></div>
		<div class="form-group">
			<label class="control-label col-sm-2">上传商品图片：</label>
			<div class="formControls col-xs-8 col-sm-8">
				<input id="gallery" type="file" class="btn btn-primary" data-url="{{route('image.upload')}}" name="gallery[]">
			</div>
		</div>
		<div class="form-group"></div>
			<label class="control-label col-sm-2"></label>
			<!--图片预览-->
		    <div class="col-sm-8" id="files"></div>
	    </div>
	    
	   
		<div class="form-group">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"> 确定 </button>
				
			</div>
		</div>
	</form>
	
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
		                    $("<input>").attr({name:"galleries[]"}).val(file.savepath).appendTo("#gallery_list") ;
		                });
	                }
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

            //添加可选属性

            $(document).on('click', ".glyphicon-plus", function(){
            	var content = $(this).parent();
            	var list = $(content).html();
            	//alert($(this).siblings().html());
            	//$(content.html()).wrap("<ul class='lint-inline'></ul>");
            	$(content).after("<ul class='list-inline'>"+list+"</ul>");
            	//alert(content);
            });

    	});
    </script>
@endsection