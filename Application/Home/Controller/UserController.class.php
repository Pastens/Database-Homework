<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function index(){
		$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$rawData = M('Users') -> where("userId='%d'",cookie('uid'))->find();
        	$userInfo = M('Userinfo') -> where("userId='%d'",cookie('uid'))->find();
        	if($userInfo){
        		$data['userName'] = $userInfo[nickname];
        		$data['status'] = 1;
        	}else{
        		$data['userName'] = $rawData[username];
        		$data['status'] = 0;
        	}
        	$this->assign('data',$data);
        	$this->display();
        }else{
        	$this->redirect('/Home/Index/Login');
        }
	}

	public function Userinfo(){
		$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$rawData = M('Users') -> where("userId='%d'",cookie('uid'))->find();
        	$userInfo = M('Userinfo') -> where("userId='%d'",cookie('uid'))->find();
        	if($userInfo){
        		$data['userName'] = $userInfo[nickname];
        		$data['nickName'] = $userInfo[nickname];
        		$data['name'] = $userInfo[name];
        		$data['address'] = $userInfo[address];
        		$data['gender'] = $userInfo[gender];

        		$data['status'] = 1;
        	}else{
        		$data['userName'] = $rawData[username];
        		$data['status'] = 0;
        	}
        	$this->assign('data',$data);
        	$this->display();
        }else{
        	$this->redirect('/Home/Index/Login');
        }
	}

	public function modify(){
		$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$rawData = M('Users') -> where("userId='%d'",cookie('uid'))->find();
        	$userInfo = M('Userinfo') -> where("userId='%d'",cookie('uid'))->find();
        	if($userInfo){
        		$data['userName'] = $userInfo[nickname];
        		$data['nickName'] = $userInfo[nickname];
        		$data['name'] = $userInfo[name];
        		$data['address'] = $userInfo[address];
        		$data['gender'] = $userInfo[gender];

        		$data['status'] = 1;
        	}else{
        		$data['userName'] = $rawData[username];
        		$data['status'] = 0;
        	}
        	$this->assign('data',$data);
        	$this->display();
        }else{
        	$this->redirect('/Home/Index/Login');
        }
	}
	
	public function modifyUserinfo() {
		if(IS_POST){
			$userName = I('post.userName');
			$userPassword = I('post.userPassword');
			$auto = I('post.userAutologin');

			$condition = array(
				'userName' => $userName,
				'userPassword' => $userPassword
				);
			$user = M('Users')->where($condition)->find();
			if($user){
				$uid = $user[userid];
				$utoken = md5(get_client_ip()+time());
				
				session('uid',$uid);
				session('utoken',$utoken);
				if($auto == true){
					cookie('uid',$uid,'expire=604800');
					cookie('utoken',$utoken,'expire=604800');
				}else{
					cookie('uid',$ucid);
					cookie('utoken',$utoken);
				}
				$data['status'] = 1;
				$data['info']   = '登录成功';

				$log['operationName'] = "登录";
				$log['operationUserId'] = $uid;
				$log['operationUserType'] = 1;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();
			}else{
				$data['status'] = 0;

				$checkName = array(
					'userName' => $userName
					);
				$check = M('Users')->where($checkName)->find();
				if($check){
					$data['info'] = '密码错误'; 
				}else{
					$data['info'] = '账号错误或不存在该账号';
				}
			}
			$this->ajaxReturn($data);
		}
		else{
			$this->error('非法操作');
		}
	}

	public function loginUser(){
		if(IS_POST){
			$userName = I('post.userName');
			$userPassword = I('post.userPassword');
			$auto = I('post.userAutologin');

			$condition = array(
				'userName' => $userName,
				'userPassword' => $userPassword
				);
			$user = M('Users')->where($condition)->find();
			if($user){
				$uid = $user[userid];
				$utoken = md5(get_client_ip()+time());
				
				session('uid',$uid);
				session('utoken',$utoken);
				if($auto == true){
					cookie('uid',$uid,'expire=604800');
					cookie('utoken',$utoken,'expire=604800');
				}else{
					cookie('uid',$ucid);
					cookie('utoken',$utoken);
				}
				$data['status'] = 1;
				$data['info']   = '登录成功';

				$log['operationName'] = "登录";
				$log['operationUserId'] = $uid;
				$log['operationUserType'] = 1;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();
			}else{
				$data['status'] = 0;

				$checkName = array(
					'userName' => $userName
					);
				$check = M('Users')->where($checkName)->find();
				if($check){
					$data['info'] = '密码错误'; 
				}else{
					$data['info'] = '账号错误或不存在该账号';
				}
			}
			$this->ajaxReturn($data);
		}
		else{
			$this->error('非法操作');
		}
	}

	public function signupUser(){
		if(IS_POST){
			$userName = I('post.userName');
			$userPassword = I('post.userPassword');

			$condition = array(
				'userName' => $userName
				);
			$user = M('Users')->where($condition)->find();
			if($user){
				$data['status'] = 0;
				$data['info'] = '用户名已存在';
			}else{
				$userInfo['userName'] = $userName;
				$userInfo['userPassword'] = $userPassword;
				
				M('Users') -> data($userInfo) ->add();
				
				$data['status'] = 1;
				$data['info']   = '注册成功';
				

				$uid = M('Users')->where("userName='%s'",$userName)->getField('userId');
				$utoken = md5(get_client_ip()+time());

				session('uid',$uid);
				session('utoken',$utoken);


				cookie('uid',$uid);
				cookie('utoken',$utoken);

				$log['operationName'] = "用户注册";
				$log['operationUserId'] = $uid;
				$log['operationUserType'] = 1;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();

				$log['operationName'] = "用户登录";
				$log['operationUserId'] = $uid;
				$log['operationUserType'] = 1;
				$log['timestamp'] = time();

				M('Systemlog') -> data($log) -> add();
			}
			$this->ajaxReturn($data);
		}
		else{
			$this->error('非法操作');
		}
	}

	public function Logout(){
		if(IS_GET){
			session('uid',null);
			session('utoken',null);
			cookie('uid',null);
			cookie('utoken',null);
			redirect(U('/Home'));
		}else{
			$this->error('非法操作');
		}
	}
}