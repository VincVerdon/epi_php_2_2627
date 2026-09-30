<?php
namespace api;
use dao\ManufacturerDao;
use model\Manufacturer;

/**
 * API REST proposant l'accès aux manufacturers
 * @author V. Verdon
 * @version 20231115
 */
class ManufacturerApi extends Api {
    
    /**
     * Constructeur classe ManufacturerApi
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
     * Fournit la liste des manufacturers
     */
    public function listAll() {
        $dao = new ManufacturerDao();
        $manufacturers_list = $dao->readAll();
        $json = json_encode($manufacturers_list);
        header("Content-Type: application/json");
        echo $json;
    }
    
    /**
     * Fournit un manufacturers en fonction de son id
     * @param int $id du manufacturer
     */
    public function listOne(int $id) {
        $dao = new ManufacturerDao();
        $manufacturer = $dao->read($id);
        if ($manufacturer != null) {
            $json = json_encode($manufacturer);
            header("Content-Type: application/json");
            echo $json;
        } else {
            //no result found
            new ErrorApi();
        }
    }
    
    
    /**
     * Traite les données reçues pour créer un nouveau manufacturer
     */
    public function addOne() {
        $man = new Manufacturer($this->data['name'], $this->data['short_name']);
        $dao = new ManufacturerDao();
        $dao->create($man);
    }
    
    /**
     * Supprime un manufacturer en fonction de son id reçu
     * @param int $id du manufacturer
     */
    public function deleteOne(int $id) {
        $dao = new ManufacturerDao();
        $result = $dao->delete($id);
    }
    
    /**
     * Update un manufacturer en fonction de son id reçu
     * @param int $id du manufacturer
     */
    public function updateOne(int $id) {
        $dao = new ManufacturerDao();
        $man = new Manufacturer($this->data['name'], $this->data['short_name'], $id);
        $man = $dao->update($man);
    }
    
}
