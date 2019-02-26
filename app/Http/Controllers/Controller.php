<?php

namespace App\Http\Controllers;


use App\Model\Citys;
use http\Env\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function uploadImg(Request $request){
        if($request->hasFile('imgFile')){   //imgFile,用dd()来打印一下$data就可以看见了
            $data=$request->file('imgFile');//接收文件信息
        }
        if($data->isValid()){
            $path=$data->store('TuPian');//上传的目录路径在，storage/app/uploads,前提是要打开php_fileinfo扩展（在phpstudy里面）
            $res=[
                'url'=>'/storage/'.$path,//权限
                'error'=>0,
                'message'=>'上传成功'
            ];
            return response()->json($res);
        }
        /* 上传图片我们需要几步：1.用cmd进入项目目录 -> php artison storage:link  生成一个软链 ；
                               2.修改config
        */
    }

    public function dealImg($img,$width,$height,$water=0){  //这个dealImg方法用在了index.php中的store方法中
        $imagepath=$this->getImagePath();
        $tmpavator=str_after($img,$imagepath['prefix']);
        $path=$imagepath['root'].$tmpavator;
        $realpath=preg_replace('/\//','\\',$path);
        if(!file_exists($realpath)){
            return false;
        }
        $imgModel=Image::make($realpath);//这个Image，不要自己打完，选择Intervention\Image\Facades
        $reszie=$imgModel->resize($width,$height);  //压缩图片大小
        if($water){
            $waterImg=public_path().'\water.png';  //这个是水印图片
            $reszie->insert($waterImg,'bottom-left',0,10);//把这个水印图片放在哪个位置
        }
        $reszie->save($realpath); //一定要记得保存一下
        return true;  //成功返回true
    }

    public function getImagePath(){ //这个是吧图片的公平用的拿出来
        $default=config('filesystems.default');//config是获取所有的配置文件，这里获取的是config\filesystems.php中的default
        $root=config('filesystems.disks.'.$default.'.root');
        $url=config('filesystems.disks.'.$default.'.url');
        $tmpurl=str_after($url,env('APP_URL')); //获取env('APP_URL')之后的地址
        return ['root'=>$root,'prefix'=>$tmpurl];
    }

    //将base64编码图片数据还原成图片文件，并放在指定文件下
    public function base64_image_content($base64_image_content,$path=''){
        //匹配出图片的格式,返回匹配搜索到的数据$result
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];//获取图片类型
            $imagepath=$this->getImagePath();
            $new_path =$imagepath['root'].'\\'.$path;
            $new_path=preg_replace('/\//','\\',$new_path);
            if(!is_dir($new_path)){
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                @mkdir($new_path,0777,true);
            }
            //创建图片文件
            $newfile = rtrim($new_path,'/').'\\'.date('YmdHis',time()).mt_rand(10000,99999).'.'.$type;
            //打开文件
            $file=fopen($newfile,'w') or die('图片不能创建，请重试');
            $str=base64_decode(str_replace($result[1], '', $base64_image_content));//将base64编码解码
            fwrite($file,$str);//写入图片内容
            fclose($file);//关闭文件
            $root=preg_replace('/\//','\\',$imagepath['root']);
            $finalpath=str_after($newfile,$root);
            $finalpath=$imagepath['prefix'].$finalpath;
            $finalpath=preg_replace('/\\\/','/',$finalpath);
            return $finalpath;
        }else{
            return false;
        }
    }

    //城市联动
    public function getCitysNext(Request $request){
        $id=$request->id;   //这里容易出错，我之前id后面多打了一对括号
        $next=Citys::where('parent_id','=',$id)->select('id','name')->get();
        $str='<option value="0">未知</option>';
        foreach($next as $val){
            $str.='<option value="'.$val->id.'">'.$val->name.'</option>';
        }
        return response($str);
    }

    //选择日期
    public function getMyDate(Request $request){
        $month=$request->month;
        $str='';
        $year=$request->year;
        $max=[1,3,5,7,8,10,12];
        $arr=range(1,28);
        foreach($arr as $value){
            $str.='<option value="'.$value.'">'.$value.'</option>';
        }
        if($month==2){
            if($year%4){ //判断是否为闰年：闰年29天，平年28天 例如：2000年是闰年有29天.$year%4==0 && $year!=100)||$year%400==0

            }else{
                $str.='<option value="29">29</option>';
            }
        }else{
            for($i=29;$i<=30;$i++){
                $str.='<option value="'.$i.'">'.$i.'</option>';
            }

            if(in_array($month,$max)){
                $str.='<option value="31">31</option>';
            }
        }
        return response($str);
    }

    /* www.php1827.com/Admin 列表页的启用与停用*/
    public function startAndStop(Request $request){
        $data=$request->only('model','id','status');
        $res=DB::table($data['model'])->where('id','=',$data['id'])->update([
            'status'=>$data['status'],'updated_at'=>now()
        ]);
        if($res!==false){
            return response()->json(['status'=>'y','content'=>'操作成功']);
        }else{
            return response()->json(['status'=>'n','content'=>'操作失败']);
        }
    }
    /*批量删除，也就是批量停用*/
    public function  deleteAll(Request $request){
        $data=$request->only('model','ids');
        $ids=explode(',',$data['ids']);
        array_pop($ids);
        $res=DB::table($data['model'])->whereIn('id',$ids)->update([
            'status'=>0,'updated_at'=>now()
        ]);
        if($res!==false){
            return response()->json(['status'=>'y','content'=>'操作成功']);
        }else{
            return response()->json(['status'=>'n','content'=>'操作失败']);
        }

    }
}
