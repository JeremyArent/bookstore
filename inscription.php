<?php
require_once ('mailer/class.phpmailer.php');

include('connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

if(isset($_POST['valider']))
{   
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars(trim($_POST['password']));
    $email = $_POST['email'];
    $age = $_POST['age'];
    $ville = htmlspecialchars($_POST['ville']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $cp = htmlspecialchars(trim($_POST['cp']));
    $term = $_POST['terms'];
    $token = md5(uniqid(rand()));
    
    if($pseudo&&$prenom&&$nom&&$password&&$email&&$age&&$ville&&$adresse&&$cp&&$term){
        
        if(strlen($pseudo)>4){
            $verifpseudo = "SELECT COUNT(*) as pseudo FROM client WHERE pseudo='".$pseudo."'";
            $exist = mysql_query($verifpseudo);
            $reponse = mysql_fetch_array($exist);           
                if($reponse['pseudo']!=0){
                    $error_verifpseudo = "Ce nom d'utilisateur est déjà utilisé";
                }else{
                    if(strlen($password)>4){
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $password = md5($password);
                        $verifemail = "SELECT COUNT(*) as nombre FROM client WHERE courriel='".$email."'";
                        $exist = mysql_query($verifemail);
                        $reponse = mysql_fetch_array($exist);

                        if($reponse['nombre'] != 0){
                           $error_verifemail = "Cet e-mail est déjà utilisé";
                        }else{
                        $req = mysql_query("INSERT INTO client VALUES('','$pseudo','$prenom','$nom','$password','$age','$adresse','$ville','$cp','$email','$token', '')");
                        
                        $to = $email;
                        $subject = "Activation de votre lien";
                        $message = "Veuillez activer votre compte en cliquant ici : bibliobook.p.ht/activate.php?token=".$token."&email=".$to;
                        $headers = 'MIME-Version 1.0'."\r\n";
                        $headers .= 'Content-type:text/html; charset:UTF-8'."\r\n";
                        $headers .= 'From : http://bibliobook.p.ht' . "\r\n" .
                                    'Reply-To: contact@bibliobook.p.ht' . "\r\n" . 
                                    'X-Mailer : PHP/' . phpversion();
                        function smtpmailer($to,$subject,$message,$headers){
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
							if(!$mail->Send()){
								$error = 'Mail error :'.$mail->ErrorInfo;
								return false;
							}
							else{
								$error = 'Mail send';
								return true;
							}
						}
						smtpmailer($to,$subject,$message,$headers);
							
					
                        
                        } 
                        }else{
                            $error_email = "E-mail non valide";
                        }  
                    }else{
                        $error_password = "Mot de Passe trop court";
                    }
                }
        }else{
            $error_pseudo = "Pseudo trop court";
        }
        
    }else{
        $error_general = "Veuillez saisir tous les champs et accepter les conditions";
    }
    
}

?>

<div class="center_content">
    <div class="left_content">
        
        <?php
            if(isset($error_general)){echo '<div style="color:brown">'.$error_general.'</div>';}
        ?>
        
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>S'enregistrer</div>

        <div class="feat_prod_box_details">
            <p class="details">
                Inscrivez-vous pour pouvoir profiter des avantages du site.
            </p>

            <div class="contact_form">
                <div class="form_subtitle">Créer un compte</div>
                <form name="register" method="POST" action="inscription.php">  
                    <div class="form_row">
                        <label class="contact"><strong>Pseudo:</strong></label>
                        <input type="text" name="pseudo" class="contact_input" />
                            <?php if(isset($error_pseudo)){echo '<div class="contact_input">'.$error_pseudo.'</div>';}
                                  if(isset($error_verifpseudo)){echo '<div class="contact_input">'.$error_verifpseudo.'</div>';}
                            ?>
                    </div>  
                    
                    <div class="form_row">
                        <label class="contact"><strong>Prénom:</strong></label>
                        <input type="text" name="prenom" class="contact_input" />
                    </div>  
                    
                    <div class="form_row">
                        <label class="contact"><strong>Nom:</strong></label>
                        <input type="text" name="nom" class="contact_input" />
                    </div>  

                    <div class="form_row">
                        <label class="contact"><strong>Password:</strong></label>
                        <input type="password" name="password" class="contact_input" />
                        <?php if(isset($error_password)){echo '<div class="contact_input">'.$error_password.'</div>';}?>
                    </div> 

                    <div class="form_row">
                        <label class="contact"><strong>Email:</strong></label>
                        <input type="text" name="email" class="contact_input" />
                            <?php 
                            if(isset($error_email)){echo '<div class="contact_input">'.$error_email.'</div>';}
                            if(isset($error_verifemail)){echo '<div class="contact_input">'.$error_verifemail.'</div>';}
                            ?>
                    </div>
                    
                    <div class="form_row">
                        <label class="contact"><strong>Âge:</strong></label>
                        <input type="text" name="age" class="contact_input" value="AAAA-MM-DD" />
                    </div> 

                    <div class="form_row">
                        <label class="contact"><strong>Ville:</strong></label>
                        <input type="text" name="ville" class="contact_input" />
                    </div>

                    <div class="form_row">
                        <label class="contact"><strong>Adresse:</strong></label>
                        <input type="text" name="adresse" class="contact_input" />
                    </div>

                    <div class="form_row">
                        <label class="contact"><strong>Code Postal:</strong></label>
                        <input type="text" name="cp" class="contact_input" />
                    </div>                    

                    <div class="form_row">
                        <div class="terms">
                            <input type="checkbox" name="terms" value="ok" />
                            J'accepte les <a href="conditions.php">termes &amp; conditions d'utilisation</a>
                        </div>
                    </div> 


                    <div class="form_row">
                        <input type="submit" class="register" name="valider" value="Valider" />
                    </div>   
                </form>     
            </div>  

        </div>	






        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>