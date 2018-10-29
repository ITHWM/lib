<?php

namespace app\admin\controller;

use think\Db;
use think\Request;


class Node extends AdminController
{
	/**
	 * 显示节点列表首页
	 * @return [type] [description]
	 */
    public function index()
    {
        $list = Db::table('lamp_node')->select();
        $this->assign('list', $list);
        return view('node/index');
    }

    /**
     * 显示添加节点
     * @return [type] [description]
     */
    public function create()
    {
    	return view('node/add');
    }

    /**
     * 显示新增权限页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        // 不过滤数据字段
    	$list = $request->post();
    	$data= [
    		'name' => $list['name'],
    		'mname' => $list['mname'],
    		'aname' => $list['aname'],
    		'status' => 1
    	];
    	$request = Db::table('lamp_node')->insert($data);
    	if ($request) {
    		$this->success('新增权限成功! 6到飞起', 'admin/node/index');
    	} else {
    		$this->error('新增权限失败！ Gameover');
    	}
    }

    /**
     * [read description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function read($id)
    {

    }

    /**
     *显示编辑权限页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
    	$data = Db::table('lamp_node')->where('id', $id)->find();
    	$this->assign('data', $data);
    	return view('node/edit');
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
    	$list = $request->put();
    	$data = [
    		'name' => $list['name'],
    		'mname' => $list['mname'],
    		'aname' => $list['aname'],
    	];
    	$request = Db::table('lamp_node')->where('id', $id)-update($data);
    	if ($request) {
    		$this->success('权限修改成功! 6666666', 'admin/node/index');
    	} else {
    		$this->error('权限修改失败! 5555555555');
    	}
    }


    public function delete($id)
    {
        $result = Db::table('lamp_node')->delete($id);
        if ($result) {
            $this->success('权限删除成功！(*^▽^*)','admin/node/index');
        } else {
            $this->error('权限删除失败！(灬ꈍ ꈍ灬)');
        }
    }
    public function active($id,$active)
    {
        if ($active == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $result = Db::table('lamp_node')->where('id', $id)->update(['status' => $status]);
        if ($result) {
            $this->success('权限状态修改成功！','admin/node/index');
        } else {
            $this->error('权限状态修改失败！');
        }
    }
}
