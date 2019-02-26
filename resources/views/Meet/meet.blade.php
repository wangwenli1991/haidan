@extends('common.homebase')
@section('head')
		<link rel="stylesheet" href="/home/css/meet.css" />
@endsection
		<!--头部开始-->

@section('header')
	@include('common.header')
	@include('common.nav',['_selected_'=>'meet'])
@endsection
		<!--头部结束-->
		<!--搜索栏开始-->
@section('content')
		<section id="search-bigbox">
			<form>
			<section id="search-box">
					<div class="searchtagbox">
						<p class="seachtagtitle">选择一个符合他/她的标签<span>有标签用户才会被搜到！<a href="">完善资料</a> 或  <a>回答QA</a>可获得标签</span></p>
						<p class="seachtags"><span>兴趣爱好：</span><a href="">摄影</a><a href="">乐器</a><a href="">小说</a><a href="">名著</a><a href="">追星</a><a href="">追剧</a><a href="">游戏</a><a href="">旅游</a><a href="">户外</a><a href="">健身</a></p>
						<p class="seachtags"><span>性格特点：</span><a href="">沉熟稳重</a><a href="">沉默寡言</a><a href="">阳光开朗</a><a href="">古灵精怪</a><a href="">诙谐幽默</a><a href="">易怒偏激</a><a href="">锋芒毕露</a><a href="">随遇而安</a><a href="">重情孝顺</a></p>
						<p class="seachtags"><span>工作情况：</span><a href="">有上进心</a><a href="">事务繁忙</a><a href="">稳定</a><a href="">福利好</a></p>
						<p class="seachtags"><span>其他标签：</span><a href="">富有</a><a href="">丁克</a><a href="">基情</a><a href="">铁公鸡</a><a href="">百事通</a></p>
					</div>	
					<div class="seachcondbox">
						<p><span>筛&nbsp;&nbsp;&nbsp;&nbsp;选：</span>
							<select class="address">
								<option>湖南</option>
							</select>
							<select class="address">
								<option>长沙</option>
							</select>
							<select class="age">
								<option>性别</option>
							</select>
							<select class="age">
								<option>18岁</option>
							</select>
							至
							<select class="age">
								<option>25岁</option>
							</select>
							<select class="age">
								<option>未婚</option>
							</select>
							<select class="age">
								<option>本科</option>
							</select>
							<select class="age">
								<option>160cm-170cm</option>
							</select>
							<select class="age">
								<option>IT行业</option>
							</select>
							<select class="age">
								<option>10000-12000</option>
							</select>
							<select class="age">
								<option>巨蟹座</option>
							</select>
						</p>
						<p>
							<button class="searchbtn" type="button">确定</button>
						</p>
					</div>
			</section>
			</form>
		</section>
		<!--搜索栏结束
			人物展示开始			
		-->
		<section id="searchpersons">
			<section id="searchpersonbox">
				<p class="reloadpersons"><label><i></i>换一批</label></p>
				<div class="personsbox">
					<ul class="personsul">
						<li class="persons">
							<img src="/home/img/person/chijuzijiukaixin.jpg"/>
							<p><b>吃橘子就很开心</b><span>25岁</span><span>湘潭</span><span>172cm</span><span>本科</span><span>2000元以下</span></p>
						</li>
						<li class="persons">
							<img src="/home/img/person/clown.jpg"/>
							<p><b>吃橘子就很开心</b><span>25岁</span><span>湘潭</span><span>172cm</span><span>本科</span><span>2000元以下</span></p>
						</li>
						<li class="persons">
							<img src="/home/img/person/haha.jpg"/>
							<p><b>吃橘子就很开心</b><span>25岁</span><span>湘潭</span><span>172cm</span><span>本科</span><span>2000元以下</span></p>
						</li>
					</ul>
					<div class="personselect">
						<div class="selectfeel">
							<div onclick="selectfeel(-1)">
								<p>没感觉</p>
							</div>
							<div onclick="selectfeel(0)">
								<p>可考虑</p>
							</div>
							<div onclick="selectfeel(1)">
								<p>很喜欢</p>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
@endsection
		<!--人物展示结束-->
@section('javascript')
	<script type="text/javascript" src="/home/js/func.js" ></script>
@endsection
