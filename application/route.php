<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//user module route
Route::get('/', 'index/Index/index');
//user module route
Route::get('user/delete/:id','admin/user/delete');
Route::post('user/roleup','admin/user/roleup');
Route::resource('user','admin/user');
Route::get('user/role/:id','admin/user/role');

//role module route
Route::get('role/delete/:id','admin/role/delete');
Route::post('role/nodeup','admin/role/nodeup');
Route::resource('role','admin/role');
//Route::get('role/active/:id/:active','admin/role/active');
Route::get('role/node/:id','admin/role/node');

//node module route
Route::get('node/delete/:id','admin/node/delete');
Route::resource('node','admin/node');
Route::get('node/active/:id/:active','admin/node/active');

//main route
Route::get('main','admin/main/index');

//login index page route
Route::get('admin','admin/index/index');

//login page route
Route::post('login','admin/index/login');

//logout route
Route::get('logout','admin/index/logout');

//fixed empty moudle
Route::get(':name','admin/index/index');

