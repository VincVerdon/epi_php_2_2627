<?php
namespace dao;
use \PDO;
use model\Type;


/**
 * Classe DAO pour persistance des objets Type
 * @version 20261016
 */
class TypeDao extends Dao {
    
    
    /**
     * Retourne la liste de tous les types
     * @return \model\Type[]
     */
    public function readAll() {
        $liste = array();
        $req='SELECT id, name FROM type';
        $res = $this->connect->query($req);
        while($ligne=$res->fetch(PDO::FETCH_ASSOC)) {
            $liste[]=new Type($ligne['name'], $ligne['id']);
        }
        return $liste;
    }
    
    
    /**
     * Récupère un type en fonction de son id
     * @param int $id du type
     * @return NULL|\model\Type
     */
    public function read(int $id) {
        $type = null;
        $req ='SELECT id, name';
        $req .= ' FROM type';
        $req .= ' WHERE id = :id';
        
        $statement = $this->connect->prepare($req);
        $statement->execute(array(':id' => $id));
        if ($ligne = $statement->fetch(PDO::FETCH_ASSOC)) {
            $type = new Type($ligne['name'], $ligne['id']);
        }
        return $type;
    }
    
    
    /**
     * Persistance d'un nouveau type
     * @param Type $t à enregistrer
     */
    public function create(Type $t) {
        $req = 'INSERT INTO type (name) ';
        $req .= 'VALUES (:name)';
        $statement = $this->connect->prepare($req);
        $statement->bindValue(':name', $t->getName());
        $statement->execute();
    }
    
    
    /**
     * Update type
     * @param Type $t à enregistrer
     */
    public function update(Type $t) {
        $req = 'UPDATE type SET name=:name ';
        $req .= 'WHERE id = :id';
        $statement = $this->connect->prepare($req);
        $statement->bindValue(':name', $t->getName());
        $statement->bindValue(':id', $t->getId());
        $statement->execute();
    }
    
    
    /**
     * Suppression d'un type en fonction de son id
     * @param int $id du type
     */
    public function delete(int $id) {
        $req='DELETE FROM type WHERE id = :id';
        $statement = $this->connect->prepare($req);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
    
}
?>
