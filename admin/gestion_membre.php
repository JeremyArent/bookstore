<?php
include('../connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

if(isset($_POST['ajouter'])){
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $cp = $_POST['cp'];
    $courriel = $_POST['courriel'];
        
    if($pseudo&&$password&&$nom&&$prenom&&$adresse&&$ville&&$date_naissance&&$cp&&$courriel){
        if(strlen($pseudo)>4){
            $verifpseudo = "SELECT COUNT(*) as pseudo FROM client WHERE pseudo='".$pseudo."'";
            $exist = mysql_query($verifpseudo);
            $reponse = mysql_fetch_array($exist);           
                if($reponse['pseudo']!=0){
                    $error_verifpseudo = "Ce nom d'utilisateur est déjà utilisé";
                }else{
                    if(strlen($password)>4){
                        $password = md5($password);
                        $req = "INSERT INTO client VALUES ('', '$pseudo', '$nom', '$prenom', '$password', '$date_naissance', '$adresse', '$ville', '$cp', '$courriel', 'Ajouter à la main', '1')";
                        $sql = mysql_query($req);
                        $ok = "Utilisateur ajouté.";
                    }else{
                        $error_password = "Le mot de passe est trop court";
                    }
                }
        }
    }
}        

if(isset($_POST['modifier'])){
    $id = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $cp = $_POST['cp'];
    $courriel = $_POST['courriel'];
    if($pseudo&&$nom&&$prenom&&$cp&&$adresse&&$ville&&$date_naissance&&$courriel){
        $req = "UPDATE client SET id=".$id.", pseudo='".$pseudo."', nom='".$nom."', prenom='".$prenom.
                "', date_naissance='".$date_naissance."', adresse='".$adresse."', ville='".$ville."',
                code_postal='".$cp."', courriel='".$courriel."'";
        $sql = mysql_query($req);
    }
}

if(isset($_GET['del'])){
    $req = "DELETE FROM client WHERE id=".$_GET['del'];
    $sql = mysql_query($req);
    $supp = "Le salarié a été supprimé.";
}

?>

<div class="center_content">
    <div class="left_content">

        <div class="title">
            <span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>
            Gestion des Accès
        </div>
        
        <?php
        if(Auth::isLog()){
        ?>
        <div class="feat_prod_box">
            <form id="gestion_acces" name="formGestMembre" action="gestion_membre.php" method="POST">
                    <fieldset>
                        <legend>Liste des Membres</legend>
                        Choisir un membre <select name="nomChoisi" id="nomChoisi" onchange='go()'>
                            <option value='-1'>Liste</option>
                            <?php
                            $req = "SELECT * FROM client";
                            $sql = mysql_query($req);
                            while ($row = mysql_fetch_array($sql)) {
                                echo "<option value=".$row['id'].">".$row['prenom']." ".$row['nom']."</option>";
                            }
                            ?>
                        </select>								 
                        <input type="submit" name="valider" value="Valider" />
                    </fieldset>
             </form>
            
            <?php
            if(isset($supp)){
                echo $supp;
            }
            if(isset($error_password)){
                echo $error_password;
            }
            if(isset($error_verifpseudo)){
                echo $error_verifpseudo;
            }
            if(isset($ok)){
                echo $ok;
            }
            ?>
            <h2>Ajouter un salarié</h2>
            <form method="POST" action="gestion_membre.php">
                <table>
                <tr>
                    <td><input type="hidden" name="id" value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" name="pseudo" value="" placeholder="Pseudo"/></td>
                    <td><input type="password" name="password" value="" placeholder="Password"</td>
                    <td><input type="text" name="nom" value="" placeholder="Nom"/></td>
                    <td><input type="text" name="prenom" value="" placeholder="Prénom"/></td>
                    <td><input type="date" name="date_naissance" value="" placeholder="Date Naissance"/></td>
                </tr>
                <tr>
                    <td><input type="text" name="adresse" value="" placeholder="Adresse"/></td>
                    <td><input type="text" name="ville" value="" placeholder="Ville"/></td>
                    <td><input type="text" name="cp" value="" placeholder="Code Postal"/></td>
                    <td colspan="3"><input type="text" name="courriel" value="" placeholder="Courriel"/></td>
                </tr>
                </table>
                <input type="submit" name="ajouter" value="Ajouter"/>
            </form>
            <?php
            if(isset($_POST['valider'])){
            ?>
            <br/>
            
            <h2>Modifier un salarié</h2>
            <form method="POST" action="gestion_membre.php">
            <table>
                <tr>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Age</th>
                    <th>Adresse</th>
                </tr>
            <?php
                 $req = "SELECT * FROM client WHERE id=".$_POST['nomChoisi'];
                 $sql = mysql_query($req);
                 while($row = mysql_fetch_array($sql)){
             ?>
                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $row['id'];?>"/></td>
                </tr>
                <tr>
                    <td><input type="text" name="pseudo" value="<?php echo $row['pseudo'];?>"/></td>
                    <td><input type="text" name="nom" value="<?php echo $row['nom'];?>"/></td>
                    <td><input type="text" name="prenom" value="<?php echo $row['prenom'];?>"/></td>
                    <td><input type="date" name="date_naissance" value="<?php echo $row['date_naissance'];?>"/></td>
                    <td><input type="text" name="adresse" value="<?php echo $row['adresse'];?>"/></td>
                </tr>
                
             <?php
                 }
             ?>
                <tr>
                    <th>Ville</th>
                    <th>Code Postal</th>
                    <th>Courriel</th>
                    <th>Action</th>
                </tr>
                <?php
                 $req = "SELECT * FROM client WHERE id=".$_POST['nomChoisi'];
                 $sql = mysql_query($req);
                 while($row = mysql_fetch_array($sql)){
             ?>
                <tr>
                    <td><input type="text" name="ville" value="<?php echo $row['ville'];?>"/></td>
                    <td><input type="text" name="cp" value="<?php echo $row['code_postal'];?>"/></td>
                    <td><input type="text" name="courriel" value="<?php echo $row['courriel'];?>"/></td>
                    <td style="text-align: center;"><a href="gestion_membre.php?del=<?php echo $row['id'];?>">
                    <img src="images/close.gif"/></a></td>
                </tr>
                
             <?php
                 }
             ?>
             </table>
             <input type="submit" name="modifier" value="Enregistrer"/>
            </form>
             <?php
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