<?php
include('includes/header.php');

include('includes/menu.php');

include_once('_header.php');

if(isset($_GET['del'])){
    $panier->del($_GET['del']);
}

?>

<div class="center_content">
    <div class="left_content">
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Mon Panier</div>
        
        <div class="feat_prod_box_details">
            <form method="POST" action="panier.php">
            <table class="cart_table">
                <tr class="cart_title">
                    <td>Articles</td>
                    <td>Titre Livre</td>
                    <td>Prix Unitaire</td>
                    <td>Remise</td>
                    <td class="qte">Qté</td>
                    <td>Total</td>
                    <td>Action</td>
                </tr>
                <?php 
                $ids = array_keys($_SESSION['panier']);
                if(empty($ids)){
                    $product = array();
                }else{
                    $product = $DB->query('SELECT * FROM livre WHERE id IN ('.implode(',',$ids).')');
                }
                foreach ($product as $product):
                ?>
                <tr>
                    <td><a href="<?php echo 'details.php?id='.$product->id.'&aut='.$product->id_auteur; ?>"><img src="<?php echo $product->couverture_small;?>" width="60px" height="90px" alt="" title="" border="0" class="cart_thumb" /></a></td>
                    <td><?php echo $product->titre; ?></td>
                    <td><?php echo number_format($product->prix,2,',',' '); ?>€</td>
                    <td><?php 
                    if($product->reduction == '1'){
                        echo "-10%";
                    }else{
                        echo " ";
                    }
                    ?></td>
                    <td><input type="text" style="text-align: center;" name="panier[qte][<?php echo $product->id;?>]" value="<?php echo $_SESSION['panier'][$product->id]; ?>" size="1"></input></td>
                    <?php
                        $reduc = 0.9;
                        if($product->reduction == '1'){
                        $cal = $product->prix*$_SESSION['panier'][$product->id]*$reduc;
                        }else{
                        $cal = $product->prix*$_SESSION['panier'][$product->id];
                        }
                    ?>
                    <td><?php echo number_format($cal,2,',',' '); ?>€</td> 
                    <td><a href="panier.php?del=<?php echo $product->id; ?>"><img src="images/close.gif"/></a></td>
                </tr>          
                <?php endforeach;?>
                <tr>
                    <td colspan="20"><span><input class="continue" type="submit" value="Recalculer"></span></td>
                </tr>
                <tr>
                    <td colspan="4" class="cart_total"><span class="red">Frais de port:</span></td>
                    <td><?php 
                              $port = 0;
                              if($panier->total()>20){ 
                                    $port = 3.50; 
                                    echo number_format($port,2,',',' ')."€";   
                              }else{ 
                                    echo "offert";
                              } 
                         ?>
                    </td>                
                </tr>                  
                <tr>
                    <td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
                    <td><?php echo number_format($port+($panier->total()),2,',',' '); ?>€</td>                
                </tr>                  

            </table>
            </form>
            <a href="livre.php" class="continue">&lt; continue</a>
            <a href="confirmation_achat.php?stepA" class="checkout">valider &gt;</a>




        </div>	
        
        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>