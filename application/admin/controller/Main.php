<?php
namespace app\admin\controller;
class Main extends AdminController
{
    /**
     * 后台主页
     * @return \think\response\View
     */
    public function index()
    {
        return view('admin@main/index');
    }
}