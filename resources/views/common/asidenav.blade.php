<aside id="personnavicates">
    <section id="headportrait">
        <div class="portraitbox">
            <img @if(auth('home')->user()->avators) src="{{auth('home')->user()->avators->path}}" @else src="/home/img/avatar/noavatar.jpg" @endif/>
        </div>
        <p class="portraitname"><span>{{auth('home')->user()->nickname}}</span><em>{{auth('home')->user()->account}}</em></p>
        <p class="portraitprove"><a class="proved" title="手机验证" href=""></a><a title="身份证验证" href=""></a><a title="邮箱验证" href=""></a></p>
    </section>
    <p class="balance-recharge">
						<span class="balance">余额
						    <span class="balance-money">￥<b>{{auth('home')->user()->balance}}</b></span>
						</span>
        <button class="recharge">
            充值
            <a class="torecharge" href="">去充值</a>
        </button>
    </p>
    <ul class="personalcatetogrys">
        <li>
            <a href="/Member"  @if(!isset($aside)) class="navicatehover" @endif>购物车</a>
        </li>
        <li>
            <a href="/Member/memberinfo"  @if(isset($aside)&&$aside=='base') class="navicatehover" @endif>基本资料</a>
        </li>
        <li>
            <a href="/Member/tupian"  @if(isset($aside)&&$aside=='photos') class="navicatehover" @endif>我的相片</a>
        </li>
        <li>
            <a href="/Member/memberzheoinfo" @if(isset($aside)&&$aside=='zheo') class="navicatehover" @endif>择偶条件</a>
        </li>
        <li>
            <a href="proveinfo.html">认证信息</a>
        </li>
        <li>
            <a href="mygifts.html">我的礼物</a>
        </li>
        <li>
            <a href="myaccost.html">话题自荐</a>
        </li>
        <li>
            <a href="mylove.html">我的喜欢</a>
        </li>
        <li>
            <a href="myinterview.html">我的访客</a>
        </li>
        <li>
            <a href="myrecord.html">消费记录</a>
        </li>
        <li>
            <a href="mysysset.html">个人设置</a>
        </li>
    </ul>
</aside>