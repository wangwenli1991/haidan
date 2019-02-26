<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20 0020
 * Time: 16:57
 */

/*获取日期*/
function getmydate($year,$month,$default=0){
    $str='';
    $max=[1,3,5,7,8,10,12];
    $arr=range(1,28);
    foreach($arr as $value){
        if($default==$value){
            $str.='<option selected value="'.$value.'">'.$value.'</option>';
        }else{
            $str.='<option value="'.$value.'">'.$value.'</option>';
        }
    }
    if($month==2){
        if($year%4){ //判断是否为闰年：闰年29天，平年28天 例如：2000年是闰年有29天.$year%4==0 && $year!=100)||$year%400==0

        }else{
            if($default==29){
                $str.='<option selected value="29">29</option>';
            }else{
                $str.='<option value="29">29</option>';
            }
        }
    }else{
        for($i=29;$i<=30;$i++){
            if($default==$i){
                $str.='<option selected value="'.$i.'">'.$i.'</option>';
            }else{
                $str.='<option value="'.$i.'">'.$i.'</option>';
            }
        }
        if(in_array($month,$max)){
            if($default==31){
                $str.='<option selected value="31">31</option>';
            }else{
                $str.='<option value="31">31</option>';
            }
        }
    }
    return $str;
}

/**/
function getNameById($id){
    if($id==0){
        return "未知";
    }else{
        return \Illuminate\Support\Facades\DB::table('citys')->where('id','=',$id)->value('name');
    }
}