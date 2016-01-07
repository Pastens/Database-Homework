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
		$this->display();
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
				// // 获取在售商品种类
				// $data['itemType'] = count(M('Products') -> where('enable=1')->select());
				// // 获取有效订单数量
				// $data['orderNumber'] = count(M('Orders') -> where('enable=1')->select());
				// // 获取订单销售总量
				// $orders = M('Orders') -> where('enable=1') -> select();
				// $data['orderQuantity'] = 0;
				// for($i=0;$i<count($orders);++$i){
				// 	// echo $orders[$i];
				// 	$orderDetail = M('Orderitems') -> where("orderId='%d'",$orders[$i])->select();
				// 	for($j=0;$j<count($orderDetail);++$j){
				// 		$data['orderQuantity'] += $orderDetail[$j][quantity];
				// 	}
				// }
				// // 获取缺货商品种类
				// $data['outStock'] = count(M('Products') -> where('enable=1 and productAmount=0') ->select());
				// // 获取站点商店信息
				// $shop = M('Shop') -> where('enable=1')->select();
				// for($i=0;$i<count($shop);++$i){
				// 	$shopId = $shop[$i][shopid];

				// 	$shopData[$i]['shopId'] = $shopId;
				// 	$shopData[$i]['shopName'] = $shop[$i][shopname];

				// 	$shopItem = M('Products') -> where("shopId='%d'",$shopId)->select();
				// 	$shopData[$i]['shopItem'] = count($shopItem);

				// 	$shopData[$i]['shopSale'] = 0;
				// 	$shopData[$i]['shopProfit'] = 0;
				// 	for($j=0;$j<count($shopItem);++$j){
				// 		$productSale = M('Orderitems')->where("productId='%d'",$shopItem[$j][productid])->select();
				// 		for($k=0;$k<count($productSale);++$k){
				// 			$shopData[$i]['shopSale'] += $productSale[$k][quantity];
				// 			$shopData[$i]['shopProfit'] += $productSale[$k][quantity] * $shopItem[$j][productprice];
				// 		}
				// 	}
				// }

				// $data['shopNum'] = count($shop);
				// $data['shopDisabled'] = count(M('Shop') -> where('enable=0')->select());
				// $data['adminName'] = $rawData[adminnickname];
				// $this->assign('shopItem',$shopData);
				// $this->assign('data',$data);
				// $this->display();
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
				$this->display();
			}
        }else{
        	$this->redirect('/Admin/Login');
        }
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