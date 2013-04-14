<div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
            <div class="left_footer"><a href="index.php"><img src="images/footer_logo.gif" alt="" title="" /></a><br /></div>
            <div class="right_footer">
                
                
            <?php if(Auth::isLog()){?>    
            <a href="index.php">Accueil</a>
            <a href="https://docs.google.com/spreadsheet/ccc?key=0AsWXzX9-as2YdHpROV9iUnlJS0doVkxfUjI4REhHRXc&usp=sharing" target="_blank">Gestion des Incidents</a>
            <a href="logout.php">Se déconnecter</a>
            <?php }else{ ?>
            
 
            <?php } ?>
            </div>
        
       
       </div>
    

</div>

</body>
</html>
