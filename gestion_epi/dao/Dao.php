<?php
namespace dao;


/**
 * Classe mère destinée à la création de classe DAO pour chaque objet du modèle
 * @author V. Verdon
 * @version 20231115
 */
abstract class Dao {
	
	protected $connect;
	
	public function __construct() {
		$this->connect = Connection::getConnection();
	}
	
}
?>