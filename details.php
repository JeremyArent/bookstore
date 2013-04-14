<?php
include('includes/header.php');

include('includes/menu.php');

include('connexion/connexDB.php');

include_once '_header.php';

$idLivre = $_GET['id'];
$idAuteur = $_GET['aut'];

?>

<div class="center_content">
    <div class="left_content">
      
        <div class="title">
            <span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>
            <?php
            $products = $DB->query('SELECT livre.*, editeur.nom AS edit, auteur.nom, auteur.prenom 
                                    FROM livre,editeur,auteur 
                                    WHERE auteur.id = livre.id_auteur
                                    AND editeur.id = livre.id_editeur
                                    AND livre.id = '.$idLivre);
            foreach ( $products as $product ):
            echo $product->titre;
            
            ?>
        </div>

        <div class="feat_prod_box_details">

            <div class="prod_img"><img src="<?php echo $product->couverture_full;?>" alt="" title="" border="0" />
                <br /><br />
            </div>

            <div class="prod_det_box">
                <div class="box_top"></div>
                <div class="box_center">
                    <div class="prod_title">Détails</div>
                    <p class="details">
                        <?php echo $product->resume;?>
                    </p>
                    <div class="price"><strong>Prix:</strong> <span class="red"><?php echo number_format($product->prix,2,',',' ');?> €</span></div>
                    <a class="more addPanier" href="addpanier.php?id=<?php echo $product->id; ?>"><img src="images/order_now.gif" alt="" title="" border="0" /></a>
                    <div class="clear"></div>
                </div>

                <div class="box_bottom"></div>
            </div>    
            <div class="clear"></div>
        </div>	

        <div id="demo" class="demolayout">

            <ul id="demo-nav" class="demolayout">
                <li><a class="active" href="#tab1">Plus de détails</a></li>
                <li><a class="" href="#tab2">Livre du même auteur</a></li>
            </ul>

            <div class="tabs-container">

                <div style="display: block;" class="tab" id="tab1">
                    <ul class="list">
                        <li><strong>Titre :</strong><span class="red"><?php echo ' '.$product->titre;?></span></li>
                        <li><strong>Auteur :</strong><span class="red"><?php echo ' '.$product->prenom.' '.$product->nom;?></span></li>
                        <li><strong>Editeur :</strong><span class="red"><?php echo ' '.$product->edit;?></span></li>
                        <li><strong>Nombre de page :</strong><span class="red"><?php echo ' '.$product->nbr_page;?></span></li>                                       
                        <li><strong>Catégorie :</strong><span class="red"><?php echo ' '.$product->categorie1;?></span></li>
                    </ul>                         
                </div>	
                <?php endforeach ?>
                <div style="display: none;" class="tab" id="tab2">
                    <?php 
                        mysql_query("SET NAMES 'utf8'");
                        $req = "SELECT *
                                FROM livre
                                WHERE id_auteur=".$idAuteur."
                                AND id!=".$idLivre."
                                LIMIT 6";
                        $res = mysql_query($req);
                        
                        while ($row = mysql_fetch_array($res)) {
                    ?>
                    <div class="new_prod_box">
                        <a href="<?php echo 'details.php?id='.$row['id'].'&aut='.$row['id_auteur']; ?>"><?php echo $row['titre'];?></a>
                        <div class="new_prod_bg">
                            <a href="<?php echo 'details.php?id='.$row['id'].'&aut='.$row['id_auteur']; ?>"><img src="<?php echo $row['couverture_small']; ?>" height="90px" width="60px" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>
                    <?php
                        };
                    ?>
                    <div class="clear"></div>
                </div>	

            </div>


        </div>



        <div class="clear"></div>
    </div><!--end of left content-->


    <script type="text/javascript">

        var tabber1 = new Yetii({
            id: 'demo'
        });

    </script>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script type="text/javascript" src="js/app.js"></script>
    


<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>