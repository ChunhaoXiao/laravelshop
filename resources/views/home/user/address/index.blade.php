@extends('layouts.user')
@section('style')
    <link href="{{ asset('assets/user/css/addstyle.css') }}" rel="stylesheet" type="text/css">
    <style>
        .am-selected-list {
            height: 120px;
            overflow-y: scroll;
        }
    </style>
    <script src="{{ asset('assets/user/AmazeUI-2.4.2/assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/user/AmazeUI-2.4.2/assets/js/amazeui.js') }}"></script>
@endsection

@section('main')
<div class="main-wrap">

    <div class="user-address">
            <!--标题 -->
             <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
            </div>
			<p><a href="{{route('address.create')}}" class="btn btn-primary">添加地址</a></p>
            <hr/> 
            <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

                @foreach ($addresses as $address)
                    <li class="user-addresslist {{ $address->is_default ? 'defaultAddr' : '' }}">
                        <span class="new-option-r default_addr" data-id="{{ $address->id }}">
                            <i class="am-icon-check-circle"></i>默认地址
                        </span>
                        <p class="new-tit new-p-re">
                            <span class="new-txt">{{ $address->name }}</span>
                            <span class="new-txt-rd2">{{ $address->phone }}</span>
                        </p>
                        <div class="new-mu_l2a new-p-re">
                            <p class="new-mu_l2cw">
                                <span class="title">地址：</span>
                                <span class="province">{{ $address->province }}</span>省
                                <span class="city">{{ $address->city }}</span>市
                                <span class="dist">{{ $address->region }}</span>区
                                <br>
                                <span class="street">{{ $address->detail_address }}</span></p>
                        </div>
                        <div class="new-addr-btn">
                            <a href="{{ route('address.edit',$address) }}"><i class="am-icon-edit"></i>编辑</a>
                            <span class="new-addr-bar">|</span>
                            <a  data-url="{{route('address.destroy',$address)}}"  class="delete_address">
                                <i class="am-icon-trash"></i>删除
                            </a>
                            
                        </div>
                    </li>
                @endforeach


            </ul>
        </div>

</div>


<script type="text/javascript">
            $(document).ready(function() {
                $(".new-option-r").click(function() {
                    $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                });

                var $ww = $(window).width();
                if($ww>640) {
                    $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                }

            })
        </script>

        <div class="clear"></div>
{{ method_field('PUT') }}
    @endsection


@section('script')
    <script src="{{ asset('assets/user/layer/2.4/layer.js') }}"></script>

    
    <script>
        //删除收获地址

        $('.delete_address').click(function(){
            //var id = $(this).data('id');
            var url = $(this).data('url');
            var that = $(this);
            $.ajax({
                url:url,
                type:'delete',
                success:function(res){
                    that.parent().parent().remove();
                },
                error:function(res){
                    console.log(res);
                }
            });

            /*$.post(_url, {_token:'{{ csrf_token() }}', type:'DELETE'}, function(res){
                console.log($res);
                if (res.code == 0) {
                    that.parent().parent().remove();
                }

                layer.msg(res.msg);
            });*/
        });
        
        //设置默认收货地址

        $('.default_addr').click(function(){
            var id = $(this).data('id');
            var url = "{{url('user/address') }}/"+id;
            $.ajax({
                url:url,
                data:{is_default:1},
                type:'put',
                success:function(res){
                     layer.msg(res.msg);
                }
            });

            /*$.post(_url, {_token:'{{ csrf_token() }}'}, function(res){
                if (res.code == 0) {

                }

                layer.msg(res.msg);
            });*/
        });
        
       /* $('select[name=province]').change(function () {
            var id = $(this).val();
            var url = "{{ url('user/addresses/cities') }}/" + id;

            $.get(url, function(res){


                var text = '';
                for (var i in res) {

                    text += '<option value="'+ res[i].id +'">'+ res[i].name +'</option>';
                }

                $('select[name=city]').html(text);
            });
        });*/
    </script>
@endsection