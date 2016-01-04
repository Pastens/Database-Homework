<?php 
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	public function index(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
        if($condition){
        	$this->redirect('/Admin/Dashboard');
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function addAdmin(){
		if(!IS_POST){
			$this->error('非法操作');
		}else{
			$adminName = I('post.adminName');
			$adminPassword = I('post.adminPassword');
			$adminSuperior = I('post.adminSuperior');

			$dump = array(
				'adminName' => $adminName
				);
			$dumpCheck = M('Admin')->where($dump)->find();
			if($dumpCheck){
				$data['status'] = 0;
			}else{
				$superior = cookie('csuper');
				if($adminSuperior < $superior){
					$data['status'] = 2;
				}else{
					$condition = array(
						'adminName' => $adminName,
						'adminPassword' => $adminPassword,
						'adminSuperior' => $adminSuperior
						);
					$add = M('Admin')->add($condition);
					if($add){
						$data['status'] = 1;
					}else{
						$this->error('服务器内部错误');
					}
				}
			}
			$this->ajaxReturn($data);
		}
	}

	public function updateAdmin(){
		if(!IS_POST){
			$this->error('非法操作');
		}else{
			$adminId = I('post.adminId');
			$adminPassword = I('post.adminPassword');
			$adminSuperior = I('post.adminSuperior');

			$admin = array(
				'adminId' => $adminId
				);
			$adminCheck = M('Admin')->where($admin)->find();
			if($adminCheck){
				$superior = cookie('csuper');
				if($adminSuperior < $superior){
					$data['status'] = 2;
				}else{
					$condition = array(
						'adminPassword' => $adminPassword,
						'adminSuperior' => $adminSuperior
						);
					$update = M('Admin')->where('adminId='+$adminId)->save($condition);
					if($update){
						$data['status'] = 1;
					}else{
						$this->error('服务器内部错误');
					}
				}
			}else{
				$data['status'] = 0;
			}
			$this->ajaxReturn($data);
		}
	}

	public function deleteAdmin(){
		if(!IS_POST){
			$this->error('非法操作');
		}else{
			$adminId = I('post.adminId');
			$adminSuperior = I('post.adminSuperior');

			$admin = array(
				'adminId' => $adminId
				);
			$adminCheck = M('Admin')->where($admin)->find();
			if($adminCheck){
				$superior = cookie('csuper');
				if($adminSuperior < $superior){
					$data['status'] = 2;
				}else{
					$delete = M('Admin')->where('adminId='+$adminId)->delete();
					if($delete){
						$data['status'] = 1;
					}else{
						$this->error('服务器内部错误');
					}
				}
			}else{
				$data['status'] = 0;
			}
			$this->ajaxReturn($data);
		}
	}
}
