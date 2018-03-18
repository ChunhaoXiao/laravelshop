@extends('layouts.home')
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-10">
            <div class="container">

                <section class="store-header-area panel t-xs-center t-sm-left">
                    <div class="row row-rl-10">
                        <div class="col-sm-3 col-md-2 t-center">
                            
                            
                            
                        </div>
                 <div class="col-sm-5 col-md-6">

                           
                        </div>
                        <div class="col-md-4">
                            <div class="store-splitter-left">
                                <div class="left-splitter-header prl-10 ptb-20 bg-lighter">
                                    <div class="row">
                                        <div class="col-xs-12 t-center">
                                            <h2></h2>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section deals-area ptb-30">

                    <!-- Page Control -->
                    <header class="page-control panel ptb-15 prl-20 pos-r mb-30">

                        <!-- List Control View -->
                        <!-- <ul class="list-control-view list-inline">
                            <li><a href="{{ url('/home/categories') }}"><i class="fa fa-reply"></i></a>
                            </li>
                        </ul> -->
                        <!-- End List Control View -->
                        <div class="pos-tb-center">
                           <ul class="list-inline">
                            <li>排序：</li>
                            @if(!isset(request()->order) || request()->order=='created_at')
                               <li class="bg-info">最新</li>
                            @else
                                 <li><a  href="{{route('product.list',array_merge(request()->query(),['order'=>'created_at']))}}">最新</a></li>
                            @endif    

                            @if(in_array(request()->order,['price_desc','price_asc']))
                                @if(request()->order == 'price_asc')
                                    <li class="bg-info"><a href="{{ route('product.list',array_merge(request()->query(),['order'=>'price_desc'])) }}">价格</a></li> 
                                @else
                                    <li class="bg-info"><a href="{{ route('product.list',array_merge(request()->query(),['order'=>'price_asc'])) }}">价格</a></li> 
                                @endif    
                            @else
                                <li><a href="{{ route('product.list',array_merge( request()->query(),['order'=>'price_asc'])) }}">价格</a></li>
                            @endif
                            @if(request()->order == 'popular')
                                <li class="bg-info">最受欢迎</li>
                            @else
                                <li><a href="{{ route('product.list',array_merge(request()->query(),['order' => 'popular'])) }}">最受欢迎</a></li>
                            @endif

                         </ul>
                         <!--  <span class="label label-danger">Danger</span><span class="label label-danger">Danger</span><span class="label label-danger">Danger</span> -->
                        </div>

                    </header>
                    <!-- End Page Control -->
                    <div class="row row-masnory row-tb-20">

                        @foreach ($products as $product)
                            <div class="col-xs-12">
                                <div class="deal-single panel">
                                    <div class="row row-rl-0 row-sm-cell">
                                        <div class="col-sm-5">
                                            <a href="{{ route('product.show',$product) }}">
                                                <figure class="deal-thumbnail embed-responsive embed-responsive-16by9 col-absolute-cell" data-bg-img="{{ asset('storage/'.$product->thumb) }}">
                                                    <div class="label-discount left-20 top-15">-50%</div>
                                                    <ul class="deal-actions top-15 right-20">
                                                        <li  class="like-deal" data-id="{{ $product->id }}">
                                                            <span>
                                                                <i class="fa fa-heart"></i>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="bg-white pt-20 pl-20 pr-15">
                                                <div class="pr-md-10">
                                                    <div class="rating mb-10">
                                                        <div class="mb-10">
                                                            收藏人数 <span class="rating-count rating">0</span>
                                                        </div>
                                                    </div>
                                                    <h3 class="deal-title mb-10">
                                                        <a href="{{ url("/home/products/{$product->id}") }}">
                                                            {{ $product->name }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-muted mb-20">
                                                        {{ $product->brief }}
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
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Page Pagination -->
                    <div class="page-pagination text-center mt-30 p-10 panel">
                        <nav>
                           
                        </nav>
                    </div>
                    <!-- End Page Pagination -->

                </section>

            </div>
        </div>


    </main>
@endsection
@section('script')
    <script>
        $(function(){
            $("#order-select").on('change',function(){
                //var order = $(this).val();
                var order = $(this).val() ; 
                @php 
                    $query = request()->query()? :[] ;
                    unset($query['order']);
                    $url = route('product.list',array_merge( $query));
                @endphp
                var url = "{{$url}}";
                var url = url+"&order="+order;
                location.href=url.replace(/&amp;/g, "&") ;
               // alert(url);
               
            });
        }) ;
    </script>    
@endsection