<?php

class ContactFormulaire{

    public $nom;
    public $mail;
    public $sujet;
    public $message;
    
    // Style pour le input et le textarea
    

    public $webmaster = 'arent.jeremy@gmail.com';
    
    public function verif_null($var)
    { 
        if($var!="" and !empty($var)){
          return trim($var);
        }
        echo "</br>Vous n'avez pas rempli tous les champs !";
    }

    public function verif_mail($var) 
    {
        $code_syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#';   
        if(preg_match($code_syntaxe,$var)){ 
          return $var;
        }
        echo "E-mail non rempli ou non conforme";   
    }
    
    function envoi_mail(){ //fonction qui envoie le mail
	 
       $contenu_message = "Nom : ".$this->nom."\nMail : ".$this->mail."\nSujet : ".$this->sujet."\nMessage : ".$this->message;
	     $entete = "From: ".$this->nom." <".$this->mail."> \nContent-Type: text/html; charset=iso-8859-1";	 
       mail($this->webmaster,$this->sujet,$contenu_message,$entete);
	
	  }
    
    public function loadForm($data){
        extract($data);
        $this->nom      = trim(htmlentities($nom, ENT_QUOTES));
        $this->mail     = $this->verif_mail($mail);
        $this->sujet    = trim(htmlentities($sujet, ENT_QUOTES));
        $this->message  = trim(htmlentities($message, ENT_QUOTES));
        $test = $this->testForm();
        if(!empty($test)){
           $this->envoi_mail();
           echo "Message envoyé";
        };
    } 
    
    public function testForm(){
       if($this->verif_null($this->nom) and $this->verif_null($this->mail) and $this->verif_null($this->sujet) and $this->verif_null($this->message)){
          if($this->verif_mail($this->mail)){
              return 1;
          }
          return null; 
       }
       return null; 
    }

}

?>
    
