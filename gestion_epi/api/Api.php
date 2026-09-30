<?php
namespace api;

/**
 * Classe parent pour construire les API REST serveur
 * @author V. Verdon
 * @version 20231115
 * @note Créer une classe enfant pour chaque objet à fournir par l'API
 */
class Api {
    
    protected string $method;
    protected string $option;
    protected array $data;
    
    public function __construct() {
        /**
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         */
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->option = '';
        if (isset($_GET['option'])) {
            $this->option = $_GET['option'];
        }
        $this->data = array();
        if ($this->method=='POST' || $this->method=='PUT') {
            $data = file_get_contents('php://input');
            $this->data = json_decode($data, true);
        }
        //Nothing to catch for DELETE method !
    }
    
}

