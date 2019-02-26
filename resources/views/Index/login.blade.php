@extends('common.homebase')
@section('head')
    <link rel="stylesheet" href="/home/css/login.css" />
@endsection
@section('header')
<header>
    <div id="header">
        <img class="logopng" src="/home/img/logo.png" />
        <img class="logotxtpng" src="/home/img/logo_txt.png" />
    </div>
</header>
@endsection

@section('content')
<form action="/Index/autologin" method="post">
    {{csrf_field()}}
    <div id="logincontent">
        <div class="login-box">
            <div class="loginform-box">
                <p class="logintext">会员登录</p>
                <div class="formcontent">
                    <p class="input-cont">
                        <span>登录账号</span><input name="account" class="logincont" type="text" placeholder="手机号" @if(old('account')) value="{{old('account')}}" @endif @if(session('account')) value="{{session('account')}}" @endif/>
                    </p>
                    <p class="input-cont">
                        <span>密&nbsp;&nbsp;&nbsp;&nbsp;码</span><input name="password" class="logincont" type="password" placeholder="密码" @if(old('password')) value="{{old('password')}}" @endif @if(session('password')) value="{{session('password')}}" @endif/>
                    </p>
                    <p class="input-auto">
                        <span></span><label><input name="remember" value="1" type="checkbox" @if(old('remember')) checked @endif>两周内自动登录</label>
                    </p>
                    <p class="input-bnt">
                        <button>登录</button><a href="#">忘记密码</a>
                    </p>

                    <p class="input-auto">
                        @foreach($errors->all() as $error)
                            <b style="color: red;font-size: 15px;align:center">{{$error}}</b><br/>
                        @endforeach<!--这里是点击登录验证规则-->
                    </p>

                    <p class="login-register">
                        <a href="{{ url('/Index/register') }}">还不是会员，立即注册</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('javascript')
@endsection
