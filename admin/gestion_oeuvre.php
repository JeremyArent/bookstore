<?php
include('includes/header.php');

include('includes/menu.php');

include('../connexion/connexDB.php');
/*
 *  Traitement du formulaire d'ajout d'un auteur
 */

if(isset($_POST['submit_ajout_auteur'])){
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nationalite = htmlspecialchars($_POST['nationalite']);
    $date_n = $_POST['date_naissance'];
    $date_d = $_POST['date_deces'];
    
    if($nom&&$prenom&&$nationalite&&$date_n){
        mysql_query("SET NAMES 'utf8'");
        $req = "INSERT INTO auteur(id, nom, prenom, nationalite, annee_naissance, annee_deces) 
                VALUES ('', '$nom', '$prenom', '$nationalite', '$date_n', '$date_d')";
        $sql = mysql_query($req);
        $ok_ajout_auteur = "L'ajout s'est bien effectué.";
    }else{
        $fail_ajout_auteur = "Vous n'avez pas rempli tous les champs !";
    }
}

/*
 *  Traitement du formulaire d'ajout d'une maison d'édition
 */

if(isset($_POST['submit_ajout_edition'])){
    $nom = htmlspecialchars($_POST['nom']);
    $nationalite = htmlspecialchars($_POST['nationalite']);
    $creation = $_POST['creation'];
    
    if($nom&&$nationalite&&$creation){
        mysql_query("SET NAMES 'utf8'");
        $req = "INSERT INTO editeur(id, nom, nationalite, date_creation) 
                VALUES ('', '$nom', '$nationalite', '$creation')";
        $sql = mysql_query($req);
        $ok_ajout_editeur = "L'ajout s'est bien effectué.";
    }else{
        $fail_ajout_editeur = "Vous n'avez pas rempli tous les champs !";
    }
}

/*
 *  Traitement formulaire d'ajout d'un livre
 */

if(isset($_POST['submit_ajout_livre'])){
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];
    $editeur = $_POST['editeur'];
    $prix = $_POST['prix'];
    $page = $_POST['page'];
    $langue = $_POST['langue'];
    $reduction = $_POST['reduction'];
    $resume = $_POST['resume'];
    $image_full = $_POST['image_full'];
    $image_small = $_POST['image_small'];
    if($titre&&$auteur&&$categorie&&$editeur&&$prix&&$page&&$langue&&$resume&&$image_full&&$image_small){
        mysql_query("SET NAMES 'utf8'");
        $insertLivre = "INSERT INTO livre VALUES ('', '$titre', '$auteur','$categorie', '$editeur',
                        '$resume', '$langue', '$page', '$prix', '$reduction', 'images/$image_full', 'images/$image_small',
                        CURDATE())";
        $reqInsertLivre = mysql_query($insertLivre);
        $ok_ajout_livre = "L'ajout a bien été effectué.";
    }else{
        $error_ajout_livre = "Remplissez tous les champs !";
    }
}

/*
 *  Traitement du formulaire de modification d'un livre
 */

if(isset($_POST['submit_modif_livre'])){
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];
    $editeur = $_POST['editeur'];
    $prix = $_POST['prix'];
    $langue = $_POST['langue'];
    $page = $_POST['page'];
    $reduction = $_POST['reduction'];
    $resume = $_POST['resume'];
    $image_full = $_POST['image_full'];
    $image_small = $_POST['image_small'];
    if($titre&&$auteur&&$categorie&&$editeur&&$prix&&$page&&$langue&&$resume&&$image_full&&$image_small){
        mysql_query("SET NAMES 'utf8'");
        $modif = "UPDATE livre SET titre ='".$titre."', id_auteur ='".$auteur."', categorie1 ='".$categorie."',
                 id_editeur ='".$editeur."', resume ='".$resume."', langue ='".$langue."', nbr_page ='".$page."',
                 prix ='".$prix."', reduction ='".$reduction."', couverture_full ='images/".$image_full."', couverture_small ='images/".$image_small."'
                 WHERE id ='".$id."'";
        $reqModif = mysql_query($modif);
        $ok_modif_livre = "Modification effectuée";
    }else{
        $error_modif_livre = "Remplissez tous les champs !";
    }
}

/*
 *  Traitement formulaire de modification d'un auteur
 */

if(isset($_POST['submit_modif_auteur'])){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nationalite = $_POST['nationalite'];
    $annee_naissance = $_POST['annee_naissance'];
    $annee_deces = $_POST['annee_deces'];
    if($nom&&$prenom&&$nationalite&&$annee_naissance){
        mysql_query("SET NAMES 'utf8'");
        $modif = "UPDATE auteur SET nom = '".$nom."', prenom = '".$prenom."', nationalite = '".$nationalite."',
                  annee_naissance = '".$annee_naissance."', annee_deces = '".$annee_deces."'
                  WHERE id='".$id."'";
        $req = mysql_query($modif);
        $ok_modif_auteur = "Modification(s) effectuée(s)";
    }else{
        $error_modif_auteur = "Veuillez remplir tous les champs !";
    }
}

