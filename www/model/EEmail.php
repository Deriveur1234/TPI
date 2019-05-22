<?php
/**
 * @brief	Objet Email
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new EEmail();
 *          $u->Subject = "Sujet de l'email";
 *          $u->From = "tpiSquash@gmail.com";
 *          $u->To = "test@example.com";
 *          $u->Body = "<p>Corps du message</p>"
 * 
 *          Exemple d'utilisation 2
 *          $u = new ECourt("test@example.com", "Sujet de l'email", "<p>Corps du message</p>", "tpiSquash@gmail.com");
 */
class EEmail {
	/**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new EEmail();
     * @param InSubject		Le sujet de l'email. (Optionel) Defaut ""
     * @param InFrom	    L'email de l'envoyeur. (Optionel) Defaut ""
     * @param InTo          Le destinataire du mail
     * @param InBody        Le corps du message. (Optionel) Defaut ""
      */
    public function __construct($InTo, $InSubject = "",  $InBody = "", $InFrom = "")
    {
        $this->Subject = $InSubject;
        $this->From = $InFrom;
        $this->To = $InTo;
        $this->Body = $InBody;
    }

    /**
     * @var string Le sujet de l'email
     */
    public $Subject;

    /**
     * @var string L'email de l'envoyeur
     */
    public $From;
  
    /**
     * @var string L'email du destinataire
     */
    public $To;

    /**
     * @var string Le corps de l'email
     */
    public $Body;
}
?>