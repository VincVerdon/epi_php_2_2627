<?php
namespace dao;
use PDO;


/**
 * Classe gérant la connexion au SGBD
 * Utilisée par la classe mère DAO
 * @author V. Verdon
 * @version 20231115
 */
class Connection {
	
	//l'attribut statique qui contiendra l'unique objet PDO
	private static  $pdo=null;
	
	private function __construct() {
		
		//on charge la conf ici car on ne la charge que si l'instance n'est pas créée
		require('../config/db.conf');
		
		//self appelle la classe. Peut être remplacé par le nom de la classe, ici Connexion
		Connection::$pdo = new PDO(SGBD.':host='.HOST.';dbname='.BASE, USER, PASSWD);
		
	}
	
	/**
	 * Fournit l'objet PDO de connexion
	 * @return PDO connecteur PDO
	 */
	static function getConnection() {
		if (is_null(Connection::$pdo)) {
			new Connection();
		}
		return Connection::$pdo;
	}
	
}



?>