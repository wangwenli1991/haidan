@extends('common.adminbase')
@section('title')
<title>会员管理</title>
@endsection

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="/Member/adminlist" method="get">
	<div class="text-c"> 日期范围：
		<input type="text" @if(isset($gets['starttime'])) value="{{$gets['starttime']}}" @endif name="starttime" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" @if(isset($gets['endtime'])) value="{{$gets['endtime']}}" @endif name="endtime" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" @if(isset($gets['account'])) value="{{$gets['account']}}" @endif name="account" class="input-text" style="width:250px" placeholder="输入会员名称" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜会员</button>
	</div>
	</form>

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel('members')" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <span class="r">共有数据：<strong>{{$date->total()}}</strong>条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"></th>
				<th width="80">账号</th>
				<th width="50">昵称</th>
				<th width="80">图像</th>
				<th width="40">性别</th>
				<th width="40">余额</th>
				<th width="50">年龄</th>
				<th width="120">地址</th>
				<th width="">上次登录时间</th>
				<th width="130">注册时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		@forelse($date as $info)
			<tr class="text-c">
				<td><input type="checkbox" value="{{$info->id}}" name="ids[]"></td> <!--批量删除-->
				<td>{{$info->account}}</td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$info->nickname}}','/Member/membershow/{{$info->id}}','10001','360','400')">{{$info->nickname}}</u></td>
				<td><img style="width: 100%;" @if($info->avators) src="{{$info->avators->path}}" @endif/></td>
				<td>{{config('mydataset.sex')[$info->sex]}}</td>
				<td>{{$info->balance}}</td>
				<td>{{date('Y')-$info->year}}</td>
				<td>{{getNameById($info->province)}}{{getNameById($info->city)}}{{getNameById($info->distinct)}}</td>
				<td>{{$info->last_login_time}}</td>
				<td>{{$info->created_at}}</td>
				<td class="td-status">
					@if($info->status)
						<span class="label label-success radius">已启用</span>
					@else
						<span class="label label-default radius">已停用</span>
					@endif
				</td>
				<td class="td-manage">
                    @if($info->status)
                        <a title="停用" style="text-decoration:none" onClick="member_stop(this,'{{$info->id}}','members',0)" href="javascript:;"><i class="Hui-iconfont">&#xe631;</i></a>
                    @else
                        <a title="启用" style="text-decoration:none" onClick="member_start(this,'{{$info->id}}','members',1)" href="javascript:;"><i class="Hui-iconfont">&#xe631;</i></a>
                    @endif
                        <a title="删除" style="text-decoration:none" onClick="member_del(this,'1')" href="javascript:;"  class="ml-5" ><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
			</tr>
		@empty
			<tr>
				<td colspan="12" class="text-c">
					暂无图片
				</td>
			</tr>
		@endforelse
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12" class="text-r">
					{{ $date->appends($gets)->links() }}
				</td>
			</tr>
		</tfoot>
	</table>
	</div>
</div>
@endsection
<!--_footer 作为公共模版分离出去-->

@section('javascript')
	@parent
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }

    /*用户-删除*/
    function member_del(obj,id,model,status){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
@endsection