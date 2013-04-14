<?php
include('../connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');

$req = "SELECT * FROM contact";
$sql = mysql_query($req);

if(isset($_GET['del'])){
    $reqsupp = "DELETE FROM contact WHERE id=".$_GET['del'];
    $sqlsupp = mysql_query($reqsupp);
    header('Location:gestion_contact.php');
}

?>

<div class="center_content">
    <div class="left_content">

        <div class="title">
            <span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>
            Contact
        </div>
        
        <?php
        if(Auth::isLog()){
        ?>
        <div class="feat_prod_box">
            <form method="POST" action="gestion_contact.php">
                <table>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Courriel</th>
                        <th>Sujet</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    while($row = mysql_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><input type="hidden" name="id" value="<?php echo $row['id'];?>"/></td>
                        <td><input type="text" name="nom" value="<?php echo $row['nom'];?>"/></td>
                        <td><input type="text" name="courriel" value="<?php echo $row['courriel'];?>"/></td>
                        <td><input type="text" name="sujet" value="<?php echo $row['sujet'];?>"/></td>
                        <td><textarea type="text" name="message" value=""><?php echo $row['message'];?></textarea></td>
                        <td style="text-align: center"><a href="gestion_contact.php?del=<?php echo $row['id'];?>">
                        <img src="images/close.gif"/></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
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
