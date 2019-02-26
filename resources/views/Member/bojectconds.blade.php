@extends('common.homebase')
@section('head')
	<title>基本资料</title>
	<link rel="stylesheet" href="/home/css/personal.css" />
{{--	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="0">--}}
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
	@include('common.asidenav',['aside'=>'zheo'])
		<!--左边结束-->
		<!--右边开始-->
		<section class="personalcatecontents">
			<section class="personalcatebox">
				<form action="/Member/zheostore" method="post">
					{{method_field('PUT')}}
					{{csrf_field()}}
					<table class="goodslist">
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
							<th>年龄：</th>
							<td>
								<select name="age" class="shortselect">
									@foreach($configs['age'] as $key=>$age)
										<option @if($info->age==$key) selected @endif value="{{$key}}">{{$age}}</option>
									@endforeach
								</select>
								<span>-</span>
								<select name="age" class="shortselect">
									@foreach($configs['age'] as $key=>$age)
										<option @if($info->age==$key) selected @endif value="{{$key}}">{{$age}}</option>
									@endforeach
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

								<select name="city" class="shortselect" onchange="gaibian()">
									<option value="">未知</option>
								</select>
							</td>
							<td></td>
						</tr>
						<tr class="personinfo">
							<th>身高：</th>
							<td>
									<select name="hign" class="shortselect">
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
							<th>有无照片：</th>
							<td>
								<select name="has_photos">
									@foreach($configs['has_photos'] as $key=>$hasphotos)
										<option @if($info->hasphotos==$key) selected @endif value="{{$key}}">{{$hasphotos}}</option>
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
    if(selectedpro){
        var value=$("select[name='province']").val();
        $.post('/getcitynext',{id:value},function (res) {
            $("select[name='city']").html(res);
            $("select[name='city']").val(selectedcity);
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
</script>
@endsection
