<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$condition = (((cookie('cid') && session('cid')) != null) && ((cookie('token') && session('token'))!=null));
        if($condition){
        	$this->redirect('/Admin/Dashboard');
        }else{
        	$this->redirect('/Admin/Dashboard');
        }
    }
}