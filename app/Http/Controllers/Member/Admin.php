<?php

namespace App\Http\Controllers\Member;

use App\Model\Members;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Admin extends Controller
{
    //
    public function adminlist(Request $request){
        $gets=$request->only('account','starttime','endtime');
        $where=[];
        if(isset($gets['account'])){
            $where[]=['account','like','%'.$gets['account'].'%'];
        }
        if(isset($gets['starttime'])){
            $where[]=['created_at','>',$gets['starttime']];
        }
        if(isset($gets['endtime'])){
            $where[]=['created_at','<=',$gets['endtime']];
        }
        $date=Members::select('id','nickname','avator','account','sex','balance','year','province',
            'city','distinct','status','created_at','last_login_time')->where($where)->paginate(5);
        return view('Member.memberlist',compact('date','gets'));
    }

    /*展示会员信息membershow*/
    public function membershow($id){
        $data=Members::select('id','nickname','avator','monologue','sex','year','month','date','province',
            'industry','nation','salary','hign','qq','weixin','marry_status','education','house_cond','has_child')->find($id);
        $configs=config('mydataset');
        return view('Member.membershow',compact('data','configs'));
    }
}
