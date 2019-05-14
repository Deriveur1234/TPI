<?php
/**
 * @brief	Objet Email
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new ECourt();
 *          $u->Name = "Court Test";
 *          $u->Desc = "Ce terrain est un terrain reserver au entrainement";
 *          $u->Deleted = true;
 * 
 *          Exemple d'utilisation 2
 *          $u = new ECourt("Court Test", "Ce terrain est un terrain reserver au entrainement", true);
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
     * @var string L'email du destinataire'
     */
    public $To;

    /**
     * @var strig Le corps de l'email
     */
    public $Body;
}


?>