<?php
namespace dao;
use \PDO;
use model\Manufacturer;


/**
 * Classe DAO pour persistance des objets Manufacturer
 * @author V. Verdon
 * @version 20231115
 */
class ManufacturerDao extends Dao {
	
    
    /**
     * Retourne la liste de tous les manufacturers
     * @return \model\Manufacturer[]
     */
    public function readAll() {
        $liste = array();
        $req='SELECT id, name, short_name FROM manufacturer';
        $res = $this->connect->query($req);
        while($ligne=$res->fetch(PDO::FETCH_ASSOC)) {
            $liste[]=new Manufacturer($ligne['name'], $ligne['short_name'], $ligne['id']);
        }
        return $liste;
    }
    
    
    /**
     * Récupère un manufacturer en fonction de son id
     * @param int $id du manufacturer
     * @return NULL|\model\Manufacturer
     */
    public function read(int $id) {
		$manufac = null;
		$req ='SELECT id, name, short_name';
		$req .= ' FROM manufacturer';
		$req .= ' WHERE id = :id';
		
		$statement = $this->connect->prepare($req);
		$statement->execute(array(':id' => $id));
		if ($ligne = $statement->fetch(PDO::FETCH_ASSOC)) {
		    $manufac = new Manufacturer($ligne['name'], $ligne['short_name'], $ligne['id']);
		}
		return $manufac;
	}
	
	
	/**
	 * Persistance d'un nouveau manufacturer
	 * @param Manufacturer $m à enregistrer
	 */
	public function create(Manufacturer $m) {
		$req = 'INSERT INTO manufacturer (name, short_name) ';
		$req .= 'VALUES (:name, :short)';
		$statement = $this->connect->prepare($req);
		$statement->bindValue(':name', $m->getName());
		$statement->bindValue(':short', $m->getShortName());
		$statement->execute();
	}
	
	
	/**
	 * Update manufacturer
	 * @param Manufacturer $m à enregistrer
	 */
	public function update(Manufacturer $m) {
	    $req = 'UPDATE manufacturer SET name=:name, short_name=:short ';
	    $req .= 'WHERE id = :id';
	    $statement = $this->connect->prepare($req);
	    $statement->bindValue(':name', $m->getName());
	    $statement->bindValue(':short', $m->getShortName());
	    $statement->bindValue(':id', $m->getId());
	    $statement->execute();
	}
	
	
	/**
	 * Suppression d'un manufacturer en fonction de son id
	 * @param int $id du manufacturer
	 */
	public function delete(int $id) {
		$req='DELETE FROM manufacturer WHERE id = :id';
		$statement = $this->connect->prepare($req);
		$statement->bindValue(':id', $id);
		$statement->execute();
	}
	
}
?>