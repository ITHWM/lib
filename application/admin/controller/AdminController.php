<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
class AdminController extends Controller
{
    //初始化方法
    public function _initialize()
    {
        $data = \session('admininfo');
        //获取登录用户名
        $this->assign('username',$data['username']);
        //判断session是否存在
        if (empty($data['username'])) {
            //跳转到登录页
            return $this->redirect('admin/index/index');
        }
        //权限过滤
        $request = Request::instance();
        //获取控制器名和方法名
        $mname = $request->controller();
        $aname = $request->action();
        $nodelist = \session('adminnodelist');
        $admininfo = session('admininfo');
        //判断用户如果不是amdin，则匹配权限.admin拥有所有权限
        if ($admininfo['username'] != 'admin') {
            //验证操作权限
            if(empty($nodelist[$mname]) || !in_array($aname,$nodelist[$mname])){
                return $this->error("抱歉！没有操作权限！");
            }
        }
    }
}