<?php
/**
 * @brief	Objet Token
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new EToken();
 *          $u->Nickname = "Test";
 *          $u->ValidateTill = "2000-00-00 00:00:00";
 * 
 *          Exemple d'utilisation 2
 *          $u = new EToken("Test", "2000-00-00 00:00:00");
 */

 class EToken
 {
     /**
	 * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new EToken();
	 * @param InNickname	        Le nickname stocké dans le token
	 * @param InValidateTill		La date d'expiration. (Optionel) Défaut ""
     * @param InCode                Le code du token. (Optionel) Défaut ""
	  */
    public function __construct($InNickname, $InValidateTill = "", $InCode = "")
    {
        $this->Nickname = $InNickname;
        $this->ValidateTill = $InValidateTill;
        $this->Code = $InCode;
	}

    /**
     * @var string Le nickname du user associé à ce token
     */
    public $Nickname;

	/**
	 * @var string La date d'éxpiration du token
	 */
    public $ValidateTill;

    /**
     * @var string Le code du token
     */
    public $Code;
 }