<?php
/**
 * @brief	Objet EPreferences
 * @remark  Cet objet est utilisé comme conteneur
 * 
 *          Exemple d'utilisation 1
 *          $u = new EPreferences();
 *          $u->Updated = new DateTime('2011-01-01T15:03');
 *          $u->BeginTime = new DateTime('2019-01-01T15:00');
 *          $u->EndTime = new DateTime('2019-01-01T16:00');
 *          $u->NbReservation = 2;
 * 
 */
class EPreference {
	/**
	 * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new EPreferences();
	 * @param InUpdated		    L'Id du rôle
	 * @param InBeginTime		Le nom du rôle. (Optionel) Defaut ""
     * 
     ********************** A FAIRE ********************************
	  */
    public function __construct($InBeginTime=null, $InEndTime=null, $InNbReservation=null)
    {
        $this->BeginTime = $InBeginTime;
        $this->EndTime = $InEndTime;
        $this->NbReservation = $InNbReservation;
	}

    /**
     * @var DateTime Date et heure de la dernière update
     */
    public $Updated;

	/**
	 * @var DateTime L'heure d'ouverture des courts 
	 */
    public $BeginTime;

    /**
     * @var DateTime l'heure de fermeture des courts
     */
    public $EndTime;

    /**
     * @var int Le nombre de réservation que l'utilisateur peut faire par jour
     */
    public $NbReservation;
}

