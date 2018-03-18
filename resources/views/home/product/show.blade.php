@extends('layouts.shop')


@section('main')
    <div class="listMain">
        <!--放大镜-->

        <div class="item-inform">
            <div class="clearfixLeft" id="clearcontent">

                <div class="box">
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".jqzoom").imagezoom();
                            $("#thumblist li a").click(function() {
                                $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
                                $("#jqzoom").attr('src', $(this).find("img").attr("src"));
                            });
                        });
                    </script>

                    <div class="tb-booth tb-pic tb-s310">
                        <img src="{{ asset('storage/'.$product->thumb)}}" alt="{{ $product->name }}" id="jqzoom" />
                    </div>
                    <ul class="tb-thumb" id="thumblist">
                        @foreach ($product->productgalleries as $key => $image)
                            <li class="{{ $key == 0 ? 'tb-selected' : '' }}">
                                <div class="tb-pic tb-s40">
                                    <a href="javascript:;">
                                        <img src="{{ asset('storage/gallery/thumb/'.$image->img_name) }}">
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="clear"></div>
            </div>

            <div class="clearfixRight">

                <!--规格属性-->
                <!--名称-->
                <div class="tb-detail-hd">
                    <h1>
                        {{ $product->name }}
                    </h1>
                </div>
                <div class="tb-detail-list">
                    <!--价格-->
                    <div class="tb-detail-price">
                        <li class="price iteminfo_price">
                            <dt>促销价</dt>
                            <dd><em>¥</em><b class="sys_item_price"></b>  </dd>
                        </li>
                        <li class="price iteminfo_mktprice">
                            <dt>原价</dt>
                            <dd><em>¥</em><b class="sys_item_mktprice">{{ $product->market_price }}</b></dd>
                        </li>
                        <div class="clear"></div>
                    </div>

                    <!--地址-->
                    <dl class="iteminfo_parameter freight">
                        <dt>收货地址</dt>
                        <div class="iteminfo_freprice">
                            <div class="am-form-content address">

                                @if (Auth::check())
                                    <select data-am-selected name="address_id">
                                        @foreach (Auth::user()->addresses as $address)
                                            <option value="{{ $address->id }}">{{ $address->name }}/{{ $address->phone }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <a style="line-height:27px;color:red;" href="{{ url('user')  }}">添加收货地址</a>
                                @endif

                            </div>
                        </div>
                    </dl>
                    <div class="clear"></div>

                    <!--销量-->
                    <ul class="tm-ind-panel">
                        <li class="tm-ind-item tm-ind-sumCount canClick">
                            <div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count">{{ $product->sales }}</span></div>
                        </li>
                        <li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
                            <div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">{{$product->comments()->count()}}</span></div>
                        </li>
                    </ul>
                    <div class="clear"></div>

                    <!--各种规格-->
                    <dl class="iteminfo_parameter sys_item_specpara">
                        <dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
                        <dd>
                            <!--操作页面-->

                            <div class="theme-popover-mask"></div>

                            <div class="theme-popover">
                                <div class="theme-span"></div>
                                <div class="theme-poptit">
                                    <a href="javascript:;" title="关闭" class="close">×</a>
                                </div>
                                <div class="theme-popbod dform">
                                    <form class="theme-signin" name="" action="{{route('cart.add')}}" method="post" id="cart-form" >

                                        <div class="theme-signin-left">
                                            @foreach ($product->getOption() as $item => $attrs)
                                                <div class="theme-options">
                                                    <div class="cart-title">{{ $item }}</div>
                                                    <ul class="list-inline">
                                                        @foreach ($attrs as $key => $attr)
                                                            <li><input type="radio" name="attribute[{{$item}}]" @if($loop->first) checked @endif  class="sku-line {{ $key == 0 ? 'selected' : '' }}" value="{{$attr->id}}" >
                                                                {{$attr->attribute_value}}<i></i><input type="hidden" value="{{$attr->attribute_price}}"></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                            <div class="theme-options">
                                                <div class="cart-title number">数量</div>
                        <dd>
                            <input id="min" class="am-btn am-btn-default" type="button" value="-" />
                            <input type="hidden" name="product" value="{{$product->id}}">
                            <input id="text_box" name="numbers" type="text" value="1" style="width:30px;" />
                            <input id="add" class="am-btn am-btn-default"  type="button" value="+" />
                            <span id="Stock" class="tb-hidden">库存<span class="stock">{{ $product->number }}</span>件</span>
                            {{csrf_field()}}
                        </dd>


                </div>
                <div class="clear"></div>


            </div>
            

            </form>

             @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



        </div>
    </div>

    </dd>
    </dl>
    <div class="clear"></div>
    <!--活动	-->

    </div>

    <div class="pay">
        
        <div class="pay-opt">

            <a href="{{ url('/') }}"><span class="am-icon-home am-icon-fw">首页</span></a>
            @auth
            @if ($product->users()->where('user_id', \Auth::user()->id)->count() > 0)
                <a href="javascript:;" style="display: none" id="likes_btn"><span class="am-icon-heart am-icon-fw" >收藏</span></a>
                <a href="javascript:;"  id="de_likes_btn"><span class="am-icon-heart am-icon-fw">取消收藏</span></a>
            @else
                <a href="javascript:;"  id="likes_btn"><span class="am-icon-heart am-icon-fw">收藏</span></a>
                <a href="javascript:;" style="display: none" id="de_likes_btn"><span class="am-icon-heart am-icon-fw" >取消收藏</span></a>
            @endif
            @endauth

            @guest
            <a href="javascript:;"  id="likes_btn"><span class="am-icon-heart am-icon-fw">收藏</span></a>
            @endguest


        </div>
        <li>
            <div class="clearfix tb-btn" id="favorite">
                @auth
                    <a id="like"   @if(!$product->favorable()) style="display:none"  @endif href="javascript:;" data-url="{{route('favorite.add',$product)}}"  href="javascript:;" >收藏</a>
                    <a id="dislike" @if($product->favorable()) style="display:none" @endif href="javascript:;" data-url="{{ route('favorite.add',$product) }}">取消收藏</a>
                @endauth
               

            </div>
        </li>
        <li>
            <div class="clearfix tb-btn tb-btn-basket">
                <a  title="加入购物车" href="javascript:;"  id="addCar"><i></i>加入购物车</a>
            </div>
        </li>
    </div>
    <input type="hidden" name="product" value="{{ $product->id }}">

    </div>

    <div class="clear"></div>

    </div>




    <!-- introduce-->

    <div class="introduce">
        <div class="browse">
            <div class="mc">
                <ul>
                    <div class="mt">
                        <h2>推荐</h2>
                    </div>
                    @inject('productService', 'App\Service\ProductService')

                    @foreach ($productService->getRecommends($product) as $recommendProduct)
                        <li class="first">
                            <div class="p-img">
                                <a href="{{ route('product.show',$recommendProduct->id) }}">
                                    <img class="media-object" src="{{ asset('storage/'.$recommendProduct->thumb) }}" alt="{{ $recommendProduct->name }}" width="80"  height="80">
                                </a>
                            </div>
                            <div class="p-name"><a href="{{ url("/home/products/{$recommendProduct->id}") }}">
                                    {{ $recommendProduct->name }}
                                </a>
                            </div>
                            <div class="p-price"><strong>
                                    ￥ {{ $recommendProduct->price }}
                                </strong></div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="introduceMain">
            <div class="am-tabs" data-am-tabs>
                <ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active">
                        <a href="#">

                            <span class="index-needs-dt-txt">宝贝详情</span></a>

                    </li>

                    <li>
                        <a href="#">

                            <span class="index-needs-dt-txt">全部评价</span></a>

                    </li>
                </ul>

                <div class="am-tabs-bd">

                    <div class="am-tab-panel am-fade am-in am-active">
                        <div class="details">
                            <div>
                                <table class="table">
                                    <tr><td>产品名称</td><td>{{$product->name}}</td><td>产品编号</td><td>{{$product->product_sn}}</td></tr>
                                    <tr>
                                    @foreach($product->attributeList() as $attribute)
                                        <td>{{$attribute->attribute->name}}</td><td>{{$attribute->attribute_value}}</td>
                                        @if($loop->index % 2)
                                         </tr><tr>
                                        @endif    
                                    @endforeach

                                </table>    
                            </div>
                            <div class="attr-list-hd after-market-hd">
                                <h4>商品细节</h4>
                            </div>
                            <div class="twlistNews">
                                {!! $product->productinfo->description !!}

                                <table align="center" border="0" width="750" class="ke-zeroborder table">
                                    <tbody>
                                        @foreach($product->productgalleries as $gallery)
                                            <tr>
                                                <td>
                                                    <img alt="" src="{{asset('storage/gallery/origin/'.$gallery->img_name)}}" border="0" height="486" width="750" /> 
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clear"></div>

                    </div>

                    <div class="am-tab-panel am-fade">
                        <div>
                            <form class="form-horizontal" id="comment" method="post" action="{{route('comment.add')}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <ul class="list-inline">
                                        <li><input type="radio" name="comment_level" value="1" checked="checked">好评</li>
                                        <li><input type="radio" name="comment_level" value="2">中评</li>
                                        <li><input type="radio" name="comment_level" value="3">差评</li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                     <label class="control-label col-sm-2">添加评论</label>
                                     <div class="col-sm-5">
                                         <textarea cols="10" rows="5" class="form-control" name="content"></textarea>
                                     </div>
                                </div>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="form-group">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-5 text-left">
                                        <button class="btn btn-primary"    type="submit"> 提交</button>
                                        <span id="error"></span>
                                    </div>
                                </div> 
                                
                            
                            </form>
                            @include('error')
                        </div>
                        <div class="actor-new">
                            <div class="rate">
                                <strong>100<span>%</span></strong><br> <span>好评度</span>
                            </div>
                            <dl>
                                <dt>买家印象</dt>
                                <dd class="p-bfc">
                                    <q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
                                    <q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
                                    <q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
                                    <q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
                                    <q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
                                    <q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
                                    <q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
                                    <q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
                                    <q class="comm-tags"><span>皮很薄</span><em>(831)</em></q>
                                </dd>
                            </dl>
                        </div>
                        <div class="clear"></div>
                        <div class="tb-r-filter-bar">
                            <ul class=" tb-taglist am-avg-sm-4">
                                <li class="tb-taglist-li tb-taglist-li-current">
                                    <div class="comment-info">
                                        <span>全部评价</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-1">
                                    <div class="comment-info">
                                        <span>好评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-0">
                                    <div class="comment-info">
                                        <span>中评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li--1">
                                    <div class="comment-info">
                                        <span>差评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="clear"></div>

                        <ul class="am-comments-list am-comments-list-flip">
                            @foreach($commentlist as $comment)
                            <li class="am-comment">
                                <!-- 评论容器 -->
                                <a href="">
                                    <img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
                                    <!-- 评论者头像 -->
                                </a>

                                <div class="am-comment-main">
                                    <!-- 评论内容容器 -->
                                    <header class="am-comment-hd">
                                        <!--<h3 class="am-comment-title">评论标题</h3>-->
                                        <div class="am-comment-meta">
                                            <!-- 评论元数据 -->
                                            <a href="#link-to-user" class="am-comment-author">{{$comment->user->name}}</a>
                                            <!-- 评论者 -->
                                            评论于
                                            <time datetime="">{{$comment->created_at}}</time>
                                        </div>
                                    </header>

                                    <div class="am-comment-bd">
                                        <div class="tb-rev-item " data-id="255776406962">
                                            <div class="J_TbcRate_ReviewContent tb-tbcr-content ">
                                                {{$comment->content}}
                                            </div>
                                            <div class="tb-r-act-bar">
                                                {{$comment->user->orderproducts->first()->product_attribute}} 

                                            </div>
                                            <div>购买时间 ：{{$comment->user->orderproducts->first()->orderinfo->created_at}}</div>
                                        </div>

                                    </div>
                                    <!-- 评论内容 -->
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="clear"></div>

                        <!--分页 -->
                        <ul class="am-pagination am-pagination-right">
                            <li class="am-disabled"><a href="#">&laquo;</a></li>
                            <li class="am-active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                        <div class="clear"></div>

                        <div class="tb-reviewsft">
                            <div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="clear"></div>

            <div class="footer">
                <div class="footer-hd">
                    <p>
                        <a href="#">星期一商城</a>
                        <b>|</b>
                        <a href="#">商城首页</a>
                        <b>|</b>
                        <a href="#">支付宝</a>
                        <b>|</b>
                        <a href="#">物流</a>
                    </p>
                </div>
                @include('common.home.footer')
            </div>
        </div>

    </div>
    </div>
    <form id="pay_form" action="{{ url('/user/pay/show') }}" method="post">
        {{ csrf_field() }}
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/user/layer/2.4/layer.js') }}"></script>
    <script src="{{ asset('js/jquery-addShopping.js') }}"></script>
    <script>

        function changePrice(){
            //alert('asdasdasd');
                var obj = $(".theme-signin-left input[type='radio']:checked")  ;
                var extraPrice = 0 ;
                $.each(obj, function(i, n){
                    extraPrice = parseFloat(extraPrice) + parseFloat($(n).parent().find("input[type='hidden']").val() ? $(n).parent().find("input[type='hidden']").val():0 );

                });
                var total = (parseFloat("{{$product->price}}")+ extraPrice) * ($("input[name='numbers']").val());
                $(".sys_item_price").html(total);  
        }
           
        $(function(){
            var price = parseFloat("{{$product->price}}") ;
           // alert(price);
            @foreach($product->getOption() as $item => $attrs)
                @foreach($attrs as  $attr)
                    @if($loop->first)
                   // var attrprice = "{{$attr->attribute_price}}" ;
                    //console.log(attrprice);
                    price = price + parseFloat("{{intval($attr->attribute_price)}}");
                    @endif
                   // alert(attrprice);
                   // price = parseFloat(price) + parseFloat("{{$attr->attribute_price}}") ;
                @endforeach

            @endforeach
            //alert(price);
            $(".sys_item_price").html(price);

            $(".theme-signin-left input[type='radio']").on('click', changePrice);
            $("input[name='numbers']").on('change', changePrice);




        });
        var product_id = $('input[name=product_id]').val();
        var _url = "{{ url("/user/likes") }}/" + product_id;
        var token = "{{ csrf_token() }}";
        var likes_nums = $('#likes_count');

       /* $('#likes_btn').click(function(){
            var that = $(this);

            $.post(_url, {_token:token}, function(res){
                layer.msg(res.msg);

                if (res.code == 301) {
                    return;
                }

                that.hide().next().show();
                likes_nums.text(parseInt(likes_nums.text()) + 1);
            });
        });
        $('#de_likes_btn').click(function(){
            var that = $(this);

            $.post(_url, {_token:token,_method:'DELETE'}, function(res){
                layer.msg(res.msg);

                if (res.code == 301) {
                    return;
                }

                that.hide().prev().show();
                likes_nums.text(parseInt(likes_nums.text()) - 1);
            });
        });*/

        $("#favorite a").on('click', function(){
            var url = $(this).data('url');
            $.ajax({
                url:url,
                type:'post',
                success:function(data){
                    console.log(data);
                    
                    if(data.attached.length)
                    {  
                        $("#like").hide();
                        $("#dislike").show();
                    }
                    else
                    {
                        $("#like").show();
                        $("#dislike").hide();
                    }
                    
                    
                }

            });
        });

        var Car = {
            addProduct:function(product_id) {

                var numbers = $("input[name=numbers]").val();
                if (! localStorage.getItem(product_id)) {
                    var product = {name:"{{ $product->name }}", numbers:numbers, price:"{{ $product->price }}"};
                } else {
                    var product = $.parseJSON(localStorage.getItem(product_id));
                    product.numbers = parseInt(product.numbers) + parseInt(numbers);
                }
                localStorage.setItem(product_id, JSON.stringify(product))
            }
        };

        var car_nums = $('#cart-number');
        $('#addCar').shoping({
            endElement:"#car_icon",
            iconCSS: "",
            iconImg: $('#jqzoom').attr('src'),
            endFunction:function(element){

                var numbers = $("input[name=numbers]").val();
                var data = $("#cart-form").serialize();//{product_id:"{{ $product->id }}",_token:token, numbers:numbers};
                var url = "{{ route('cart.add') }}";
                $.ajax({
                    url:url,
                    type:'post',
                    data:data,
                    success:function(){
                        layer.msg('加入购物车成功');
                        car_nums.text(parseInt(car_nums.text())+1);
                    },
                    error:function(res){
                        var obj = $.parseJSON(res.responseText);
                        alert(obj.errors.error);
                    }


                });

               /* $.post(url, data, function(res){
                    console.log(res);

                    if (res.code == 422) {
                        alert(res.errors.error);
                        //layer.msg(res.errors.error, {icon: 2});
                        return;
                    }

                    if (res.code == 302) {
                        Car.addProduct(product_id);
                    }
                    layer.msg('加入购物车成功');
                    car_nums.text(parseInt(car_nums.text())+1);
                });*/
            }
        });

        $('#nowBug').click(function(){
            var _address_id = $('select[name=address_id]').val();
            var _numbers = $('input[name=numbers]').val();
            var _product_id = $('input[name=product_id]').val();


            var data = {address_id:_address_id,numbers:_numbers,product_id:_product_id, _token:"{{ csrf_token() }}"};
            console.log(data);
            $.post('{{ url('user/orders/single') }}', data, function(res){
                layer.msg(res.msg);
            });

            /** v请求支付 **/
            var form = $('#pay_form');
            var input = '<input type="hidden" name="_address_id" value="'+ _address_id +'">\
                        <input type="hidden" name="_product_id" value="'+ _product_id +'">\
                        <input type="hidden" name="_numbers" value="'+ _numbers +'">';
            form.append(input);
            form.submit();
        });

        $("#comment").on('submit', function(event){
            event.preventDefault();
            var obj =$(this) ;
            var url = $(this).attr('action');
            var data = $(this).serialize();    
            $.ajax({
                url:url,
                data:data,
                type:'post',
                success:function(res){
                    //console.log(res);
                     layer.msg(res.msg);
                     $(obj).hide();

                },
                error:function(res)
                {
                   
                    if(res.status == 422){
                          errmsg = JSON.parse(res.responseText).errors.content;
                    }
                   
                    if(res.status == 403)
                    {
                         errmsg = '无权发表评论' ;//alert('您无权发表评论');
                    }
                    $("#error").text(errmsg);
                }
            });

        });

        $("#comment textarea").on('focus', function(){
            $("#error").empty();
        });
    </script>
@endsection