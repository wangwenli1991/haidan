<?php

namespace App\Http\Controllers\Member;

use App\Model\Citys;
use App\Model\Images;
use App\Model\Members;
use App\Model\Spouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class Member extends Controller
{
    public function __construct()
    {
        $this->middleware('loginauth');
    }

    //个人中心
    public function index(){
       /* $auth=Auth::guard('home');
        if(!$auth->check()){
            return redirect('/Index/login')->with(['url.intended'=>'/Member/']);
        }
        $user=$auth->user();
        return view('Member.personal',compact('user'));//这个是视图Member目录下的personal*/
       return view('Member.personal');
    }
    //我的相片
    public function tupian(){
        $userid=Auth::guard('home')->id();//获取会员id
        $images=Members::select('id')->find($userid)->images;//调用Members模型里面的images方法
        if(!$images){
            $images=[];
        }
        return view('Member.photos',compact('images'));
       /* $auth=Auth::guard('home');
        if(!$auth->check()){
            return redirect('/Index/login')->with(['url.intended'=>'/Member/photos']);
        }
        $user=$auth->user();
            return view('Member.photos',compact('user'));*/
    }

    //图片上传，相册添加方法
    public function photosAdd(Request $request){
        $images=$request->only('goodsimages');
        $userinfo=Auth::guard('home')->user()->only('id','nickname');
        $insert=[];
        foreach ($images['goodsimages'] as $key=>$image){
            $res=$this->base64_image_content($image,'gallery');
            if(!$res){
                break;
            }else{
                    $imgres = $this->dealImg($res,268, 268, 1);
                    $insert[]=[
                        'tableid'=>$userinfo['id'],
                        'title'=>$userinfo['nickname'],
                        'path'=>$res,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ];
            }
        }
        if(!$res){
            return back()->withErrors('图片上传失败');
        }else{
            $result=Images::insert($insert);//可以插入一条或者多条数据,而create只能插入一条数据
            if($result){
                return back();
            }else{
                return back()->withErrors('图片上传失败');
            }
        }
    }
    //删除相册的图片，通过ajax删除
    public function photosDel(Request $request){
        if(!$request->has('ids')){
            return response()->json(['status'=>'n','content'=>'图片不存在']);
        }
        $ids=explode(',',$request->ids);
        $res=Images::whereIn('id',$ids)->update(  //把数据库里面的图片表的状态status设为0，表示不可见。whereIn方法：表示见手册262页
            ['status'=>0] //将状态设置成为0，表示不可见，为 0 就表示删除了
        );
        if($res){
            return response()->json(['status'=>'y','content'=>'删除成功']);
        }else{
            return response()->json(['status'=>'n','content'=>'删除失败']);
        }
    }
    /*会员基本资料*/
    public function memberinfo(){
        $info=Auth::guard('home')->user();  //传值
        $configs=config('mydataset');
        $provinces=Citys::where('parent_id','=',0)->select('id','name')->get();
        $dateshtml='';
        if($info->date!=='00'){
            $default=$info->date;
            $dateshtml=getmydate($info->year,$info->month,$default);
        }
        return view('Member.memberinfo',compact('info','configs','provinces','dateshtml'));//传值
    }
    /*会员基本资料保存*/
    public function infostore(Request $request){
        $input=$request->except('_token','_method');
        //规则验证
        $rules=[
            'qq'=>[
                'regex:/\d+/','nullable'
            ],
            'monologue'=>'min:10|max:300|nullable'
        ];
        $messages=[
            'qq.regex'=>'QQ格式不正确',
            'monologue.min'=>'至少十个字',
            'monologue.max'=>'最多三百字'
        ];
        $validate=validator($input,$rules,$messages);
        if($validate->fails()){
            $message=$validate->errors()->messages();
            return back()->withErrors($message);
        }
        $mid=Auth::guard('home')->id();
        $member=Members::find($mid);
        foreach($input as $key=>$value){
            $member->$key=$value;
        }
        $result=$member->save();//自动完成修改的时间
        dd($result);
    }

    /**展示择偶条件信息**/
    public function memberzheoinfo(){
        $info=Auth::guard('home')->user();//传值,获取用户信息
        $configs=config('mydataset');//获取配置文件mydataset的信息
        $provinces=Citys::where('parent_id','=',0)->select('id','name')->get();
        return view('Member.bojectconds',compact('info','configs','provinces'));//传值
    }
    /**保存择偶条件信息**/
    public function zheostore(Request $request){
        $input=$request->except('_token','_method');
        $mid=Auth::guard('home')->id();
        $spouse=Spouse::find($mid);
        foreach($input as $key=>$value){
            $spouse->$key=$value;
        }
        $result=$spouse->save();//自动完成修改的时间
        dd($result);
    }

}
