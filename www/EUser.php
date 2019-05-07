<?php
/**
 * @brief	Objet User
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new EUser();
 *          $u->Email = "dominique@aigroz.com";
 *          $u->Nickname = "Iraque";
 *          $u->Name = "Dominique AIGROZ";
 * 
 *          Exemple d'utilisation 2
 *          $u = new EUser("dominique@aigroz.com", "Iraque", "Dominique AIGROZ");
 */
class EUser {
	/**
	 * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new EUser();
	 * @param InEmail		L'email de l'utilisateur. (Optionel) Defaut ""
	 * @param InNickname	Le nickname de l'utilisateur. (Optionel) Defaut ""
	 * @param InName	    Le nom complet de l'utilisateur. (Optionel) Defaut ""
	  */
    public function __construct($InEmail = "", $InNickname = "", $InName = "")
    {
		$this->Email = $InEmail;
		$this->Nickname = $InNickname;
        $this->Name = $InName;
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
	 * @var string Le nom complet de l'utilisateur
	 */
	public $Name;
}



?>