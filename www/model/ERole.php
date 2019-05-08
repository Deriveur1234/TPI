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
	 * @param InEmail		L'email de l'utilisateur. (Optionel) Defaut ""
	 * @param InNickname	Le nickname de l'utilisateur. (Optionel) Defaut ""
	  */
    public function __construct($InIdRole = null, $InName = "")
    {
        $this->IdRole = $InIdRole;
		$this->Name = $InName;
	}

    /**
     * @var int Id du Role
     */
    public $IdRole;

	/**
	 * @var string Le nom de l'utilisateur
	 */
    public $Name;
}



?>