<?php
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
     * Get the value of numContinent
     */
    public function getNumContinent()
    {
        return $this->numContinent;
    }

    /**
     * Set the value of numContinent
     */
    public function setNumContinent($numContinent): self
    {
        $this->numContinent = $numContinent;

        return $this;
    }

	/**
	 * retourne l'ensemble des nationalite
	 *
	 * @return Nationalite[] tableau d'objet nationalite
	 */
	public static function findAll() :array
	{
		$req=MonPdo::getInstance()->prepare("Select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num");
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
		$req=MonPdo::getInstance()->prepare("insert into nationalite(libelle) values(:libelle)");
		$req->bindParam(':libelle', $nationalite->getLibelle());
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
		$req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle where num= :id");
		$req->bindParam(':id', $nationalite->getNum());
		$req->bindParam(':libelle', $nationalite->getLibelle());
		$nb=$req->execute();
		return $nb;

	}

	/**
	 * Permet de supprimer un nationalite 
	 *
	 * @param Nationalite $nationalite
	 * @return integer
	 */
	public static function delete(Nationalite $nationalite)  :int
	{
		$req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
		$req->bindParam(':id', $nationalite->getNum());
		 $nb=$req->execute();
		return $nb;
	}

    
}

?>