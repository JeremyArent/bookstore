
<div class="title">
    <span class="title_icon">
        <img src="images/bullet3.gif" alt="" title="" />
    </span>
    A propos de notre boutique
</div> 

<div class="about">
    <p>
        <img src="images/about.gif" alt="" title="" class="right" />
             Biblio 1.0 est une plateforme de vente en ligne fictive. Elle a été mise en place à des fins scolaires.
    </p>
</div>

<div class="right_box">
    
    <div class="title">
        <span class="title_icon">
            <img src="images/bullet4.gif" alt="" title="" />
        </span>Promotions
    </div> 
    <?php
    $req = "SELECT * FROM livre WHERE reduction = '1' LIMIT 3";
    $res = mysql_query($req);

    while ($resultat = mysql_fetch_array($res)) {
    echo '<div class="new_prod_box">
        <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'">'.$resultat['titre'].'</a>
            <div class="new_prod_bg">
                <span class="new_icon">
                    <img src="images/promo_icon.gif" alt="" title="" />
                </span>
                <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'">
                    <img src="'.$resultat['couverture_small'].'" width="60px" height="100px" alt="" title="" class="thumb" border="0" />
                </a>       
            </div>           
    </div>';
    }
    ?>         
</div>
             
<div class="right_box">
             
    <div class="title">
        <span class="title_icon">
            <img src="images/bullet5.gif" alt="" title="" />
        </span>
        Catégories
    </div> 
                
    <ul class="list">
                <?php
                    mysql_query("SET NAMES 'utf8'");
                    $req = "SELECT categorie1 FROM livre GROUP BY categorie1 ORDER BY categorie1 ASC";
                    $res = mysql_query($req);
                    while($result = mysql_fetch_assoc($res)){
                        echo '<li><a href="categorie.php?categorie1='.$result['categorie1'].'">'.$result['categorie1'].'</a></li>'; 
                    }
                ?>                                      
    </ul>
    
</div>

</div><!--end of right content-->