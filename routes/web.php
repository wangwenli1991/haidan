<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/code',function(){
    $code= \DB::table('mm_members');

});


Route::get('/','Index\index@index');//这个是用来访问项目的
Route::post('/uploadImg','Controller@uploadImg');
Route::post('/getcitynext','Controller@getCitysNext');/*根据省份选择城市的 selectnext 的方法*/
Route::post('/startandstop','Controller@startAndStop');//列表页的启用与停用
Route::post('/deleteall','Controller@deleteAll');//批量删除
Route::post('/getmydate','Controller@getMyDate');

Route::prefix('Index')->namespace('Index')->group(function(){
    Route::get('/','index@home');
    Route::get('/login','Index@login');
    Route::post('/autologin','Index@autologin');
    Route::get('/logout','Index@logout');//退出
    Route::get('/register','Index@register');//注册
    Route::post('/store','Index@store'); //保存
});
Route::prefix('Shop')->namespace('Shop')->group(function(){
    Route::get('/','Shop@index');
});
Route::prefix('Member')->namespace('Member')->group(function(){
    Route::get('/','Member@index');
    Route::get('/tupian','Member@tupian');
    Route::post('/photosAdd','Member@photosAdd');
    Route::post('/photosDel','Member@photosDel');
    Route::get('/memberinfo','Member@memberinfo');//展示个人中心的基本资料
    Route::put('/infostore','Member@infostore');  //个人中心资料保存
    Route::get('/memberzheoinfo','Member@memberzheoinfo');//展示个人中心的择偶信息
    Route::put('/zheostore','Member@zheostore');//择偶保存资料保存
    Route::get('/adminlist','Admin@adminlist');
    Route::get('/membershow/{id}','Admin@membershow')->where(['id'=>'\d+']);
});
Route::prefix('Meet')->namespace('Meet')->group(function(){
    Route::get('/','Meet@index');
});
Route::prefix('Admin')->namespace('Admin')->group(function (){
    Route::get('/','Index@index');
    Route::get('/welcome','Index@welcome');
});
/*Route::get('/user','User\user@index');*///这里一定要写上 User\ 文件目录，反斜杠不能掉，然后就是：user目录下面的index方法
                                         //一般我们会这样写路由，控制器一般也会新建一个文件，然后在文件里面新建控制器

/*  对于这种情况，我们一般会采用路由分组的方法
    Route::get('/menber','Member\menber@index');
    Route::get('/menber2','Member\menber@cost');
    Route::get('/vip','Member\vip@index');
    Route::get('/vip2','Member\vip@cost');
*/
/*Route::prefix('index')->namespace('Member')->group(function(){ //因为都是用同一个文件（Member）下的东西 ,可以使用namespace
    Route::get('/menber','menber@index');//menber@index:menber代表menber.php的.php前面的文件名，index代表方法
    Route::get('/menber2','menber@cost');
    Route::get('/vip','vip@index')->name('index.membervip');//->name():路由命名，在act.php的index方法中
    Route::get('/vip2','vip@cost');
});*/

//使用post方法请求数据  ctrl+shift+/ 区块注释
/*Route::post('/test',function(){
  echo "这是post方法的test页面";
});*/
//多个路由用match（多匹配）
/*Route::match(['get','post'],'/ceshi',function(){
   echo "这是match方法的ceshi页面";
});
//any(全匹配)
Route::any('/ceshi2',function(){
   echo "这是any方法的ceshi2页面";
});
//更复杂一些的路由（带参数的设置）
Route::get('/user/{id}/{name}',function($id,$name){
   echo "这是user页面的".$id."和".$name;
});//这里的id和name去掉了，是因为在app/Providers/RouteServiceProvider.php下的boot函数加了路由
   //路由分组(方便直观的现看我们的模块)
Route::prefix('index')->group(function(){ //prefix('index'):只是一个前缀，index随便起的，无所谓
    Route::get('/test/{id}/{name}',function($id,$name){
        echo "这是test页面的".$id."和".$name;
    })->where(['name'=>'[a-zA-Z]+']);//这里的id去掉了，是因为在app/Providers/RouteServiceProvider.php下的boot函数加了路由
});                                    //这里也可以去掉name,因为我在boot函数中已经设置了，也可以不去掉，无妨
//可选参数(加个 ？ ，一定要写默认值)
Route::get('/user2/{id?}',function($id=1){
    echo "这是user2页面，id为：".$id;//这里的id去掉了，是因为在app/Providers/RouteServiceProvider.php下的boot函数加了路由
});
//路由重定向,第二次改就改不了了，是因为有个默认缓存，我们清除游览器的缓存数据即可。
Route::redirect('/luyou','/ceshi2',301);
//------------------------------------------------------------------------------------------------------------
Route::namespace('Act')->group(function (){
    Route::get('Act/test','act@test');//这是自己在act.php中建了一个方法test()方法，注意（一定写在resource路由的前面）
    Route::resource('/Act','act');
});
*/