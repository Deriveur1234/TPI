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
 * @param InEmail		L'email du Court. (Optionel) Defaut ""
 * @param InDesc	  La description du court. (Optionel) Defaut ""
 * @param InDeleted Est-ce que le court est fermé ou pas. (Optionel) Defaut false
  */
  public function __construct($InId = "",$InName = "", $InDesc = "", $InDeleted = false)
  {
    $this->Id = $InId;
    $this->Name = $InName;
    $this->Desc = $InDesc;
    $this->Deleted = $InDeleted;
  }
  
  /**
   * @var int L'id du court
   */
  public $Id;

	/**
	 * @var string Le nom du court
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