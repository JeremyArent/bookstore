<?php
include('includes/header.php');

include('connexion/connexDB.php');

include('includes/menu.php');
?>

<div class="center_content">
    <div class="left_content">
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Nous contacter</div>
        
        <?php
        include 'contactForm.php';
        $contact = new ContactFormulaire();
        if(isset($_POST['nom'])){
            print_r($contact->loadForm($_POST));
        }
        ?>
        
        <form method="post">
        <div class="feat_prod_box_details">
            <p class="details">
                Pour nous contacter, remplissez le formulaire suivant :
            </p>

            <div class="contact_form">
                <div class="form_subtitle">Tous les champs sont requis</div>          
                <div class="form_row">
                    <label class="contact"><strong>Nom:</strong></label>
                    <input type="text" class="contact_input" name="nom" value="<?php echo $contact->nom; ?>" />
                </div>  

                <div class="form_row">
                    <label class="contact"><strong>Email:</strong></label>
                    <input type="text" name="mail" class="contact_input" value="<?php echo $contact->mail; ?>"/>
                </div>
                
                <div class="form_row">
                    <label class="contact"><strong>Sujet:</strong></label>
                    <input type="text" name="sujet" class="contact_input" value="<?php echo $contact->sujet; ?>" > 
                </div>

                <div class="form_row">
                    <label class="contact"><strong>Message:</strong></label>
                    <textarea name="message" class="contact_textarea" ><?php echo $contact->message; ?></textarea>
                </div>


                <div class="form_row">
                    <input type="submit"  name="envoyer" value="Envoyer">                  
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