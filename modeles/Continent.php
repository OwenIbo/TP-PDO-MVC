<?php
class Continent {
	/**
	 * numero du continent
	 *
	 * @var int 
	 */
	private $num;
	
	/**
	 * libelle du continent 
	 *
	 * @var int 
	 */
	private $libelle;


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
	 * retourne l'ensemble des continents
	 *
	 * @return Continent[] tableau d'objet continent
	 */
	public static function findAll() :array
	{
		$req=MonPdo::getInstance()->prepare("Select * from continent");
		$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Continent');
		$req->execute();
		$lesResultats=$req->fetchAll();
		return $lesResultats;

	}

	/**
	 * Trouve un continent par son num
	 *
	 * @param integer $id numéro du continent 
	 * @return Continent objet continent trouvé 
	 */
	public static function findById(int $id) :Continent 
	{
		$req=MonPdo::getInstance()->prepare("Select * from continent where num= :id");
		$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Continent');
		$req->bindParam(':id', $id);
		$req->execute();
		$leResultat=$req->fetch();
		return $leResultat;
	}

	/**
	 * Perment d'ajouter un continent 
	 *
	 * @param Continent $continent continent a ajouter 
	 * @return integer resultat(1 si l'operation reussi, 0 sinon )
	 */
	public static function add(Continent $continent) :int
	{
		$req=MonPdo::getInstance()->prepare("insert into continent(libelle) values(:libelle)");
		$libelle=$continent->getLibelle();
		$req->bindParam(':libelle', $libelle);
		 $nb=$req->execute();
		return $nb;
	}

	/**
	 * Permet de modifier un continent 
	 *
	 * @param Continent $continent continent a modifier
	 * @return integer resultat(1 si l'operation reussi, 0 sinon )
	 */
	public static function update(Continent $continent) :int
	{
		$req=MonPdo::getInstance()->prepare("update continent set libelle= :libelle where num= :id");
		$num= $continent->getNum();
		$libelle=$continent->getLibelle();
		$req->bindParam(':id', $num);
		$req->bindParam(':libelle', $libelle);
		$nb=$req->execute();
		return $nb;

	}

	/**
	 * Permet de supprimer un continent 
	 *
	 * @param Continent $continent
	 * @return integer
	 */
	public static function delete(Continent $continent)  :int
	{
		$req=MonPdo::getInstance()->prepare("delete from continent where num= :id");
		$num=$continent->getNum();
		$req->bindParam(':id', $num);
		$nb=$req->execute();
		return $nb;
	}

	/**
	 * Set numero du continent
	 */
	public function setNum(int $num): self
	{
		$this->num = $num;

		return $this;
	}
}

?>