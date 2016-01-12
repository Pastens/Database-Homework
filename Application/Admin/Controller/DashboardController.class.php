<?php
namespace Admin\Controller;
use Think\Controller;
class DashboardController extends Controller {
	public function index(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminNumber'] = count(M('Admin') -> where('enable=1')->select());
			$data['userNumber'] = count(M('Users') -> where('enable=1')->select());
			$data['itemType'] = count(M('Products') -> where('enable=1')->select());

			$data['adminName'] = $rawData[adminnickname];
			$data['adminSuperior'] = $rawData[superior];
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
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '4'){
				$this->error('您没有访问该部分的权限');
			}else{
				// 获取在售商品种类
				$data['itemType'] = count(M('Products') -> where('enable=1')->select());
				// 获取有效订单数量
				$data['orderNumber'] = count(M('Orders') -> where('enable=1')->select());
				// 获取订单销售总量
				$orders = M('Orders') -> where('enable=1') -> select();
				$data['orderQuantity'] = 0;
				for($i=0;$i<count($orders);++$i){
					// echo $orders[$i];
					$orderDetail = M('Orderitems') -> where("orderId='%d'",$orders[$i])->select();
					for($j=0;$j<count($orderDetail);++$j){
						$data['orderQuantity'] += $orderDetail[$j][quantity];
					}
				}
				// 获取缺货商品种类
				$data['outStock'] = count(M('Products') -> where('enable=1 and productAmount=0') ->select());
				// 获取站点商店信息
				$shop = M('Shop') -> where('enable=1')->select();
				for($i=0;$i<count($shop);++$i){
					$shopId = $shop[$i][shopid];

					$shopData[$i]['shopId'] = $shopId;
					$shopData[$i]['shopName'] = $shop[$i][shopname];

					$shopItem = M('Products') -> where("shopId='%d'",$shopId)->select();
					$shopData[$i]['shopItem'] = count($shopItem);

					$shopData[$i]['shopSale'] = 0;
					$shopData[$i]['shopProfit'] = 0;
					for($j=0;$j<count($shopItem);++$j){
						$productSale = M('Orderitems')->where("productId='%d'",$shopItem[$j][productid])->select();
						for($k=0;$k<count($productSale);++$k){
							$shopData[$i]['shopSale'] += $productSale[$k][quantity];
							$shopData[$i]['shopProfit'] += $productSale[$k][quantity] * $shopItem[$j][productprice];
						}
					}
				}

				$data['shopNum'] = count($shop);
				$data['shopDisabled'] = count(M('Shop') -> where('enable=0')->select());
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('shopItem',$shopData);
				$this->assign('data',$data);
				$this->display();
			}
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function shopList(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '4'){
				$this->error('您没有访问该部分的权限');
			}else if($data['adminSuperior'] == '5'){
				$shopId = M('Shop') ->where("adminId='%d'",$rawData[adminid]) ->select();
				if($shopId){
					$data['status'] = 1;
					$data['shopName'] = $shopId[0][shopname];
					$data['shopAdmin'] = $rawData[adminnickname];
				}else{
					$data['status'] = 0;
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('data',$data);
			}
			else{
				$shopId = M('Shop') -> select();
				$data['shopCount'] = count($shopId);

				for($i=0;$i<count($shopId);++$i){
					$shopData[$i]['enable'] = $shopId[$i][enable];
					$shopData[$i]['adminId'] = $shopId[$i][adminid];
					$shopData[$i]['shopName'] = $shopId[$i][shopname];

					if($shopId[$i][adminid]==null){
						$shopData[$i]['adminName'] = "系统管理员";
					}else{
						$shopData[$i]['adminName'] = M('Admin') -> where("adminId='%d'",$shopId[$i][adminid])->getField('adminNickname');
					}

					$shopItem = M('Products')->where("shopId='%d'",$shopId[$i][shopid])->select();
					$shopData[$i]['itemType'] = count($shopItem);
					$shopData[$i]['itemSales'] = 0;
					$shopData[$i]['shopProfit'] = 0;
					for($j=0;$j<count($shopItem);++$j){
						$sales = M('Orderitems')->where("productId='%d'",$shopItem[$j][productid])->select();
						for($k=0;$k<count($sales);++$k){
							echo $sales[$k][quantity];
							$shopData[$i]['itemSales'] += $sales[$k][quantity];
							$shopData[$i]['shopProfit'] += $sales[$k][quantity] * $shopItem[$j][productprice];
						}
					}
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('shopItem',$shopData);
				$this->assign('data',$data);
			}
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function itemList(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '4'){
				$this->error('您没有访问该部分的权限');
			}else if($data['adminSuperior'] == '5'){
				$shopId = M('Shop') -> where("adminId='%d'",$rawData[adminid])->getField('shopId');
				if($shopId){
					$shopItem = M('Products') -> where("shopId='%d'",$shopId)-> select();
					$data['itemType'] = count($shopItem);

					for($i=0;$i<count($shopItem);++$i){
						$shopData[$i]['enable'] = $shopItem[$i][enable];
						$shopData[$i]['itemName'] = $shopItem[$i][productname];
						$shopData[$i]['itemIntro'] = $shopItem[$i][productintro];
						$shopData[$i]['itemPrice'] = $shopItem[$i][productprice];
						$shopData[$i]['itemStock'] = $shopItem[$i][productamount];
						$shopData[$i]['itemShop'] = M('Shop')->where("shopId='%d'",$shopItem[$i][shopid])->getField('shopName');
						$shopData[$i]['itemSales'] = 0;

						$productSale = M('Orderitems') -> where("productId='%d'",$shopItem[$i][productid])->select();
						for($j=0;$j<count($productSale);++$j){
							$shopData[$i]['itemSales'] += $productSale[$j][quantity];
						}
					}
				}else{
					$this->redirect('/Admin/Dashboard/shopList');
				}
				
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('shopItem',$shopData);
				$this->assign('data',$data);
			}
			else{
				$shopItem = M('Products') -> select();
				$data['itemType'] = count($shopItem);

				for($i=0;$i<count($shopItem);++$i){
					$shopData[$i]['enable'] = $shopItem[$i][enable];
					$shopData[$i]['itemName'] = $shopItem[$i][productname];
					$shopData[$i]['itemIntro'] = $shopItem[$i][productintro];
					$shopData[$i]['itemPrice'] = $shopItem[$i][productprice];
					$shopData[$i]['itemStock'] = $shopItem[$i][productamount];
					$shopData[$i]['itemShop'] = M('Shop')->where("shopId='%d'",$shopItem[$i][shopid])->getField('shopName');
					$shopData[$i]['itemSales'] = 0;

					$productSale = M('Orderitems') -> where("productId='%d'",$shopItem[$i][productid])->select();
					for($j=0;$j<count($productSale);++$j){
						$shopData[$i]['itemSales'] += $productSale[$j][quantity];
					}
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('shopItem',$shopData);
				$this->assign('data',$data);
			}
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function orderList(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '4'){
				$this->error('您没有访问该部分的权限');
			}else if($data['adminSuperior'] == '5'){
				$shop = M('Shop') -> where("adminId='%d'",$rawData[adminid]) -> getField("shopId");
				if($shop){
					$shopItem = M('Orders') -> where("shopId='%d'",$shop) -> select();
					$data['itemType'] = count($shopItem);

					for($i=0;$i<count($shopItem);++$i){
						$shopData[$i]['enable'] = $shopItem[$i][enable];
						$shopData[$i]['orderId'] = $shopItem[$i][orderid];
						$shopData[$i]['orderUser'] = M('Users') -> where("userId='%d'",$shopItem[$i][userid]) ->getField('userName');
						$shopData[$i]['orderPrice'] = $shopItem[$i][orderprice];
						$shopData[$i]['orderTime'] = $shopItem[$i][timestamp];
						$shopData[$i]['orderStatus'] = $shopItem[$i][status];
					}
				}else{
					$this->redirect('/Admin/Dashboard/shopList');
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('shopItem',$shopData);
				$this->assign('data',$data);
			}
			else{
				$shopItem = M('Orders') -> select();
				$data['itemType'] = count($shopItem);

				for($i=0;$i<count($shopItem);++$i){
					$shopData[$i]['enable'] = $shopItem[$i][enable];
					$shopData[$i]['orderId'] = $shopItem[$i][orderid];
					$shopData[$i]['orderUser'] = M('Users') -> where("userId='%d'",$shopItem[$i][userid]) ->getField('userName');
					$shopData[$i]['orderPrice'] = $shopItem[$i][orderprice];
					$shopData[$i]['orderTime'] = $shopItem[$i][timestamp];
					$shopData[$i]['orderStatus'] = $shopItem[$i][status];
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('shopItem',$shopData);
				$this->assign('data',$data);
			}
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function userManage(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '3' || $data['adminSuperior'] == '4' || $data['adminSuperior'] == '6'){
				$this->error('您没有访问该部分的权限');
			}
			else{
				$userInfo = M('Users') -> select();
				$data['userCount'] = count($userInfo);

				for($i=0;$i<count($userInfo);++$i){
					$detail = M('Userinfo') -> where("userId='%d'",$userInfo[$i][userid]) -> find();

					$Info[$i]['userId'] = $userInfo[$i][userid];
					$Info[$i]['userName'] = $userInfo[$i][username];
					$Info[$i]['userStatus'] = $userInfo[$i][enable] ? "正常" : "被禁止";

					if($detail){
						$Info[$i]['nickName'] = $detail[nickname];
						$Info[$i]['name'] = $detail[name];
						$Info[$i]['userGender'] = $detail[gender];
						$Info[$i]['userAddress'] = $detail[address];
					}else{
						$Info[$i]['nickName'] = "空";
						$Info[$i]['name'] = "空";
						$Info[$i]['userGender'] = "空";
						$Info[$i]['userAddress'] = "空";
					}
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('userInfo',$Info);
				$this->assign('data',$data);
			}
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function adminManage(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '3' || $data['adminSuperior'] == '4' || $data['adminSuperior'] == '6'){
				$this->error('您没有访问该部分的权限');
			}
			else{
				$adminInfo = M('Admin') -> select();
				$data['adminCount'] = count($adminInfo);

				for($i=0;$i<count($adminInfo);++$i){
					$Info[$i]['adminId'] = $adminInfo[$i][adminid];
					$Info[$i]['adminName'] = $adminInfo[$i][adminname];
					$Info[$i]['adminStatus'] = $adminInfo[$i][enable] ? "正常" : "被禁止";

					$Info[$i]['adminSuper'] = $adminInfo[$i][superior];

					switch ($adminInfo[$i][superior]) {
						case '0':
							$Info[$i]['adminSuperior'] = "系统开发人员";
							break;
						
						case '1':
							$Info[$i]['adminSuperior'] = "系统管理员";
							break;

						case '2':
							$Info[$i]['adminSuperior'] = "商店管理员";
							break;

						case '3':
							$Info[$i]['adminSuperior'] = "订单管理员";
							break;

						case '4':
							$Info[$i]['adminSuperior'] = "用户管理员";
							break;

						case '5':
							$Info[$i]['adminSuperior'] = "加盟客户";
							break;
					}
					$Info[$i]['adminNickname'] = $adminInfo[$i][adminnickname];
					$Info[$i]['adminLog'] = $adminInfo[$i][admincount];
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('adminInfo',$Info);
				$this->assign('data',$data);
			}
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
	}

	public function systemLog(){
		$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
		if($condition){
			$rawData = M('Admin') -> where("adminId='%d'",cookie('cid'))->find();
			$data['adminSuperior'] = $rawData[superior];
			//Check superior
			if($data['adminSuperior'] == '0' || $data['adminSuperior'] == '1'){
				$logInfo = M('Systemlog') -> select();
				$data['logCount'] = count($logInfo);

				for($i=0;$i<count($logInfo);++$i){
					$Info[$i]['logId'] = $logInfo[$i][logid];
					$Info[$i]['logName'] = $logInfo[$i][operationname];
					switch ($logInfo[$i][operationusertype]) {
						case '0':
							$Info[$i]['logUser'] = M('Admin') -> where("adminId='%d'",$logInfo[$i][operationuserid])->getField('adminNickname');
							$Info[$i]['logUserType'] = "管理员";
							break;
						
						case '1':
							$Info[$i]['logUser'] = M('Users') -> where("userId='%d'",$logInfo[$i][operationuserid])->getField('userName');
							$Info[$i]['logUserType'] = "用户";
							break;
						
					}
					$Info[$i]['logTime'] = date('Y-m-d H:i:s',$logInfo[$i][timestamp]);
				}
				$data['adminName'] = $rawData[adminnickname];
				$this->assign('logInfo',$Info);
				$this->assign('data',$data);
			}
			else{
				$this->error('您没有访问该部分的权限');
			}
			$this->display();
        }else{
        	$this->redirect('/Admin/Login');
        }
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