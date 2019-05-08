<?php
/**
 * @brief	Objet User
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new EUser();
 *          $u->Email = "loic@burnand.com";
 *          $u->Nickname = "Test";
 *          $u->Name = "BURNAND";
 * 					$u->FirstName = "Loïc";
 * 					$u->Phone = "0767756644";
 * 					$u->Role = new ERole();
 * 					$u->IsConfirmed = false;
 * 
 *          Exemple d'utilisation 2
 *          $u = new EUser("loic@burnand.com", "Test", "BURNAND", "Loïc", "0767756644", new ERole(), false);
 */
class EUser {
	/**
	* @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new EUser();
	* @param InEmail		L'email de l'utilisateur. (Optionel) Defaut ""
	* @param InNickname	Le nickname de l'utilisateur. (Optionel) Defaut ""
	* @param InName	    Le nom de l'utilisateur. (Optionel) Defaut ""
	* @param InFirstName   Le prénom de l'utilisateur. (Optionel) Defaut ""
	* @param InPhone       Le numéro de téléphone de l'utilisateur. (Optionel) Defaut ""
	* @param InRole			Le role de l'utilisateur. (Optionel) Defaut null
	* @param InCofirmation	Est-ce que l'utilisateur est confirmé. (Optionel) Defaut false
	 */
	public function __construct($InEmail = "", $InNickname = "", $InName = "", $InFirstName = "", $InPhone = "", $InRole = null, $InCofirmation = false)
	{
		$this->Email = $InEmail;
		$this->Nickname = $InNickname;
		$this->Name = $InName;
		$this->FirstName = $InFirstName;
		$this->Phone = $InPhone;
		$this->Role = $InRole;
		$this->IsConfirmed = $InCofirmation;
	}
	/**
	 * @var string L'email de l'utilisateur
	 */
	public $Email;
	/**
	 * @var string Le nickname de l'utilisateur
	 */
	public $Nickname;
	/**
	 * @var string Le nom de l'utilisateur
	 */
    public $Name;
    
    /**
     * @var string Le prénom de l'utilisateur
     */
    public $FirstName;

    /**
	 * @var string le numéro de téléphone 
	 */
	public $Phone;
		
	/**
	 * @var ERole le role de l'utilisateur
	 */
	public $Role;

	/**
	 * @var bool Confirmation de l'inscription de l'utilisateur
	 */
	public $IsConfirmed;
}



?>