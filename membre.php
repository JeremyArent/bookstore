<?php

require_once('class/auth.class.php');

include('connexion/connexDB.php');

include('connexion/PDO.php');

include('includes/header.php');

include('includes/menu.php');

if(Auth::isLog()){
    $req = "SELECT * FROM client WHERE pseudo ='".$_SESSION['Auth']['pseudo']."'";
    $sql = mysql_query($req);
    while($row = mysql_fetch_array($sql)){
?>
        <div class="center_content">

        <div class="left_content">

            <br/>
            Modifier ses informations personnelles<br/>

            Pseudo : <input type="text" name="pseudo" value="<?php echo $_SESSION['Auth']['pseudo']; ?>"><br/>
            Prenom : <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"><br/>
            Nom : <input type="text" name="prenom" value="<?php echo $row['nom']; ?>"><br/>
            Adresse : <input type="text" name="prenom" value="<?php echo $row['adresse']; ?>"><br/>
            Ville : <input type="text" name="prenom" value="<?php echo $row['ville']; ?>"><br/>
            Code Postal : <input type="text" name="prenom" value="<?php echo $row['code_postal']; ?>"><br/>

            </br><a href="logout.php">Se déconnecter</a>

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