/*
 *  Traitement formulaire de modification d'un éditeur
 */

if(isset($_POST['submit_modif_editeur'])){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $nationalite = $_POST['nationalite'];
    $date_creation = $_POST['date_creation'];
    if($nom&&$nationalite&&$date_creation){
        $modif = "UPDATE editeur SET nom = '".$nom."', nationalite = '".$nationalite."',
                  date_creation = '".$date_creation."'
                  WHERE id='".$id."'";
        $req = mysql_query($modif);
        $ok_modif_editeur = "Modification(s) effectuée(s)";
    }else{
        $error_modif_editeur = "Veuillez remplir tous les champs !";
    }
}

?>

<div class="center_content">

    <div class="left_content">

        <div class="title">
            <span class="title_icon">
                <img src="images/bullet1.gif" alt="" title="" />
            </span>
            Gestion des Oeuvres
        </div>

        <?php
        if(Auth::isLog()){
        ?>
        <div class="feat_prod_box">
            
            <!-- Formulaire d'ajout d'un livre -->
            
            <h3>Ajouter un Livre</h3> 
            <?php
            if(isset($ok_ajout_livre)){ echo $ok_ajout_livre; }
            if(isset($error_ajout_livre)){ echo $error_ajout_livre; }
            ?>
            <form action="gestion_oeuvre.php" method="POST" name="ajout_livre">
            <input type="text" name="titre" value="" placeholder="Titre du Livre"/>
            <select name="auteur">
                <?php 
                mysql_query("SET NAMES 'UTF-8'");
                $lstAut = "SELECT id, nom, prenom FROM auteur ORDER BY nom ASC";
                $reqAut = mysql_query($lstAut);
                while($row = mysql_fetch_array($reqAut)){
                ?>
                <option name="auteur" value="<?php echo $row['id'];?>"><?php echo $row['nom']." ".$row['prenom'];?></option>
                <?php
                }
                ?>
            </select>   
            <select name="categorie">
                <option value="Biographie">Biographie</option>
                <option value="Classique">Classique</option>
                <option value="Contemporain">Contemporain</option>
                <option value="Essai">Essai</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Historique">Historique</option>
                <option value="Horreur">Horreur</option>
                <option value="Jeunesse">Jeunesse</option>
                <option value="Poésie">Poésie</option>
                <option value="Policier/Thriller">Policier/Thriller</option>
                <option value="Nouvelle">Nouvelle</option>
                <option value="Science-Fiction">Science-Fiction</option>
                <option value="Théâtre">Théâtre</option>
            </select>
            <select name="editeur">
                <?php 
                mysql_query("SET NAMES 'UTF-8'");
                $lstEdit = "SELECT id, nom FROM editeur ORDER BY nom ASC";
                $reqEdit = mysql_query($lstEdit);
                while($row = mysql_fetch_array($reqEdit)){
                ?>
                <option value="<?php echo $row['id'];?>" name="editeur"><?php echo $row['nom'];?></option>
                <?php
                }
                ?>
            </select><br/>
            <input type="text" name="prix" value="" placeholder="Prix" size="3"/>€
            <input type="text" name="langue" value="" placeholder="Langue"/>
            <input type="text" name="page" value="" placeholder="Nombre de page"/>
            <strong>Réduction</strong> <input type="radio" name="reduction" value="1">Oui
            <input type="radio" name="reduction" value="0" checked="checked">Non<br/>
            <textarea rows="4" cols="70" name="resume" value="" placeholder="Résumé"/></textarea><br/>
            <table border="1px" style="border-style:dashed">
                <tr>
                    <th>Taille image 98*150 (nom.png)</th>
                    <th>Taille image 60*90 (nom.png)</th>
                </tr>
                <tr>
                    <td style="text-align:center"><input type="text" name="image_full" value=""/></td>
                    <td style="text-align:center"><input type="text" name="image_small" value=""/><br/></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;color:red">Le nom respect des tailles peut entraîner des problèmes d'affichage
                    sur le site</td>
                </tr>
            </table>
            <input type="submit" name="submit_ajout_livre" value="Ajouter"/>
            </form>
            
            <!-- Formulaire de modification d'un livre -->
            
            <h3>Modification d'un livre</h3>
            
            <?php
            if(isset($ok_modif_livre)){ echo $ok_modif_livre; }
            if(isset($error_modif_livre)){ echo $error_modif_livre; }
            ?>
            
            <form method="POST" name="modif_livre" action="gestion_oeuvre.php">
            <select name="choixLivre">
                <?php
                    $reqModL = "SELECT * FROM livre ORDER BY titre ASC";
                    $sqlModL = mysql_query($reqModL);
                    while($row = mysql_fetch_array($sqlModL)){
                    echo "<option value=".$row['id'].">".$row['titre']."</option>";
                    }
                ?>
            </select><br/>
            <input type="submit" name="choix_modifier_livre" value="Modifier"/>    
            </form>
            
            <?php
            if(isset($_POST['choix_modifier_livre'])){
                $id = $_POST['choixLivre'];
             ?>
            <h3>Livre à modifier</h3>
            <form method="post" action="gestion_oeuvre.php">
                <?php
                $choixLivre = "SELECT * FROM livre WHERE id=".$id;
                $reqChoixLivre = mysql_query($choixLivre);
                while($row = mysql_fetch_array($reqChoixLivre)){
                ?>
                <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                <input type="text" name="titre" value="<?php echo $row['titre'];?>"/>
            <select name="auteur">
                <?php
                $req = mysql_query("SELECT * FROM auteur");
                while($rows = mysql_fetch_array($req)){
                ?>
                <option value="<?php echo $rows['id'];?>"><?php echo $rows['nom']." ".$rows['prenom'];?></option>
                <?php
                }
                ?>
            </select>   
            <select name="categorie">
                <option value="Biographie">Biographie</option>
                <option value="Classique">Classique</option>
                <option value="Contemporain">Contemporain</option>
                <option value="Essai">Essai</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Historique">Historique</option>
                <option value="Horreur">Horreur</option>
                <option value="Jeunesse">Jeunesse</option>
                <option value="Poésie">Poésie</option>
                <option value="Policier/Thriller">Policier/Thriller</option>
                <option value="Nouvelle">Nouvelle</option>
                <option value="Science-Fiction">Science-Fiction</option>
                <option value="Théâtre">Théâtre</option>
            </select>
            <select name="editeur">
                <?php
                $req = mysql_query("SELECT * FROM editeur");
                while($rowss = mysql_fetch_array($req)){
                ?>
                <option value="<?php echo $rowss['id'];?>" name="editeur"><?php echo $rowss['nom'];?></option>
                <?php
                }
                ?>
            </select><br/>
            <input type="text" name="prix" value="<?php echo $row['prix'];?>" size="3"/>€
            <input type="text" name="langue" value="<?php echo $row['langue'];?>"/>
            <input type="text" name="page" value="<?php echo $row['nbr_page'];?>" size="3"/>pages<br/>
            <strong>Réduction</strong> 
            <input type="radio" name="reduction" value="1">Oui
            <input type="radio" name="reduction" value="0" checked="checked">Non<br/>
            <textarea rows="4" cols="70" name="resume" value=""/><?php echo $row['resume'];?></textarea><br/>
            <table border="1px" style="border-style:dashed">
                <tr>
                    <th>Taille image 98*150 (nom.png)</th>
                    <th>Taille image 60*90 (nom.png)</th>
                </tr>
                <tr>
                    <?php
                    $couverture_full = substr($row['couverture_full'], 7);
                    $couverture_small = substr($row['couverture_small'], 7);
                    ?>
                    <td style="text-align:center"><input type="text" name="image_full" value="<?php echo $couverture_full;?>"/></td>
                    <td style="text-align:center"><input type="text" name="image_small" value="<?php echo $couverture_small;?>"/><br/></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;color:red">Le nom respect des tailles peut entraîner des problèmes d'affichage
                    sur le site</td>
                </tr>
            </table>
            <input type="submit" name="submit_modif_livre" value="Modifier"/>
                <?php
                }
                ?>
            </form>
                <?php
            }
            ?>
            
            <!-- Formulaire d'ajout d'un auteur -->
            
            <h3>Ajout d'un Auteur</h3>
            
            <?php
            if(isset($fail_ajout_auteur)){echo '<div style="color:brown">'.$fail_ajout_auteur.'</div>';}
            if(isset($ok_ajout_auteur)){echo '<div style="color:brown">'.$ok_ajout_auteur.'</div>';}   
            ?>
            
            <form action="gestion_oeuvre.php" method="POST" name="ajout_auteur">
                <input type="text" value="" name="nom" placeholder="Nom"/>
                <input type="text" value="" name="prenom" placeholder="Pénom"/>
                <input type="text" value="" name="nationalite" placeholder="Nationalité"/><br/>
                <strong>Naissance :</strong><input type="text" value="" name="date_naissance" placeholder="A/A/A/A"/>
                <strong>Décès :</strong><input type="text" value="" name="date_deces" placeholder="A/A/A/A"/><br/>
                <input type="submit" name="submit_ajout_auteur" value="Ajouter"/>
            </form>
            
            <!-- Formulaire de modification d'un auteur -->
            
            <h3>Modification d'un Auteur</h3>
            <?php
            if(isset($ok_modif_auteur)){ echo $ok_modif_auteur; }
            if(isset($error_modif_auteur)){ echo $error_modif_auteur; }
            ?>
            <form method="POST" name="modif_auteur" action="gestion_oeuvre.php">
            <select name="choixAuteur">
                <?php
                    mysql_query("SET NAMES 'UTF-8'");
                    $reqModA = "SELECT * FROM auteur ORDER BY nom ASC";
                    $sqlModA = mysql_query($reqModA);
                    while($row = mysql_fetch_array($sqlModA)){
                    echo "<option value=".$row['id'].">".$row['nom']." ".$row['prenom']."</option>";
                    }
                ?>
            </select>
            <input type="submit" name="modif_auteur" value="Modifier"/>
            </form>
            
            <?php
                if(isset($_POST['modif_auteur'])){
                    $choix = $_POST['choixAuteur'];
            ?>
            <h3>Auteur à modifier</h3>
            <form method="post" action="gestion_oeuvre.php">
                <?php
                mysql_query("SET NAME 'utf8'");
                $req = mysql_query("SELECT * FROM auteur WHERE id=".$choix);
                while($row = mysql_fetch_array($req)){
                ?>
                <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                <input type="text" name="nom" value="<?php echo $row['nom'];?>"/>
                <input type="text" name="prenom" value="<?php echo $row['prenom'];?>"/>
                <input type="text" name="nationalite" value="<?php echo $row['nationalite'];?>"/><br/>
                Naissance :<input type="text" name="annee_naissance" value="<?php echo $row['annee_naissance'];?>"/>
                Décès :<input type="text" name="annee_deces" value="<?php echo $row['annee_deces'];?>"/><br/>
                <input type="submit" name="submit_modif_auteur" value="Modifier"/>
                <?php
                }
                ?>
            </form>
            <?php
                }
            ?>
            
            <!-- Formulaire d'ajout d'une maison d'édition -->
            
            <h3>Ajout d'une maison d'édition</h3>
            <?php
            if(isset($fail_ajout_editeur)){echo '<div style="color:brown">'.$fail_ajout_editeur.'</div>';}
            if(isset($ok_ajout_editeur)){echo '<div style="color:brown">'.$ok_ajout_editeur.'</div>';}   
            ?>
            <form action="gestion_oeuvre.php" method="POST" name="ajout_edition">
                <input type="text" value="" name="nom" placeholder="Nom"/>
                <input type="text" value="" name="nationalite" placeholder="Nationalité"/>
                <strong>Création :</strong><input type="text" value="" name="date_creation" placeholder="A/A/A/A"/><br/>
                <input type="submit" name="submit_ajout_edition" value="Ajouter"/>
            </form>
            
            <!-- Formulaire de modification d'une maison d'édition -->
            
            <h3>Modification d'une maison d'édition</h3>
            <?php
            if(isset($ok_modif_editeur)){ echo $ok_modif_editeur; }
            if(isset($error_modif_editeur)){ echo $error_modif_editeur; }
            ?>
            <form method="POST" action="gestion_oeuvre.php" name="modif_edition">
            <select name="choixEditeur">
                <?php
                    $req = "SELECT * FROM editeur ORDER BY nom ASC";
                    $sql = mysql_query($req);
                    while($row = mysql_fetch_array($sql)){
                        echo "<option value=".$row['id'].">".$row['nom']."</option>";
                    }
                ?>
            </select>
            <input type="submit" name="modif_editeur" value="Modifier"/>
            </form>
            
            <?php
                if(isset($_POST['modif_editeur'])){
                    $choix = $_POST['choixEditeur'];
            ?>
            <h3>Editeur à modifier</h3>
            <form method="post" action="gestion_oeuvre.php">
                <?php
                mysql_query("SET NAME 'utf8'");
                $req = mysql_query("SELECT * FROM editeur WHERE id=".$choix);
                while($row = mysql_fetch_array($req)){
                ?>
                <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                <input type="text" name="nom" value="<?php echo $row['nom'];?>"/>
                <input type="text" name="nationalite" value="<?php echo $row['nationalite'];?>"/>
                Création :<input type="text" name="date_creation" value="<?php echo $row['date_creation'];?>"/>
                <input type="submit" name="submit_modif_editeur" value="Modifier"/>
                <?php
                }
                ?>
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