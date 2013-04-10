<?php
include('connexion/connexDB.php');

include('connexion/PDO.php');

include('includes/header.php');

include('includes/menu.php');

$token = $_GET['token'];
$email = $_GET['email'];

if(!empty($_GET)){
    $q = array('email'=>$email,'token'=>$token);
    $sql = "SELECT courriel, token FROM client WHERE courriel = :email AND token = :token";
    $req = $cnx->prepare($sql);
    $req->execute($q);
    $count = $req->rowCount($sql);
    if($count == 1){
        // verifier si l'utilisateur est actif
        $v = array('email'=>$email,'active'=>1);
        $sql = "SELECT courriel, active FROM client WHERE courriel = :email AND active = :active";
        $req = $cnx->prepare($sql);
        $req->execute($v);
        $dejactif = $req->rowCount($sql);
        if($dejactif == 1){
            //Activation de l'utilisateur
            $error_actif = 'Votre compte est déjà activé';
            header('Location:index.php');
        }else{
            $u = array('email'=>$email, 'active'=>1);
            $sql = "UPDATE client SET active = :active WHERE courriel = :email";
            $req = $cnx->prepare($sql);
            $req->execute($u);
            $activated = 'Félicitation, vous avez activé votre compte correctement';
        }
    }else{
        $prob_token = 'Mauvais Token';
    }
}

?>
<div class="center_content">

    <div class="left_content">
        
        <div class="title">  
            <span class="title_icon">  
                <img src="images/bullet1.gif" alt="" title="" />
            </span>
            Activation
        </div>
        <div class="feat_prod_box_details"> 
        <?php 
            if(isset($error_actif)){echo '<div class="contact_input">'.$error_actif.'</div>';}
            if(isset($activated)){echo '<div class="contact_input">'.$activated.'</div>';}
            if(isset($prob_token)){echo '<div class="contact_input">'.$prob_token.'</div>';}
        ?>
        </div>
        <div class="clear"></div>
    </div><!--end of left content-->
    
    
<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>