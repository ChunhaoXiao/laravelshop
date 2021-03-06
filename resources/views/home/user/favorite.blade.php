@extends('layouts.user')

@section('style')
    <link href="{{ asset('assets/user/css/infstyle.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('main')
  <div class="main-wrap">
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-20">
            <div class="container">
                <section class="wishlist-area ptb-30">
                    <div class="container">
                        <div class="wishlist-wrapper">
                            <h3 class="h-title mb-40 t-uppercase">我的收藏列表</h3>
                            <table id="cart_list" class="wishlist">
                                <tbody>
                                @foreach ($favoriteProducts as $product)
                                    <tr class="panel alert">
                                    <td class="col-sm-8 col-md-9">
                                        <div class="media-left is-hidden-sm-down">
                                            <figure class="product-thumb">
                                                <img src="{{ asset('storage/'.$product->thumb) }}" width="100" height="100" alt="{{ $product->name }}">
                                            </figure>
                                        </div>
                                        <div class="media-body valign-middle">
                                            <h5 class="title mb-5 t-uppercase"><a href="{{ route('product.show',$product) }}">{{ $product->name }}</a></h5>
                                            <div class="rating mb-10">
                                                <span class="rating-reviews">
				                        		( <span class="rating-count">{{ $product->users()->count() }}</span> 收藏 )</span>
                                            </div>
                                            <h4 class="price color-green"><span class="price-sale">￥{{ $product->market_price }}</span>￥{{ $product->price }}</h4>
                                            <a href="javascript:;" data-url="{{route('favorite.add', $product)}}" class="glyphicon glyphicon-trash">移除</span>
                                        </div>
                                    </td>
                                    <td class="col-sm-1">
                                        
                                        <button type="button" class="close pr-xs-0 pr-sm-10" data-url="{{ route('favorite.remove', ['product_id' => $product->id]) }}" >
                                          
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </main>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/user/layer/2.4/layer.js') }}"></script>

    <script>
    	//alert('sfsdfsdfsdfsdfsdf');
    	$(function(){
    		//alert('dfgdfgdfg');
    		$(".glyphicon-trash").on('click', function(){
    			var url = $(this).data('url');
    			var that = $(this);
    			$.ajax({
	            	url:url,
	            	type:'post',
	            	success:function(res){
	            		that.parents('tr').first().remove();
	            	}
                }) ;
            });    
    			//alert(url);
    	});

       
    </script>
@endsection