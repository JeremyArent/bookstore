<?php
include('includes/header.php');

include('connexion/connexDB.php');

include('includes/menu.php');

if(isset($_POST['valider'])){
    $nom = htmlspecialchars($_POST['nom']);
    $courriel = $_POST['courriel'];
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);
    if($nom&&$courriel&&$message){
        $req = "INSERT INTO contact VALUES ('', '$nom', '$courriel', '$sujet', '$message')";
        $sql = mysql_query($req);
        $ok = "Message envoyé avec succès";
    }else{
        $error_envoi = "Veuillez remplir tous les champs";
    }
}

?>

<div class="center_content">
    <div class="left_content">
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Nous contacter</div>
        
        <?php
        if(isset($error_envoi)){ echo $error_envoi;}
        if(isset($ok)){echo $ok;}
        ?>
        
        <form method="post" action="contact.php">
        <div class="feat_prod_box_details">
            <p class="details">
                Pour nous contacter, remplissez le formulaire suivant :
            </p>

            <div class="contact_form">
                <div class="form_subtitle">Tous les champs sont requis</div>          
                <div class="form_row">
                    <label class="contact"><strong>Nom:</strong></label>
                    <input type="text" class="contact_input" name="nom" value="" />
                </div>  

                <div class="form_row">
                    <label class="contact"><strong>Email:</strong></label>
                    <input type="text" name="courriel" class="contact_input" value=""/>
                </div>
                
                <div class="form_row">
                    <label class="contact"><strong>Sujet:</strong></label>
                    <input type="text" name="sujet" class="contact_input" value="" > 
                </div>

                <div class="form_row">
                    <label class="contact"><strong>Message:</strong></label>
                    <textarea name="message" class="contact_textarea" ></textarea>
                </div>


                <div class="form_row">
                    <input type="submit"  name="valider" value="Envoyer">                  
                </div>      
            </div>  

        </div>	
        </form>






        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>