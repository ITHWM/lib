<?php
namespace app\admin\controller;

use think\Db;
use think\Request;
class Role extends AdminController
{
    /**
     * 显示角色首页
     * @return [type] [description]
     */
    public function index()
    {
        $list = Db::table('lamp_role')->select();
        $this->assign('list', $list);
        return view('role/index');
    }

    /**
     *
     * @return [type] [description]
     */
    public function create()
    {
        return view('role/add');
    }

    /**
     * 显示保存新建角色
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        $info = $request->post();
        $data = [
            'name' => $info['name'],
            'status' => 1,
            'remark' => $info['remark']
        ];
        $result = Db::table('lamp_role')->insert($data);
        if ($result) {
            $this->success('新增角色成功！', 'admin/role/index');
        } else {
            $this->error('新增角色失败！');
        }
    }

    /**
     * [read description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑角色页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $data = Db::table('lamp_role')->where('id', $id)->find();
        $this->assign('data', $data);
        return view('role/edit');
    }

    /**
     * 显示更新的角色
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $info = $request->put();
        $data = [
            'name' => $info['name'],
            'remark' => $info['remark'],
        ];
        $result = Db::table('lamp_role')->where('id', $id)->update($data);
        if ($result) {
            $this->success('角色修改成功！','admin/role/index');
        } else {
            $this->error('角色修改失败！');
        }
    }


    /**
     * 显示删除角色
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $result = Db::table('lamp_role')->delete($id);
        if ($result) {
            $this->success('角色删除成功！','admin/role/index');
        } else {
            $this->error('角色删除失败！');
        }
    }
    public function active($id,$active)
    {
        if ($active == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $result = Db::table('lamp_role')->where('id', $id)->update(['status' => $status]);
        if ($result) {
            $this->success('角色状态修改成功！','admin/role/index');
        } else {
            $this->error('角色状态修改失败！');
        }
    }

    /**
     * 显示权限分配页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
   public function node($id)
   {
    // 查询角色信息
    $role = Db::name('role')->where('id', $id)->find();
    //查询所有节点
    $date = Db::view('lamp_node', 'id,name')->select();
    // 查询该角色的节点
    $list = Db::view('lamp_role_node', 'nid')
              ->view('lamp_node', "id, name, mname, aname", 'lamp_node.id=lamp_role_node.nid')
              ->where('rid', '=', $id)
              ->select();
              // var_dump($list); die;

    if(!empty($list)){
    foreach ($list as $v) {
        $lists[] = $v['nid'];
        }
        $this->assign('lists', $lists);
    }else{
        $this->assign('lists',['99999']);
    }

    $this->assign('role', $role);
    $this->assign('date', $date);
    $this->assign('list', $list);
    return view('role/node');
   }

   public function nodeup(Request $request)
   {
    $list = $request->post();
    $node = $list['node'];
    $id = $list['id'];

    // 手动开启事务
    Db::startTrans();
    try{
        db('role_node')->where('rid', $id)->delete();
        foreach ($node as $v) {
            $data['nid'] = $v;
            $data['rid'] = $id;
            $result = db('role_node')->insert($data);
        }
        // 提交事务
        Db::commit();
    } catch (\Exception $e) {
        // 回滚事务
        Db::rollback();
    }
        if ($result) {
            return $this->success('更新成功！起飞6666', url('admin/role/index'));
        } else {
            return $this->error('更改失败! 降落55555');
        }
   }

}