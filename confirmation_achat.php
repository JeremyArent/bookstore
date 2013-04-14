<?php
include('connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

include_once('_header.php');

require_once('class/auth.class.php');
?>
<div class="center_content">
    <div class="left_content">

        
        
        
<!-- 
Formulaire : Confirmation des informations
-->

<?php
if(Auth::isLog()){
    if(isset($_GET['stepA'])){
?>
        <h3>Confirmation de votre achat</h3>    
        <?php
        $sql = "SELECT * FROM client WHERE pseudo='".$_SESSION['Auth']['pseudo']."';";
        $req = mysql_query($sql);
        while($row = mysql_fetch_array($req)){
        ?>
        
        
        <fieldset>
        <table>
            <legend><i>Confirmez votre informations</i></legend>
                <tr>
                    <td><strong>Votre nom :</strong</td>
                    <td><?php echo $row['nom'];?></td>
                </tr>
                <tr>
                    <td><strong>Votre prénom :</strong></td>
                    <td><?php echo $row['prenom'];?></td>
                </tr>
                <tr>
                    <td><strong>Date de naissance :</strong></td>
                    <td><?php echo $row['date_naissance'];?></td>
                </tr>
                <tr>
                    <td><strong>Votre adresse :</strong></td>
                    <td><?php echo $row['adresse'];?></td>
                </tr>
                <tr>
                    <td><strong>Votre ville :</strong></td>
                    <td><?php echo $row['ville'];?></td>
                </tr>
                <tr>
                    <td><strong>Votre code postal :</strong></td>
                    <td><?php echo $row['code_postal'];?></td>
                </tr>
                <tr>
                    <td><strong>Votre e-mail :</strong></td>
                    <td><?php echo $row['courriel'];?></td>
                </tr>
        </table>
        </fieldset>
        <a href="confirmation_achat.php?stepB"><input type='submit' value="Oui ces informations sont correctes"></input></a>
        <a href="membre.php"><input type="submit" value="Modifier mes informations"></input></a>
        <?php
        }
        ?>
        
<?php
    }else{
        if(isset($_GET['stepB'])){
?>
            <h3>Récapitulatif du Panier</h3>
            <div class="feat_prod_box_details">
            <table class="cart_table">
                <tr class="cart_title">
                    <td>Articles</td>
                    <td>Titre Livre</td>
                    <td>Prix Unitaire</td>
                    <td>Remise</td>
                    <td class="qte">Qté</td>
                    <td>Total</td>
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
                    <td><?php if($product->reduction == '1'){
                        echo "-10%";
                    }else{
                        echo "";
                    }
                    ?></td>
                    <td><?php echo $_SESSION['panier'][$product->id]; ?></td>
                    <?php 
                        $reduc = 0.9;
                        if($product->reduction == '1'){
                        $cal = $product->prix*$_SESSION['panier'][$product->id]*$reduc;
                        }else{
                        $cal = $product->prix*$_SESSION['panier'][$product->id];
                        } 
                    ?>
                    <td><?php echo number_format($cal,2,',',' '); ?>€</td> 
                </tr>          
                <?php endforeach;?>
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
            <a href="confirmation_achat.php?stepC"><input type='submit' value="Oui je confirme ces achats"></input></a>
            <a href="panier.php"><input type="submit" value="Modifier mon panier"></input></a>  
            <h3>Attention, cette étape validera définitivement la commande !</h3>
        </div>
<?php
        }else{
            if(isset($_GET['stepC'])){
                $ids = array_keys($_SESSION['panier']);
                if(empty($ids)){
                    $product = array();
                }else{
                    $product = $DB->query('SELECT * FROM livre WHERE id IN ('.implode(',',$ids).')');
                }
                foreach ($product as $product):
                $sql = "SELECT * FROM client WHERE pseudo='".$_SESSION['Auth']['pseudo']."';";
                $req = mysql_query($sql);
                while($row = mysql_fetch_array($req)){
                    $time = time();
                    $commande = "FR-00".$row['id']."-".$time;
                    $reqI = "INSERT INTO commande
                             VALUES('','".$commande."','".$product->id."',CURRENT_DATE,'".$row['id']."','".$product->prix."',
                             '".$_SESSION['panier'][$product->id]."', 'En Cours')";
                             $sql = mysql_query($reqI);
                             
                }
                
                /*$to = $email;
                $subject = "Facture n°";
                $message = "Bonjour,";
                $message .= "Ce mail confirme votre commande. Pour l'annuler contacter le service client.";            
                $headers = 'MIME-Version 1.0' . "\r\n";
                $headers .= 'Content-type:text/html; charset:UTF-8' . "\r\n";
                $headers .= 'From : http://bibliobook.p.ht' . "\r\n" .
                            'Reply-To: contact@bibliobook.p.ht' . "\r\n" .
                            'X-Mailer : PHP/' . phpversion();

                    function smtpmailer($to, $subject, $message, $headers) {
                        global $error;
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPDebug = 1;
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = 'ssl';
                        $mail->Host = 'mx1.hostinger.fr';
                        $mail->Port = 2525;
                        $mail->Username = 'contact@bibliobook.p.ht';
                        $mail->Password = '3MJ.93170/$$';
                        $mail->FromName = 'contact@bibliobook.p.ht';
                        $mail->From = 'contact@bibliobook.p.ht';
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        $mail->AddAddress($to);
                            if (!$mail->Send()) {
                                $error = 'Mail error :' . $mail->ErrorInfo;
                                return false;
                            } else {
                                $error = 'Mail send';
                                return true;
                            }
                        }

                        smtpmailer($to, $subject, $message, $headers);*/
                    endforeach;
                
?>          
                <p>Votre commande a bien été prise en compte. <strong style="color:red">La facture au format PDF vous sera fourni dans 
                quelques instant.</strong>
                Enregistrez la sur votre ordinateur pour en garder une trace.
                Nous vous invitons à envoyer un chèque à l'ordre de <strong>Maison Biblio</strong> à l'adresse suivante :</p></br>
                102, rue de Paris</br>
                75020 PARIS</br></br>
                <p>Pour toute demande d'annulation, contacter le service client au 01-XX-XX-XX-XX</p>
                
                <a href="pdf.php" name="pdf" target=_blank onClick="window.location='merci.php'">Générer la facture</a>
                
                
<?php       
                   
              
                
        }else{
                if($_GET != $_GET['stepA'] && $_GET != $_GET['stepB'] && $_GET != $_GET['stepC']){
                    header('Location:confirmation_achat.php?stepA');
                }
            }
        }
    }
}else{
    echo "Veuillez vous connecter ou créer un compte";
}
?>        
     <div class="clear"></div>
</div><!--end of left content-->
        
<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>
