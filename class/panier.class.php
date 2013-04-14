<?php
class panier{

	private $DB;

	public function __construct($DB){
		if(!isset($_SESSION)){
			session_start();
		}
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
		}
		$this->DB = $DB;

		if(isset($_GET['del'])){
			$this->del($_GET['del']);
		}
		if(isset($_POST['panier']['qte'])){
			$this->recalc();
		}
	}

	public function recalc(){
		foreach($_SESSION['panier'] as $product_id => $qte){
			if(isset($_POST['panier']['qte'][$product_id])){
				$_SESSION['panier'][$product_id] = $_POST['panier']['qte'][$product_id];
			}
		}
	}

	public function count(){
		return array_sum($_SESSION['panier']);
	}

	public function total(){
		$total = 0;
		$ids = array_keys($_SESSION['panier']);
		if(empty($ids)){
			$products = array();
		}else{
			$products = $this->DB->query('SELECT id, prix, reduction FROM livre WHERE id IN ('.implode(',',$ids).')');
		}
		foreach( $products as $product ) {
                        $reduc = 0.9;
                        if($product->reduction == '1'){
			$total += $product->prix * $_SESSION['panier'][$product->id]*$reduc;
                        }else{
                        $total += $product->prix * $_SESSION['panier'][$product->id];    
                        }
		}
		return $total;
	}

	public function add($product_id){
		if(isset($_SESSION['panier'][$product_id])){
			$_SESSION['panier'][$product_id]++;
		}else{
			$_SESSION['panier'][$product_id] = 1;
		}
	}

	public function del($product_id){
		unset($_SESSION['panier'][$product_id]);
                header('Location:panier.php');
	}
}