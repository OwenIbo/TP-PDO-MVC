<?php

use PSpell\Config;

class Nationalite {
	/**
	 * numero du Nationalite
	 *
	 * @var int 
	 */
	private $num;
	
	/**
	 * libelle du Nationalite 
	 *
	 * @var int 
	 */
	private $libelle;

    /**
     * num continent (clé etrangère) relié a num du continent 
     *
     * @var int
     */
    private $numContinent;

	/**
	 * Get the value of num
	 */
	public function getNum()
	{
		return $this->num;
	}

	/**
	 * lit le libelle
	 *
	 * @return string
	 */
	public function getLibelle() : string 
	{
		return $this->libelle;
	}

	public function setNum(int $num): self
	{
		$this->num = $num;
		
		return $this;
	}

	/**
	 * ecrit dans le libelle
	 *
	 * @param string $libelle
	 * @return self
	 */
	public function setLibelle(string $libelle): self
	{
		$this->libelle = $libelle;

		return $this;
	}

	/**
	 * renvoie l'objet continent associé
	 *
	 * @return Continent
	 */
    public function getNumContinent() : Continent
    {
        return Continent::findById($this->numContinent);
    }

	/**
	 * ecrit le num Continent
	 *
	 * @param Continent $continent
	 * @return self
	 */
    public function setNumContinent(Continent $continent): self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }

	/**
	 * retourne l'ensemble des nationalite
	 *
	 * @return Nationalite[] tableau d'objet nationalite
	 */
	public static function findAll(?string $libelle="", ?string $continent="" ) :array
	{
		$texteReq="Select n.num as 'numero', n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num";
		if( $libelle != "") { 
			$texteReq .=" and n.libelle like '%" . $libelle . "%'";
		}
		if( $continent != "Tous") { 
			$texteReq.= " and c.num =" .$continent;
		}
		$texteReq .=" order by n.libelle";
		$req=MonPdo::getInstance()->prepare($texteReq);
		$req->setFetchMode(PDO::FETCH_OBJ);
		$req->execute();
		$lesResultats=$req->fetchAll();
		return $lesResultats;

	}

	/**
	 * Trouve une nationalite par son num
	 *
	 * @param integer $id numéro du nationalite 
	 * @return Nationalite objet nationalite trouvé 
	 */
	public static function findById(int $id) :Nationalite 
	{
		$req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id");
		$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Nationalite');
		$req->bindParam(':id', $id);
		$req->execute();
		$leResultat=$req->fetch();
		return $leResultat;
	}

	/**
	 * Perment d'ajouter un nationalite 
	 *
	 * @param Nationalite $nationalite nationalite a ajouter 
	 * @return integer resultat(1 si l'operation reussi, 0 sinon )
	 */
	public static function add(Nationalite $nationalite) :int
	{
		$req=MonPdo::getInstance()->prepare("insert into nationalite (libelle,numContinent) values(:libelle, :numContinent)");
		$libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getNumContinent()->getNum();
        $req->bindParam(':libelle',$libelle);
        $req->bindParam(':numContinent',$numContinent);
        $nb=$req->execute();
        return $nb;
	}

	/**
	 * Permet de modifier un nationalite 
	 *
	 * @param Nationalite $nationalite nationalite a modifier
	 * @return integer resultat(1 si l'operation reussi, 0 sinon )
	 */
	public static function update(Nationalite $nationalite) :int
	{
		$req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
		$libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getNumContinent();
        $num=$nationalite->getNum();
        $req->bindParam(':numContinent',$numContinent->getNum());
        $req->bindParam(':libelle',$libelle);
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb; 

	}

	/**
	 * Permet de supprimer un nationalite 
	 *
	 * @param Nationalite $nationalite
	 * @return integer
	 */
	public static function Delete(Nationalite $nationalite)  :int
	{
		$req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
		$num=$nationalite->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb; 
	}

    
}

?>