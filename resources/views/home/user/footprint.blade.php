@extends('layouts.user')


@section('main')
    <div class="main-wrap">
        <div class="wrap-left">


            <div class="row">
                @foreach($products as $product)
                  <div class="col-sm-5 col-md-4">
                    <div class="thumbnail">
                      <a href="{{route('product.show',$product->product)}}"><img width="150" height="150" src="{{asset('storage/'.$product->product->thumb)}}" alt="..."></a>
                      <div class="caption text-center">
                        <h3><a href="{{route('product.show',$product->product)}}">{{$product->product->name}}</a></h3>
                        <p>{{$product->product->brief}}</p>
                        <!-- <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> -->
                      </div>
                    </div>
                  </div>
                @endforeach  
            </div>
                      
            
        </div><!---->
        <div class="wrap-right">

            <!-- 日历-->
            <div class="day-list">
                <div class="s-bar">
                    <a class="i-history-trigger s-icon" href="#"></a>我的日历
                    <a class="i-setting-trigger s-icon" href="#"></a>
                </div>
                <div class="s-care s-care-noweather">
                    <div class="s-date">
                        <em>{{ date('d') }}</em>
                        <span>星期 {{ date('N') }}</span>
                        <span>{{ date('Y-m') }}</span>
                    </div>
                </div>
            </div>

            <!--热卖推荐 -->
            <div class="new-goods">
                <div class="s-bar">
                    <i class="s-icon"></i>热卖推荐
                </div>
                <div class="new-goods-info">

                </div>
            </div>

        </div>
    </div>
@endsection