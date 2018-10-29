<?php
namespace app\admin\controller;

use think\Db;
use think\Request;

class User extends AdminController
{
    /**
     * [index description]显示用户首页
     * @return [type] [description]
     */
    public function index()
    {
        $list = Db::table('lamp_user')->select();

        //声明一个空数组
        $arr = array();
        //遍历用户信息
        foreach ($list as $v) {
            //遍历
            $role_ids = db('user_role')->field(['rid'])->where('uid',$v['id'])->select();
            $roles =array();
            foreach ( $role_ids as $q){
                $roles[]=db('role')->field(['name'])->where('id',$q['rid'])->select();
            }
            //将新得到角色信息放置到$v中
            $v['role'] = $roles;
            $arr[] =$v;
        }
        $this->assign('list', $arr);
        return view('user/index');
    }

    /**
     * [create description]显示添加用户
     * @return [type] [description]
     */
    public function create()
    {
        return view('user/add');
    }

    /**
     * [save description]保存新增用户
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        $data = input('post.');
        $data['userpass'] = md5($data['userpass']);
        $result = Db::table('lamp_user')->insert($data);
        if ($result) {
            $this->success('新增管理员成功！', 'admin/user/index');
        } else {
            $this->error('新增管理员失败！');
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
     * [edit description]显示编辑页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $data = Db::table('lamp_user')->where('id', $id)->find();
        $this->assign('data', $data);
        return view('user/edit');
    }

    /**
     * [update description]保存更新信息
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $info = $request->put();
        $data = [
            'username' => $info['username'],
            'name' => $info['name'],
            'userpass' => md5($info['userpass']),
        ];
        $result = Db::table('lamp_user')->where('id', $id)->update($data);
        if ($result) {
            $this->success('用户修改成功！','admin/user/index');
        } else {
            $this->error('用户修改失败！');
        }
    }

    /**
     * [delete description]删除指定用户
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $result = Db::table('lamp_user')->delete($id);
        if ($result) {
            $this->success('用户删除成功！','admin/user/index');
        } else {
            $this->error('用户删除失败！');
        }
    }

    /**
     * [rolelist description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function role($id)
    {
        // 查询用户信息
        $user = Db::name('user')->where('id', $id)->find();

        // 查所有角色
        $date = Db::view('lamp_role', 'id,name,remark')->select();
        // 查询该用户的角色
        $list = Db::view('lamp_user_role', 'rid')
            ->view('lamp_role', "id,name", 'lamp_role.id=lamp_user_role.rid')
            ->where('uid', '=', $id)
            ->select();

        if (!empty($list)) {

            foreach ($list as $v) {
                $lists[] = $v['rid'];
            }
            $this->assign('lists', $lists);
        } else {
            $this->assign('lists', ['99999']);
        }
        $this->assign('user', $user);
        $this->assign('date', $date);

        return view('user/role');
    }

    /**
     * [userrole description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userrole(Request $request)
    {
        $list = $request->post();
        $id = $list['id'];
        if (empty($list['node'])) {
            return $this->success('必须添加节点', url('admin/role/role', ['id' => $id]));
        }
        $node = $list['node'];
        Db::startTrans();
        try {
            db('user_role')->where('uid', $id)->delete();
            foreach ($node as $v) {
                $date['rid'] = $v;
                $date['uid'] = $id;
                $result = db('user_role')->insert($date);
            }
// 提交事务
            Db::commit();
        } catch (\Exception $e) {
// 回滚事务
            Db::rollback();
        }
        if ($result) {
            return $this->success('更新成功！', url('admin/user/index'));
        } else {
            return $this->success('更新失败');
        }


    }
}