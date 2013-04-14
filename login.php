<?php

include('connexion/connexDB.php');

include('connexion/PDO.php');

include('includes/header.php');

include('includes/menu.php');

if(isset($_POST['login'])){
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    
    if($pseudo&&$password){
        $password = md5($password);
        $q = array('pseudo'=>$pseudo,'password'=>$password);
        $sql = "SELECT * FROM client WHERE pseudo= :pseudo AND password= :password";
        $req = $cnx->prepare($sql);
        $req->execute($q);
        $row = $req->rowCount($sql);
        if($row == 1){
            // Vérifier si l'utilisateur est actif
            $sql = "SELECT * FROM client WHERE pseudo= :pseudo AND password= :password AND active = 1";
            $req = $cnx->prepare($sql);
            $req->execute($q); 
            $actif = $req->rowCount($sql);
                if($actif == 1){
                    $_SESSION['Auth'] = array(
                        'pseudo' => $pseudo,
                        'password' => $password,
                    );
                    header('Location:membre.php');
                }else{
                    $error_actif = 'Votre compte n\'est pas actif';
                }
        }else{
            $error_unknown = 'Veuillez créer un compte';    
        }
    }
    
}

?>       

<div class="center_content">
    <div class="left_content">
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Mon compte</div>
        <?php
        if (isset($error_actif)) {
            echo '<div class="contact_input">' . $error_actif . '</div>';
        }
        if (isset($error_unknown)) {
            echo '<div class="contact_input">' . $error_unknown . '</div>';
        }
        ?>
        <div class="feat_prod_box_details">
            <p class="details">
               Connectez-vous
            </p>

            <div class="contact_form">
                <div class="form_subtitle">Se Connecter</div>
                <form name="register" method="POST" action="login.php">          
                    <div class="form_row">
                        <label class="contact"><strong>Pseudo:</strong></label>
                        <input type="text" name="pseudo" class="contact_input" />
                    </div>  


                    <div class="form_row">
                        <label class="contact"><strong>Password:</strong></label>
                        <input type="password" name="password" class="contact_input" />
                    </div>                      
                    
                    <div class="form_row">
                        <input type="submit" class="register" name="login" value="Login" />
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