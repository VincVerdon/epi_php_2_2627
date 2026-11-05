<?php
namespace api;
use dao\TypeDao;
use model\Type;

/**
 * API REST proposant l'accès aux types de matériel
 * @version 20261015
 */
class TypeApi extends Api {
    
    /**
     * Constructeur classe TypeApi
     * Sert de routeur pour les différentes actions
     * En fonction de la méthode et des options
     */
    public function __construct() {
        
        //Appel constructeur classe mère Api
        parent::__construct();
        
        /**
         * l'option doit être un id. On tente la transformation
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         */
        $id = (int) $this->option;
        
        //we decide what to do with the request
        if ($this->method=='GET' && $this->option=='') {
            $this->listAll();
        } elseif ($this->method=='GET' && $id!=0) {
            $this->listOne($id);
        } elseif ($this->method=='POST') {
            $this->addOne();
        } elseif ($this->method=='PUT') {
            $this->updateOne($id);
        } elseif ($this->method=='DELETE') {
            $this->deleteOne($id);
        } else {
            new ErrorApi();
        }
    }
    
    /**
     * Fournit la liste des types
     */
    public function listAll() {
        $dao = new TypeDao();
        $types_list = $dao->readAll();
        $json = json_encode($types_list);
        header("Content-Type: application/json");
        echo $json;
    }
    
    /**
     * Fournit un type en fonction de son id
     * @param int $id du type
     */
    public function listOne(int $id) {
        $dao = new TypeDao();
        $type = $dao->read($id);
        if ($type != null) {
            $json = json_encode($type);
            header("Content-Type: application/json");
            echo $json;
        } else {
            //no result found
            new ErrorApi();
        }
    }
    
    /**
     * Traite les données reçues pour créer un nouveau type
     */
    public function addOne() {
        $type = new Type($this->data['name']);
        $dao = new TypeDao();
        $dao->create($type);
    }
    
    /**
     * Supprime un type en fonction de son id reçu
     * @param int $id du type
     */
    public function deleteOne(int $id) {
        $dao = new TypeDao();
        $result = $dao->delete($id);
    }
    
    /**
     * Update un type en fonction de son id reçu
     * @param int $id du type
     */
    public function updateOne(int $id) {
        $dao = new TypeDao();
        $type = new Type($this->data['name'], $id);
        $type = $dao->update($type);
    }
    
}
