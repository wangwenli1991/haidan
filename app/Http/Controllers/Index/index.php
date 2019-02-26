<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Model\Images;
use App\Model\Members;
use App\Model\Spouse;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\ThrottlesLogins;
class index extends Controller
{
    use ThrottlesLogins;
    public function username(){
        return 'account';
    }

    public function index(){
        $title="主页controller/index/index";
        $status=1;
        $test=0;
        return view('Index.index',compact('title', 'status','test'));
    }
    public function home(){
        $date=[
              '/Home/img/banner1.jpg',
              '/Home/img/banner2.jpg',
              '/Home/img/banner3.jpg'
        ];
        $title="<title>首页</title>";
        return view('Index.home',['login'=>true,'carousel'=>$date,'title'=>$title]);
    }

    public function login(){
        session()->keep('url.intended');
        return view('Index.login',compact('login'));
    }

    public function autologin(Request $request){
        $input=$request->except('_token');
        $rules=[
            'account'=>[
                'required','regex:/^1[3-9]\d{9}$/'
            ],
            'password'=>[
                'required','regex:/([a-zA-Z]+\d+)|(\d+[a-zA-Z]+)/'
            ]
        ];
        $message=[
            'account.required'=>'账号必填',
            'password.required'=>'密码必填',
            'account.regex'=>'账号是手机号码',
            'password.regex'=>'密码是由字母和数字组成'
        ];
        $vaildate=validator($input,$rules,$message);
        if($vaildate->fails()){
            $messages=$vaildate->errors()->messages();
            return back()->withErrors($messages)->withInput();
        }
        if($this->hasTooManyLoginAttempts($request)){//如果请求次数过多
            $this->fireLockoutEvent($request);//锁定登录
            return back()->withErrors('登录失败次数过多，请稍后再试');
        }
        //验证账号密码是否正确
        $remember=$request->has('remember');
        $res=Auth::guard('home')->attempt(['account'=>$input['account'],'password'=>$input['password']],$remember);
        // dd($res);

        if($res){
            return redirect()->intended('/Index/');//跳转到原来想进入的页面
        }else{
            //记录登录次数
            $this->incrementLoginAttempts($request);
            return back()->withErrors("登录失败，请重试")->withInput();
        }
    }


    public function register(){
        $login=false;
        return view('Index.register',compact('login'));
    }

    public function store(Request $request){
        $date=$request->except('_token');
        $rules=[
            'nickname'=>'required|string|min:2|max:20',
            'avator'=>'required|string',
            'account'=>[
                'required','unique:members,account','regex:/^1[3-9]\d{9}$/'
            ],
            'password'=>['required','regex:/([a-zA-Z]+\d+)|(\d+[a-zA-Z]+)/','confirmed'],
            'monologue'=>'nullable|min:10|max:300'
        ];
        $message=[
            'nickname.required'=>'昵称必须要填',
            'avator.required'=>'图像必须要填',
            'account.required'=>'手机号必须要填',
            'password.required'=>'密码必须要填',
            'nickname.string'=>'昵称必须是字符串',
            'nickname.min'=>'昵称至少要有2个字',
            'nickname.max'=>'昵称最多只能有20个字',
            'account.unique'=>'该手机号账号已存在',
            'account.regex'=>'手机号必须是11位',
            'password.regex'=>'密码必须由数字和英文字母组成',
            'password.confirmed'=>'密码不一致，请重新输入',
            'monologue.min'=>'至少10个字',
            'monologue.max'=>'最多300个字',
        ];
        $validate=validator($date,$rules,$message); //执行验证
        if($validate->fails()){  //如果验证规则失败
            $messages=$validate->errors()->messages();//验证失败了，就带回错误消息
            //dd($messages);
            return back()->withErrors($messages)->withInput();//然后我们要把错误消息在页面上显示出来
        }

        //图像处理
        $res=$this->dealImg($date['avator'],268,268,1);//这里的dealImg方法是调用的Controller.php文件中的
        if(!$res){ //如果处理失败
            return back()->withErrors('图片不存在')->withInput();//withErrors():带回一个错误消息，withInput():把内容也带回去
        }

        //往数据库中插入数据
        //第一，先插入图片表的数据
        $imgid=Images::create([
            'title'=>$date['nickname'],
            'type'=>0,
            'path'=>$date['avator']
        ])->id;
        //第二，再插入会员表的数据
        if($imgid){
            DB::beginTransaction();//开启事务，注意，引擎一定要支持事务，如果你的引擎不支持事务，要改一下，改了之后，要运行一下
            $mid=Members::create([
                'nickname'=>$date['nickname'],
                'account'=>$date['account'],
                'password'=>bcrypt($date['password']),
                'avator'=>$imgid,
                'monologue'=>$date['monologue'],
                'last_login_time'=>date('Y-m-d H-i-s')
            ])->id;
            //其次，插入择偶表的数据，insertGetID函数是和create差不多的，只是insertGetID不支持timestamps
            $spid=Spouse::insertGetID([  //这里使用insertGetID，是因为我们不需要timestampss
                'mid'=>$mid,
                'sex'=>$date['selectsex']
            ]);
            if($spid){
                DB::commit();   //提交事务
                return redirect('/Index/login')->with(['account'=>$date['account'],'password'=>$date['password']]);
            }else{
                DB::rollBack(); //回滚事务
                return back()->withErrors('注册失败，请重试')->withInput();
            }
        }

    }
    //退出
    public function logout(){
        Auth::guard('home')->logout();
        return redirect('/Index/');
    }
}
