<?php
include('../connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

if(isset($_POST['changer'])){
    $choix = $_POST['statutChoix'];
    $numero = $_POST['numero'];
    $req = "UPDATE commande SET statut ='".$choix."' WHERE num_com ='".$numero."'";
    $sql = mysql_query($req);
    $modif_ok = "Changement de statut effectué";
}elseif(isset($_POST['supprimer'])){
    $numero = $_POST['numero'];
    $req = "DELETE FROM commande WHERE num_com ='".$numero."'";
    $sql = mysql_query($req);
    $supp = "Suppression effectuée";
}

?>

<div class="center_content">

    <div class="left_content">

        <div class="title">
            <span class="title_icon">
                <img src="images/bullet1.gif" alt="" title="" />
            </span>
            Gestion des Commandes
        </div>

        <?php
        if(Auth::isLog()){
        ?>
        <div class="feat_prod_box">
            <form id="gestion_commande" name="formGestCom" action="gestion_commande.php" method="POST">
                    <fieldset>
                        <legend>Liste des Commandes</legend>
                        Choisir un numéro de commande <select name="comChoisi" id="comChoisi" onchange='go()'>
                            <option value='-1'>Liste</option>
                            <?php
                            $req = "SELECT * FROM commande GROUP BY num_com";
                            $sql = mysql_query($req);
                            while ($row = mysql_fetch_array($sql)) {
                                echo "<option value=".$row['num_com'].">".$row['num_com']." (".$row['statut'].")</option>";
                            }
                            ?>
                        </select>								 
                        <input type="submit" name="valider" value="Valider" />
                    </fieldset>
             </form>
            
             <?php
             if(isset($modif_ok)){echo $modif_ok;}
             if(isset($supp)){ echo $supp;}
             
             if(isset($_POST['valider'])){
                 $numero = $_POST['comChoisi'];
             ?>
             <br/>
             <?php
             mysql_query("SET NAMES 'utf8'");
             $req = "SELECT commande.*, nom, prenom FROM commande, client
                     WHERE num_com='".$numero."' AND client.id = commande.id_client LIMIT 1";
             $sql = mysql_query($req);
             while($rows = mysql_fetch_array($sql)){
             ?>
                <strong>Numéro: </strong><?php echo $rows['num_com'];?><br/>
                <strong>Client: </strong><?php echo $rows['prenom']." ".$rows['nom'];?><br/>
                <strong>Date: </strong><?php echo $rows['date'];?><br/>
                <strong>Statut: </strong><?php echo $rows['statut'];}?><br/><br/>
                 <table border="1px" width="90%">
                     <tr>
                         <th>Article</th>
                         <th>Qté</th>
                         <th>P.U</th>
                     </tr>
             <?php
             
             $req = "SELECT commande.*, titre FROM commande, livre WHERE num_com='".$numero."' AND livre.id = commande.id_livre";
             $sql = mysql_query($req);
             while($rows = mysql_fetch_array($sql)){
             ?>
                     <tr>
                         <td><?php echo $rows['titre'];?></td>
                         <td><?php echo $rows['qte'];?></td>
                         <td><?php echo $rows['prixUnit'];?>€</td>
                     </tr>

              <?php
              }
              ?>
                </table>
                <?php
                $req = "SELECT commande.*, nom, prenom FROM commande, client
                        WHERE num_com='".$numero."' AND client.id = commande.id_client LIMIT 1";
                $sql = mysql_query($req);
                while($rows = mysql_fetch_array($sql)){
                ?>   
             
                <form action="gestion_commande.php" method="POST">
                 Modifier statut de la facture:
                 <input type="hidden" name="numero" value="<?php echo $rows['num_com'];?>"/>
                 <select name="statutChoix" id="statutChoix" onchange='go()'>
                    <option value='En Cours'>En Cours</option>
                    <option value='Valider'>Valider</option>
                    <option value='Annuler'>Annuler</option>
                 </select>								 
                 <input type="submit" name="changer" value="Valider" /><br/>
                 Supprimer la facture ?
                 <input type="submit" name="supprimer" value="Supprimer"/>
                </form>
                
                
             
             
             <?php
                }
             }
             ?>
             
        </div>
        <?php
        }else{
        ?>
        <div class="feat_prod_box">
            Vous n'avez pas les droits pour accéder à cette partie.
        </div>
        <?php
        }
        ?>	

        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/footer.php');
?>