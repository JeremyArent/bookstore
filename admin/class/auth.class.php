<?php
require_once '../connexion/PDO.php';
?>

<?php
class Auth{
    
    static function isLog(){
        global $cnx;
        if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['pseudo']) && isset($_SESSION['Auth']['password'])){
            $q = array('pseudo'=>$_SESSION['Auth']['pseudo'],'password'=>$_SESSION['Auth']['password']);
            $sql = "SELECT * FROM admin WHERE pseudo= :pseudo AND password= :password";
            $req = $cnx->prepare($sql);
            $req->execute($q); 
            $count = $req->rowCount($sql);
                if($count == 1){
                    return true; 
                }else{
                    return false;
                }
        }else{
            return false;
        }
    }
}
?>