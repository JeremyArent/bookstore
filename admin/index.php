<?php
include('../connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

if(isset($_POST['login'])){
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    
    if($pseudo&&$password){
        $password = md5($password);
        $q = array('pseudo'=>$pseudo,'password'=>$password);
        $sql = "SELECT * FROM admin WHERE pseudo= :pseudo AND password= :password";
        $req = $cnx->prepare($sql);
        $req->execute($q);
        $row = $req->rowCount($sql);
                    $_SESSION['Auth'] = array(
                        'pseudo' => $pseudo,
                        'password' => $password,
                    );
                    header('Location:index.php');
        }else{
            $error_unknown = 'Veuillez créer un compte';    
        }
    
    
}

?>

<div class="center_content">

    <div class="left_content">

        <div class="title">  


            <span class="title_icon">  
                <img src="images/bullet1.gif" alt="" title="" />
            </span>
            Accueil
        </div>
        <?php
        if(Auth::isLog()){
        ?>
        <div class="feat_prod_box">
            <p>Vous êtes dans la zone d'administration.</p>
            Ici vous pouvez gérer et voir :
            <li>la gestion des livres, des auteurs, des maisons d'édition;</li>
            <li>la gestion des membres;</li>
            <li>la gestion des commandes;</li>
            <li>la gestion des accès;</li>
            <li>le module des statistiques;</li>
            <li>les sauvegardes.</li>
        </div>
        <?php
        }else{
        ?>
        <div class="feat_prod_box">
            <p class="details">
               Connectez-vous
            </p>

            <div class="contact_form">
                <div class="form_subtitle">Se Connecter</div>
                <form name="register" method="POST" action="index.php">          
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
        <?php
        }
        ?>
        <div class="clear"></div>

    </div><!--end of left content-->

<?php
include('includes/footer.php');
?>