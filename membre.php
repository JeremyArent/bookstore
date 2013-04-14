<?php

require_once('class/auth.class.php');

include('connexion/connexDB.php');

include('connexion/PDO.php');

include('includes/header.php');

include('includes/menu.php');

if(isset($_POST['modifier'])){
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $date_naissance = $_POST['date_naissance'];
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $cp = htmlspecialchars($_POST['cp']);
    if($prenom&&$nom&&$date_naissance&&$adresse&&$ville&&$cp){
        $req = "UPDATE client  
                SET nom='".$nom."', prenom ='".$prenom."', date_naissance='".$date_naissance."',
                adresse ='".$adresse."', ville='".$ville."', code_postal='".$cp."'";
        $sql = mysql_query($req);
        $insert = "Modifications effectuées";
    }
}

if(Auth::isLog()){
    $req = "SELECT * FROM client WHERE pseudo ='".$_SESSION['Auth']['pseudo']."'";
    $sql = mysql_query($req);
    while($row = mysql_fetch_array($sql)){
?>
        <div class="center_content">

        <div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Profil Utilisateur</div>
            <?php
            if(isset($insert)){echo $insert;}
            ?>
            <form method="POST" action="membre.php">
                <div class="feat_prod_box_details">
                    
                    <div class="contact_form">
                        <div class="form_subtitle">Modifier ses informations personnelles</div>  
                        
                        <div class="form-row"><label class="contact"><strong>Pseudo :</strong></label> 
                            <input style="background-color:#C0C0C0" type="text" name="pseudo" readonly="true" value="<?php echo $_SESSION['Auth']['pseudo']; ?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Prenom :</strong></label>
                            <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Nom :</strong></label>
                            <input type="text" name="nom" value="<?php echo $row['nom']; ?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Âge :</strong></label>
                            <input type="date" name="date_naissance" value="<?php echo $row['date_naissance'];?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Âge :</strong></label>
                            <input style="background-color:#C0C0C0" type="text" readonly="true" name="courriel" value="<?php echo $row['courriel'];?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Adresse :</strong></label>
                            <input type="text" name="adresse" value="<?php echo $row['adresse']; ?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Ville :</strong></label>
                            <input type="text" name="ville" value="<?php echo $row['ville']; ?>">
                        </div>
                        
                        <div class="form-row"><label class="contact"><strong>Code Postal :</strong></label>
                            <input type="text" name="cp" value="<?php echo $row['code_postal']; ?>">
                        </div>
                    </div>
                </div>
                
                <input type="submit" name="modifier" value="Modifier son profil"/>
                
            </form>
            
            


            <div class="clear"></div>

        </div><!--end of left content-->
<?php
    }
}else{
    header('Location:login.php');
}
?>        
        
<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>
