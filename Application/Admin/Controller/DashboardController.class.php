<?php
namespace Admin\Controller;
use Think\Controller;
class DashboardController extends Controller {
	public function index(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where('id='+cookie('cid'))->find();
			$data['adminNumber'] = count(M('Admin') -> where('enable=1')->select());
			$data['userNumber'] = count(M('Users') -> where('enable=1')->select());
			$data['itemType'] = count(M('Products') -> where('enable=1')->select());

			$data['adminName'] = $rawData[adminnickname];

			switch ($rawData[superior]) {
				case '0':
					$data['adminSuperior'] = '系统开发人员';
					break;

				case '1':
					$data['adminSuperior'] = '系统管理员';
					break;
				
				case '2':
					$data['adminSuperior'] = '内容管理员';
					break;

				case '3':
					$data['adminSuperior'] = '商店管理员';
					break;

				case '4':
					$data['adminSuperior'] = '订单管理员';
					break;

				case '5':
					$data['adminSuperior'] = '用户管理员';
					break;

				case '6':
					$data['adminSuperior'] = '加盟客户';
					break;
			}
			$data['adminCount'] = $rawData[admincount]+1;
			$this->assign('data',$data);
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function itemCatalog(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where('id='+cookie('cid'))->find();
			$data['itemType'] = count(M('Products') -> where('enable=1')->select());
			$data['orderNumber'] = count(M('Orders') -> where('enable=1')->select());
			$orders = M('Orders') -> where('enable=1') -> getField('orderId',true);
			$data['orderQuantity'] = 0;
			foreach ($orders as $value) {
				$orderDetail = M('Orderitems') -> where('orderId='+$value)->getField('quantity',true);
				foreach ($orderDetail as $num){
					$data['orderQuantity'] += $num;
				}
			}
			$data['outStock'] = count(M('Products') -> where('enable=1 and productAmount=0') ->select());


			$data['adminSuperior'] = $rawData[superior];

			if($data['adminSuperior'] == '5'){
				$this->error('您没有访问该部分的权限');
			}else{
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('data',$data);
				$this->display();
			}
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function itemList(){
		$this->display();
	}

	public function orderList(){
		$this->display();
	}

	public function userManage(){
		$this->display();
	}

	public function adminManage(){
		$this->display();
	}

	public function systemLog(){
		$this->display();
	}

	public function apiList(){
		$this->display();
	}

	public function devDocument(){
		$this->display();
	}

	public function adminInfo(){
		$this->display();
	}

	public function resetPassword(){
		$this->display();
	}
}