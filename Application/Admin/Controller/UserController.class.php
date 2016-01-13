<?php 
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
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

	public function resetAdminname() {
		if(!IS_POST){
			$this->error('非法操作');
		}else{
			$adminName = I('post.adminName');
			$adminId = cookie('cid');

			$adminCheck = M('Admin')->where("adminNickname='%s'",$adminName)->find();
			if($adminCheck){
				$data['status'] = 0;
				$data['info'] = "用户名已存在";
			}else{
				M('Admin') -> where("adminId='%d'",$adminId) -> setField('adminNickname',$adminName);
				$data['status'] = 1;

				$log['operationName'] = "更改管理员用户名";
				$log['operationUserId'] = $adminId;
				$log['operationUserType'] = 0;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();
			}
			$this->ajaxReturn($data);
		}
	}

	public function resetPassword() {
		if(!IS_POST){
			$this->error('非法操作');
		}else{
			$adminPassword = I('post.oldPassword');
			$adminId = cookie('cid');
			$condition = array(
				'adminId' => $adminId,
				'adminPassword' => $adminPassword
				);
			$admin = M('Admin') -> where($condition) ->find();
			if($admin){
				$adminPassword = I('post.newPassword');
				M('Admin') -> where("adminId='%d'",$adminId) -> setField('adminPassword',$adminPassword);
				$data['status'] = 1;
				$log['operationName'] = "重置管理员密码";
				$log['operationUserId'] = $adminId;
				$log['operationUserType'] = 0;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();
			}else{
				$data['status'] = 0;
				$data['info'] = "原密码错误";
			}
			$this->ajaxReturn($data);
		}
	}
}
