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
        $req = "INSERT INTO editeur(id, nom, nationalite, date_creation) 
                VALUES ('', '$nom', '$nationalite', '$creation')";
        $sql = mysql_query($req);
        $ok_ajout_editeur = "L'ajout s'est bien effectué.";
    }else{
        $fail_ajout_editeur = "Vous n'avez pas rempli tous les champs !";
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
            <form action="gestion_oeuvre.php" method="POST" name="ajout_livre">
            <input type="text" name="titre" value="" placeholder="Titre du Livre"/>
            <select>
                <?php 
                mysql_query("SET NAMES 'UTF-8'");
                $sql = "SELECT nom, prenom FROM auteur ORDER BY nom ASC";
                $req = mysql_query($sql);
                while($row = mysql_fetch_array($req)){
                ?>
                <option name="auteur" value=""><?php echo $row['nom']." ".$row['prenom'];?></option>
                <?php
                }
                ?>
            </select>
            <input type="text" name="categorie" value="" placeholder="Categorie"/>
            <select>
                <?php 
                mysql_query("SET NAMES 'UTF-8'");
                $sql = "SELECT nom FROM editeur ORDER BY nom ASC";
                $req = mysql_query($sql);
                while($row = mysql_fetch_array($req)){
                ?>
                <option value="" name="editeur"><?php echo $row['nom'];?></option>
                <?php
                }
                ?>
            </select><br/>
            <input type="text" name="prix" value="" placeholder="Prix" size="3"/>€
            <input type="text" name="langue" value="" placeholder="Langue"/>
            <input type="text" name="page" value="" placeholder="Nombre de page"/>
            <strong>Réduction</strong> <input type="radio" name="reduction" value="oui">Oui
            <input type="radio" name="reduction" value="non">Non<br/>
            <textarea rows="4" cols="50" name="resume" value="" placeholder="Résumé"/></textarea><br/>
            <input type="submit" name="submit_ajout_livre" value="Ajouter"/>
            </form>
            
            <!-- Formulaire de modification d'un livre -->
            
            <h3>Modification d'un livre</h3>
            <form method="POST" name="modif_livre" action="gestion_oeuvre.php">
            <select>
                <?php
                    $req = "SELECT * FROM livre ORDER BY titre ASC";
                    $sql = mysql_query($req);
                    while($row = mysql_fetch_array($sql)){
                ?>
                <option>
                <?php    
                    echo $row['titre'];
                ?>
                </option>
                <?php
                    }
                ?>
            </select>
            </form>
            
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
                <strong>Naissance :</strong><input type="date" value="" name="date_naissance"/>
                <strong>Décès :</strong><input type="date" value="" name="date_deces"/><br/>
                <input type="submit" name="submit_ajout_auteur" value="Ajouter"/>
            </form>
            
            <!-- Formulaire de modification d'un auteur -->
            
            <h3>Modification d'un Auteur</h3>
            <form method="POST" name="modif_auteur" action="gestion_oeuvre.php">
            <select>
                <?php
                    $req = "SELECT * FROM auteur ORDER BY nom ASC";
                    $sql = mysql_query($req);
                    while($row = mysql_fetch_array($sql)){
                ?>
                <option>
                <?php    
                    echo $row['prenom']." ".$row['nom'];
                ?>
                </option>
                <?php
                    }
                ?>
            </select>
            </form>
            
            <!-- Formulaire d'ajout d'une maison d'édition -->
            
            <h3>Ajout d'une maison d'édition</h3>
            <?php
            if(isset($fail_ajout_editeur)){echo '<div style="color:brown">'.$fail_ajout_editeur.'</div>';}
            if(isset($ok_ajout_editeur)){echo '<div style="color:brown">'.$ok_ajout_editeur.'</div>';}   
            ?>
            <form action="gestion_oeuvre.php" method="POST" name="ajout_edition">
                <input type="text" value="" name="nom" placeholder="Nom"/>
                <input type="text" value="" name="nationalite" placeholder="Nationalité"/>
                <strong>Création :</strong><input type="date" value="" name="creation"/><br/>
                <input type="submit" name="submit_ajout_edition" value="Ajouter"/>
            </form>
            
            <!-- Formulaire de modification d'une maison d'édition -->
            
            <h3>Modification d'une maison d'édition</h3>
            <form method="POST" action="gestion_oeuvre.php" name="modif_edition">
            <select>
                <?php
                    $req = "SELECT * FROM editeur ORDER BY nom ASC";
                    $sql = mysql_query($req);
                    while($row = mysql_fetch_array($sql)){
                ?>
                <option>
                <?php    
                    echo $row['nom'];
                ?>
                </option>
                <?php
                    }
                ?>
            </select>
            </form>
            
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