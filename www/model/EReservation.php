<?php
/**
 * @brief	Objet Reservation
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new EResevation();
 *          $u->Court = new ECourt();
 *          $u->User = new EUser();
 *          $u->IsConfirmed = false;
 * 			$u->Date = "";
 * 
 *          Exemple d'utilisation 2
 *          $u = new EResevation(new ECourt(), new EUser(), false, "");
 */
class EResevation {
	/**
	 * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new EResevation();
	 * @param InCourt		Le terrain reservé. (Optionel) Defaut ""
	 * @param InUser	    L'utilisateur qui a reservé. (Optionel) Defaut ""
	 * @param InConfirmed   La confirmation de la reservation. (Optionel) Defaut false
     * @param InDate        La date et l'heure de la reservation. (Optionel) Defaut ""
	  */
    public function __construct($InCourt = "", $InUser = "", $InConfirmed = false, $InDate = "")
    {
		$this->Court = $InCourt;
		$this->User = $InUser;
        $this->IsConfirmed = $InConfirmed;
        $this->Date = $InDate;
	}
	/**
	 * @var ECourt Le terrain qui a été reservé
     **/
    public $Court;
    
	/**
	 * @var EUser L'utilisateur qui a reservé
	 */
    public $User;
    
    /**
     * @var date La date et l'heure de la reservation 
     */
    public $Date;
}



?>