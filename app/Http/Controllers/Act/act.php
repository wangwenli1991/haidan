<?php

namespace App\Http\Controllers\Act;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class act extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)//这里注意，当打Request的时候，不要直接打完，回车Request，就会自动加载一个use 如上
    {
        //以下三种方法输入：http://www.php1827.com/Act即可访问
        //下面是三种生成路径的方法
        //echo url('Act/12');
        // echo action('Act\act@show',['id'=>12]);
        //echo route('index.membervip');//这个是通过路由命名来获取网址，然后通过网址访问vit.php下面的index()方法
        //跳转至某个方法（有以下两种方法），这里跳转show()方法为例：如下
        // return redirect()->route('Act.show',['id'=>12]);//输入 http://www.php1827.com/Act 即可跳转
         return redirect('Act/12');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo __METHOD__;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        echo __METHOD__;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        echo __METHOD__;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        echo __METHOD__;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        echo __METHOD__;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo __METHOD__;
    }


    public function test(){
        echo "这是我在act.php文件中自己建的test()方法";//访问输入：http://www.php1827.com/Act/test
    }
}
