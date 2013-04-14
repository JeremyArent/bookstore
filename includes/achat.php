<?php
require_once '_header.php';
?>
<div class="right_content">
            <!--<div class="languages_box">
            <span class="red">Langages:</span>
            <a href="#" class="selected"><img src="images/gb.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/fr.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/de.gif" alt="" title="" border="0" /></a>
            </div>-->
                <!--<div class="currency">
                <span class="red">Monnaie: </span>
                <a href="#">GBP</a>
                <a href="#" class="selected">EUR</a>
                <a href="#">USD</a>
                </div>-->
                
              <?php
                    if(isset($_SESSION['Auth']['pseudo'])){
                    echo "Vous êtes connecté en tant que <strong>".$_SESSION['Auth']['pseudo']."</strong>";
                    }
                    
              ?>
              <div class="cart">
                  <div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span>Mon panier</div>
                  <div class="home_cart_content">
                  <span id="count"><?php echo $panier->count();?></span> x articles | <span class="red" id="total">TOTAL: <?php echo number_format($panier->total(),2,',',' '); ?>€</span>
                  </div>
                  <a href="panier.php" class="view_cart">Voir panier</a>
              
              </div>