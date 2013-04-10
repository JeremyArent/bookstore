<?php
include('connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

include_once('_header.php');

require_once('class/auth.class.php');

if(isset($_POST['vider'])){
    $ids = array_keys($_SESSION['panier']);
                if(empty($ids)){
                    $product = array();
                }else{
                    $product = $DB->query('SELECT * FROM livre WHERE id IN ('.implode(',',$ids).')');
                }
                foreach ($product as $product):
                unset($_SESSION['panier'][$product->id]);
     endforeach;
}

?>

<div class="center_content">
    <div class="left_content">
        Merci d'avoir passé commande sur notre site.<br>
        N'oubliez pas de vider votre panier.
        <form method="POST" action="merci.php">
        <input type="submit" name="vider" value="Vider votre panier"/>
        </form>    
            
        <div class="clear"></div>
</div><!--end of left content-->
        
<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');

        
?>