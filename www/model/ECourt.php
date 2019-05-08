<?php
/**
 * @brief	Objet Court
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
class ECourt {
	/**
	 * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new ECourt();
	 * @param InEmail		L'email de l'utilisateur. (Optionel) Defaut ""
	 * @param InNickname	Le nickname de l'utilisateur. (Optionel) Defaut ""
	 * @param InName	    Le nom complet de l'utilisateur. (Optionel) Defaut ""
	  */
    public function __construct($InName = "", $InDesc = "", $InDeleted = false)
    {
		$this->Name = $InName;
		$this->Desc = $InDesc;
        $this->Deleted = $InDeleted;
	}

	/**
	 * @var string Le nom de l'utilisateur
	 */
    public $Name;
    
    /**
     * @var string La description du court
     */
    public $Desc;

    /**
     * @var bool Est-ce que le court est fermé ou pas
     */
    public $Deleted;
}



?>