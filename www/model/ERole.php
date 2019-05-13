<?php
/**
 * @brief	Objet Role
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new ERole();
 *          $u->IdRole = 1;
 *          $u->Name = "Admin";
 * 
 *          Exemple d'utilisation 2
 *          $u = new ERole(1, "Admin");
 */
class ERole {
	/**
	 * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new ERole();
	 * @param InCodeRole	Le code du rôle
	 * @param InName		Le nom du rôle. (Optionel) Defaut ""
	  */
    public function __construct($InCodeRole, $InName = "")
    {
        $this->CodeRole = $InCodeRole;
		$this->Label = $InName;
	}

    /**
     * @var int code du Role
     */
    public $CodeRole;

	/**
	 * @var string Le nom du role
	 */
    public $Label;
}



?>