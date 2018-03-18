@extends('layouts.user')

@section('style')
    <link href="{{ asset('assets/user/css/addstyle.css') }}" rel="stylesheet" type="text/css">
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
            <hr/>
            <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

                


            </ul>
            <div class="clear"></div>


            <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">修改地址</a>
            <!--例子-->


                {{ csrf_field() }}
                <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                    <div class="add-dress">

                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>update&nbsp;address</small></div>
                        </div>
                        <hr/>


                        @if (session()->has('status'))
                            <div class="am-alert am-alert-success" data-am-alert>
                                <button type="button" class="am-close">&times;</button>
                                <p>{{ session('status') }}</p>
                            </div>
                        @endif

                        @if ($errors->count())
                            <div class="am-alert am-alert-danger" data-am-alert>
                                <button type="button" class="am-close">&times;</button>
                                <p>{{ $errors->first() }}</p>
                            </div>
                        @endif


                        <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                            <form class="am-form am-form-horizontal" method="post" @isset($address) 
                            action="{{route('address.update', $address)}}" @else action="{{route('address.store')}}" @endisset >
                                {{ csrf_field() }}
                               

                                <div class="am-form-group">
                                    <label for="user-name" class="am-form-label">收货人</label>
                                    <div class="am-form-content">
                                        <input type="text" id="user-name" name="name" value="{{$address->name or ''}}" placeholder="收货人">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label">手机号码</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" name="phone" value="{{$address->phone or ''}}" placeholder="手机号必填" type="text" maxlength="11">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-address" class="am-form-label">所在地</label>
                                    <div class="am-form-content address">
                                        <div data-toggle="distpicker" align="left" bgcolor="#ffffff"">
                                            <select name="province" @isset($address) data-province="{{$address->province}}" @endisset></select>
                                            <select name="city" @isset($address) data-city="{{$address->city}}" @endisset></select>
                                            <select name="district" @isset($address) data-district="{{$address->district}}" @endisset></select>
                                        </div>    
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-form-label">详细地址</label>
                                    <div class="am-form-content">
                                        <textarea name="detail_address" class="" rows="3" id="user-intro" placeholder="输入详细地址">{{$address->detail_address or ''}}</textarea>
                                        <small>100字以内写出你的详细地址...</small>
                                    </div>
                                </div>
                                @isset($address) {{ method_field('PUT') }} @endisset
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button class="am-btn am-btn-danger">确定</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

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
    </div>

     <script type="text/javascript" src="{{asset('assets/js/distpicker/distpicker.data.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/distpicker/distpicker.js')}}"></script>
                @endsection

