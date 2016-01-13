<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$rawData = M('Users') -> where("userId='%d'",cookie('uid'))->find();
        	$userInfo = M('Userinfo') -> where("userId='%d'",cookie('uid'))->find();
        	if($userInfo){
        		$data['userName'] = $userInfo[nickname];
        	}else{
        		$data['userName'] = $rawData[username];
        	}
        	$this->assign('data',$data);
        }
        $this->display();
    }

    public function login(){
    	$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$this->redirect('/Home/Index');
        }else{
        	$this->display();
        }
    }

    public function signup(){
    	$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$this->redirect('/Home/Index');
        }else{
        	$this->display();
        }
    }

    public function itemList(){
    	$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$rawData = M('Users') -> where("userId='%d'",cookie('uid'))->find();
        	$userInfo = M('Userinfo') -> where("userId='%d'",cookie('uid'))->find();
        	if($userInfo){
        		$data['userName'] = $userInfo[nickname];
        	}else{
        		$data['userName'] = $rawData[username];
        	}
        	$this->assign('data',$data);
        }
        $itemData = M('Products') -> where("enable=1") ->select();
        $statistic['itemType'] = count($itemData);
        $statistic['shopNum'] = count(M('Shop')->where("enable=1")->select());

        for($i=0;$i<count($itemData);++$i){
        	$item[$i]['itemCover'] = $itemData[$i][coverurl];
        	$item[$i]['itemName'] = $itemData[$i][productname];
        	$item[$i]['itemIntro'] = $itemData[$i][productintro];
        	$item[$i]['itemCount'] = $itemData[$i][productcount];
        	$item[$i]['itemPrice'] = $itemData[$i][productprice];

        	$item[$i]['itemSales'] = 0;
        	$sales = M('Orderitems') -> where("productId='%d'",$itemData[$i][productid]) -> select();
        	for($j=0;$j<count($sales);++$j){
        		$item[$i]['itemSales'] += $sales[$j][quantity];
        	}
        }
        $this->assign('item',$item);
        $this->assign('statistic',$statistic);
        $this->display();
    }

    public function shopList(){
    	$condition = (((cookie('uid') && session('uid')) != null) && ((cookie('utoken') && session('utoken'))!=null));
        if($condition){
        	$rawData = M('Users') -> where("userId='%d'",cookie('uid'))->find();
        	$userInfo = M('Userinfo') -> where("userId='%d'",cookie('uid'))->find();
        	if($userInfo){
        		$data['userName'] = $userInfo[nickname];
        	}else{
        		$data['userName'] = $rawData[username];
        	}
        	$this->assign('data',$data);
        }
        $itemData = M('Shop') -> where("enable=1") ->select();
        $statistic['itemType'] = count(M('Products')->where("enable=1")->select());
        $statistic['shopNum'] = count($itemData);

        for($i=0;$i<count($itemData);++$i){
        	$item[$i]['shopName'] = $itemData[$i][shopname];
        	if($itemData[$i][adminid]){
        		$item[$i]['shopOwner'] = M('Admin') -> where("adminId='%d'",$itemData[$i][adminid]) -> getField('adminNickname');
        	}else{
        		$item[$i]['shopOwner'] = "Eshop自营";
        	}
        	$products= M('Products')->where("shopId='%d'",$itemData[$i][shopid])->select();
        	$item[$i]['shopProducts'] = count($products);
        	$item[$i]['shopProfits'] = 0;
        	for($j=0;$j<count($products);++$j){
        		$sales = M('Orderitems') -> where("productId='%d'",$products[$j][productid]) -> select();
        		for($k=0;$k<count($sales);++$k){
        			$item[$i]['shopProfits'] += $sales[$k][quantity] * $products[$j][productprice];
        		}
        	}
        }
        $this->assign('item',$item);
        $this->assign('statistic',$statistic);
        $this->display();
    }
}