@extends('layouts.home')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/menu.css') }}">
@endsection

@section('main')
    <main id="mainContent" class="main-content">
    <div class="page-container ptb-10">
        <div class="container">
            <div class="section deals-header-area ptb-30">
                <div class="row row-tb-20">
                    <div class="col-xs-12 col-md-5 col-lg-3">
                        <aside>
                            <em>商品分类</em>
                            <ul class="prosul  panel" id="proinfo">
                            	@inject('topcategory', 'App\Service\CategoryService')
                                @foreach ($topcategory->getTopCategory() as $category)
                                    <li class="food">
                                        <i>&gt;</i>
                                        <a class="ti" href="{{ route('product.list',$category) }}"> {{ $category->name }} </a>
                                        @if($category->children->count())
                                        <div class="prosmore hide">
                                            
                                            @foreach($category->children as $cate)
                                                <span><em><a href="{{ route('product.list',$cate) }}">{{$cate->name}}</a></em></span>
                                            @endforeach
                                        </div>    

                                        @endif
                                    </li>
                                @endforeach
                               
                            </ul>
                        </aside>
                    </div>


                    <div class="col-xs-12 col-md-6 col-lg-9">
                        <div class="header-deals-slider owl-slider" data-loop="true" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-nav="true" data-xxs-items="1" data-xxs-nav="true" data-xs-items="1" data-xs-nav="true" data-sm-items="1" data-sm-nav="true" data-md-items="1" data-md-nav="true" data-lg-items="1" data-lg-nav="true">
                        	@inject('hotProduct', 'App\Service\ProductService')
                            @foreach ($hotProduct->getHotProduct() as $hotProduct)
                                <div class="deal-single panel item">
                                    <a href="{{ route('product.show',$hotProduct) }}">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="{{asset('storage/'.$hotProduct->thumb)}}">
                                            <div class="label-discount top-10 right-10" style="width: auto;">
                                                {{ $hotProduct->price }} ￥
                                            </div>
                                        </figure>
                                    </a>
                                    <div class="deal-about p-20 pos-a bottom-0 left-0">
                                        <div class="mb-10">
                                            收藏人数 <span class="rating-count rating"></span>
                                        </div>
                                        <h3 class="deal-title mb-10 ">
                                                {{ $hotProduct->name }}
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

             <section class="section latest-deals-area ptb-30">

                	@inject('product', 'App\Service\ProductService')
                    @if($product->getLatest()->first() instanceof App\Models\Product)
                        <header class="panel ptb-15 prl-20 pos-r mb-30">
                        <h3 class="section-title font-18">最新的 商品</h3>
                        </header>
                    @endif
                    @foreach ($product->getLatest() as $latestProduct)
                        @if($latestProduct instanceof App\Models\Category)
                           <header class="panel ptb-15 prl-20 pos-r mb-30">
                                <h3>{{$latestProduct->name}}</h3>
                                <a href="{{ route('product.list',$latestProduct) }}" class="btn btn-o btn-xs pos-a right-10 pos-tb-center">查看所有</a>
                           </header>
                        <div class="row row-masnory row-tb-20">
                            @foreach($latestProduct->products()->withCount('users')->orderBy('users_count', 'desc')->limit(3)->get() as $product)

                            <div class="col-sm-6 col-lg-4">
                                <div class="deal-single panel">
                                    <a href="{{ route('product.show',$product) }}">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="{{asset('storage/'.$product->thumb)}}">

                                        </figure>
                                    </a>
                                    <div class="bg-white pt-20 pl-20 pr-15">
                                        <div class="pr-md-10">
                                            <div class="mb-10">
                                                收藏人数 <span class="rating-count rating">{{$product->users_count}}</span>
                                            </div>
                                            <h3 class="deal-title mb-10">
                                                <a href="{{ route('product.show', $product) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h3>
                                            <p class="text-muted mb-20">
                                                {!! $product->brief !!}
                                            </p>
                                        </div>
                                        <div class="deal-price pos-r mb-15">
                                            <h3 class="price ptb-5 text-right">
                                                <span class="price-sale">
                                                    {{ $product->market_price }}
                                                </span>
                                                ￥ {{ $product->price }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        @else
                              <div class="col-sm-6 col-lg-4">
                                <div class="deal-single panel">
                                    <a href="{{ route('product.show',$latestProduct) }}">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="{{asset('storage/'.$latestProduct->thumb)}}">

                                        </figure>
                                    </a>
                                    <div class="bg-white pt-20 pl-20 pr-15">
                                        <div class="pr-md-10">
                                            <div class="mb-10">
                                                收藏人数 <span class="rating-count rating">0</span>
                                            </div>
                                            <h3 class="deal-title mb-10">
                                                <a href="{{ route('product.show',$latestProduct) }}">
                                                    {{ $latestProduct->name }}
                                                </a>
                                            </h3>
                                            <p class="text-muted mb-20">
                                                {!! $latestProduct->brief !!}
                                            </p>
                                        </div>
                                        <div class="deal-price pos-r mb-15">
                                            <h3 class="price ptb-5 text-right">
                                                <span class="price-sale">
                                                    {{ $latestProduct->market_price }}
                                                </span>
                                                ￥ {{ $latestProduct->price }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>              
                         @endif   
                    @endforeach
                </div>
            </section> 
    </main>
@endsection
@section('script')

    <script type="text/javascript" src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script>
       (function(){
            
            var $subblock = $(".subpage"), $head=$subblock.find('h2'), $ul = $("#proinfo"), $lis = $ul.find("li"), inter=false;
            
            $head.click(function(e){
                e.stopPropagation();
                if(!inter){
                    $ul.show();
                }else{
                    $ul.hide();
                }
                inter=!inter;
            });
            
            $ul.click(function(event){
                //event.stopPropagation();
            });
            
            $(document).click(function(){
               // $ul.hide();
                //inter=!inter;
            });

            $lis.hover(function(){
                if(!$(this).hasClass('nochild')){
                    $(this).addClass("prosahover");
                    $(this).find(".prosmore").removeClass('hide');
                }
            },function(){
                if(!$(this).hasClass('nochild')){
                    if($(this).hasClass("prosahover")){
                        $(this).removeClass("prosahover");
                    }
                    $(this).find(".prosmore").addClass('hide');
                }
            });
            
        })();
</script>
@endsection