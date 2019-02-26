@extends('common.homebase')
@section('head')
		<title>基本资料</title>
		{{--<link rel="stylesheet" href="/home/css/common.css" />--}}
		<link rel="stylesheet" href="/home/css/personal.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
		<!--头部开始-->
@section('header')
	@include('common.header')
	@include('common.nav',['_selected_'=>'center'])
@endsection
		<!--头部结束-->
@section('content')
		<section id="personalbigbox">
			<section id="personalbox" class="clear">
				<!-- 左边开始-->
			@include('common.asidenav',['aside'=>'base'])
				<!--左边结束-->
				<!--右边开始-->
				<section class="personalcatecontents">
					<section class="personalcatebox">
						<form action="/Member/infostore" method="post">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            {{--<input type="hidden" value=""/><!--添加一个隐藏框-->--}}
						<table class="goodslist">
							<tr class="personinfo">
								<th>昵称：</th>
								<td><input name="nickname" value="{{$info->nickname}}" type="text"/></td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>账号：</th>
								<td><input name="account" disabled value="{{$info->account}}" type="text"/></td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>QQ：</th>
								<td><input name="qq" value="{{$info->qq}}" type="text"/></td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>微信：</th>
								<td><input name="weixin" value="{{$info->weixin}}" type="text"/></td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>性别：</th>
								<td>
									<select name="sex">
										@foreach($configs['sex'] as $key=>$sex)
											<option @if($info->sex==$key) selected @endif value="{{$key}}">{{$sex}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>出生年月日：</th>
								<td>
									<select name="year" onchange="selectmonth()" class="shortselect">
										@foreach($configs['years'] as $year)
											<option @if($info->year==$year) selected @endif value="{{$year}}">{{$year}}</option>
										@endforeach
									</select>
									<select name="month" onchange="selectdate(this)" class="shortselect">
										@foreach($configs['month'] as $m)
											<option @if($info->month==$m) selected @endif value="{{$m}}">{{$m}}</option>
										@endforeach
									</select>
									<select name="date" class="shortselect">
                                        @if(!$dateshtml)
										<option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        @else
                                            {!! $dateshtml !!}
                                        @endif
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>婚姻状况：</th>
								<td>
									<select name="marry_status">
										@foreach($configs['marry_status'] as $key=>$marry_status)
											<option @if($info->marry_status==$key) selected @endif value="{{$key}}">{{$marry_status}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>学历：</th>
								<td>
									<select name="education">
										@foreach($configs['educations'] as $key=>$educations)
											<option @if($info->education==$key) selected @endif value="{{$key}}">{{$educations}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>目前居住地：</th>
								<td>
									<select name="province" onchange="selectnext(this,'city')" class="shortselect"><!--加一个值变事件onchange-->
                                        <option value="">未知</option>
                                        @foreach($provinces as $province)
                                            <option @if($info->province==$province->id) selected @endif value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
									</select>

									<select name="city" onchange="selectnext(this,'distinct')" class="shortselect">
                                        <option value="">未知</option>
									</select>

									<select name="distinct" class="shortselect">
                                        <option value="">未知</option>
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>身高：</th>
								<td>
									{{--<input name="sex" type="text" value=""/>--}}
									{{--自己加一个select--}}
									<select name="hign">
										@foreach($configs['hign_types'] as $key=>$hign_types)
											<option @if($info->hign==$key) selected @endif value="{{$key}}">{{$hign_types}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>月收入：</th>
								<td>
									<select name="salary">
										@foreach($configs['salarys'] as $key=>$salarys)
											<option @if($info->salary==$key) selected @endif value="{{$key}}">{{$salarys}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>住房条件：</th>
								<td>
									<select name="house_cond">
										@foreach($configs['house_conds'] as $key=>$house_conds)
											<option @if($info->house_cond==$key) selected @endif value="{{$key}}">{{$house_conds}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>有无孩子：</th>
								<td>
									<select name="has_child">
										@foreach($configs['has_childs'] as $key=>$has_childs)
											<option @if($info->has_child==$key) selected @endif value="{{$key}}">{{$has_childs}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>从事行业：</th>
								<td>
									<select name="industry">
										@foreach($configs['industrys'] as $key=>$industrys)
											<option @if($info->industry==$key) selected @endif value="{{$key}}">{{$industrys}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>民族：</th>
								<td>
									<select name="nation">
										@foreach($configs['nations'] as $key=>$nations)
											<option @if($info->nation==$key) selected @endif value="{{$key}}">{{$nations}}</option>
										@endforeach
									</select>
								</td>
								<td></td>
							</tr>
							<tr class="personinfo">
								<th>内心独白：</th>
								<td>
									<textarea style="width:100%;height:100px;font-size: 14px" placeholder="" id="hearttell" name="monologue">
										{{$info->monologue}}
									</textarea>
								</td>
								<td>建议100字左右</td>
							</tr>
							<tr class="personinfo">
								<th></th>
								<td>
									<button>确认保存</button>
								</td>
								<td></td>
							</tr>
						</table>
						</form>
					</section>
				</section>
				<!--右边结束-->
			</section>
		</section>
@endsection
		<!-- 底部开始-->

		<!-- 底部结束-->
@section('javascript')
    <script charset="utf-8" src="/lib/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="/lib/kindeditor/lang/zh_CN.js"></script>
		<script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var selectedpro="{{$info->province}}";
            var selectedcity="{{$info->city}}";
            var Distinct="{{$info->distinct}}";
            if(selectedpro){
                var value=$("select[name='province']").val();
                $.post('/getcitynext',{id:value},function (res) {
                    $("select[name='city']").html(res);
                    $("select[name='city']").val(selectedcity);
                });
                $.post('/getcitynext',{id:selectedcity},function (res) {
                    $("select[name='distinct']").html(res);
                    $("select[name='distinct']").val(Distinct);
                });

            }
			$(function(){
				$(".balance").hover(function(){
					$('.balance-money').animate({'top':'0px'},200);
				},function(){
					$('.balance-money').animate({'top':'40px'},200);
				});
				$(".recharge").hover(function(){
					$('.torecharge').animate({'top':'0px'},200);
				},function(){
					$('.torecharge').animate({'top':'40px'},200);
				});
			})

            /*根据省份选择城市*/
            function selectnext(obj,type){
                var value=$(obj).val();
                $.post('/getcitynext',{id:value},function (res) {
                    console.log(res);
                    $("select[name="+type+"]").html(res);
                    if(type=='city'){
                        $("select[name='district']").html('<option>未知</option>');
                    }
                });
            }
            /*选择日期*/
            function selectdate(obj){
                var value=$(obj).val();
                var year=$("select[name='year']").val();
                $.post('/getmydate',{month:value,year:year},function (res) {
                    $("select[name='date']").html(res);
                })
            }
            /*选择月份*/
            function selectmonth(){
                var str='<option value="1">1</option>'+
                        '<option value="2">2</option>'+
                        '<option value="3">3</option>'+
                        '<option value="4">4</option>'+
                        '<option value="5">5</option>'+
                        '<option value="6">6</option>'+
                        '<option value="7">7</option>'+
                        '<option value="8">8</option>'+
                        '<option value="9">9</option>'+
                        '<option value="10">10</option>'+
                        '<option value="11">11</option>'+
                        '<option value="12">12</option>';
                $("select[name='month']").html(str);
                var value=$("select[name='month']").val();
                var year=$("select[name='year']").val();
                $.post('/getmydate',{month:value,year:year},function (res) {
                    $("select[name='date']").html(res);
                })
            }
		</script>
@endsection
