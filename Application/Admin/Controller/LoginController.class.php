<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
        if($condition){
        	$this->redirect('/Admin/Dashboard');
        }else{
        	$this->display();
        }
	}

	public function loginAdmin(){
		if(IS_POST){
			$adminName = I('post.adminName');
			$adminPassword = I('post.adminPassword');
			$auto = I('post.adminAutologin');

			$condition = array(
				'adminName' => $adminName,
				'adminPassword' => $adminPassword
				);
			$admin = M('Admin')->where($condition)->find();
			if($admin){
				$cid = $admin[adminid];
				$token = md5(get_client_ip());
				
				$count = M('Admin')->where('adminId='+$cid)->setInc('adminCount');
				session('cid',$cid);
				session('token',$token);
				if($auto == true){
					cookie('cid',$cid,'expire=604800');
					cookie('token',$token,'expire=604800');
				}else{
					cookie('cid',$cid);
					cookie('token',$token);
				}
				$data['status'] = 1;
				$data['info']   = '登录成功';

				$log['operationName'] = "登录";
				$log['operationUserId'] = $cid;
				$log['operationUserType'] = 0;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();
			}else{
				$data['status'] = 0;

				$checkName = array(
					'adminName' => $adminName
					);
				$check = M('Admin')->where($checkName)->find();
				if($check){
					$data['info'] = '密码错误'; 
				}else{
					$data['info'] = '账号错误或不存在该账号';
				}
			}
			$this->ajaxReturn($data);
		}else{
			$this->error('非法操作');
		}
	}

	public function logout(){
		if(IS_GET){
			session('cid',null);
			session('token',null);
			cookie('cid',null);
			cookie('token',null);
			redirect(U('/Admin'));
		}else{
			$this->error('非法操作');
		}
	}
}

