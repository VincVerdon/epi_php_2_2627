<?php
namespace controller;
use dao\ManufacturerDao;
use view\ManufacturerView;
use model\Manufacturer;
use view\DefaultView;


/**
 * Contrôleur pour la vue ManufacturerView
 * @author V. Verdon
 * @version 20231128
 *
 */
class ManufacturerCtrl extends Controller {
    
    public function __construct() {
        
        //parent constructor call
        parent::__construct();
        
        /**
         * On tente la transformation en int pour obtenir un id
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         */
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }
        
        if ($this->method=='GET' && $this->action=='') {
            $this->listAll();
        } elseif ($this->method=='GET' && $this->action=='add') {
            $this->addForm();
        } elseif ($this->method=='GET' && $this->action=='update') {
            $this->updateForm($id);
        } elseif ($this->method=='POST' && $this->action=='add') {
            $this->addProcessing();
        } elseif ($this->method=='POST' && $this->action=='update') {
            $this->updateProcessing();
        } else {
            $view = new DefaultView();
            $view->error404();
        }
        
    }
    
    
    /**
     * Affichage de la vue donnant la liste des manufacturers
     */
    public function listAll() {
        $dao = new ManufacturerDao();
        $manufacturers_list = $dao->readAll();
        $view = new ManufacturerView();
        $view->listAll($manufacturers_list);
    }
    
    
    /**
     * Affichage du formulaire de création d'un manufacturer
     */
    public function addForm() {
        $view = new ManufacturerView();
        $view->addForm();
    }
    
    
    /**
     * Traitement des données saisies dans le formulaire d'ajout d'un manufacturer
     * Génère l'écriture dans la base
     */
    public function addProcessing() {
        /**
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         * 
         */
        $name = null;
        $short_name = null;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['short_name'])) {
            $short_name = $_POST['short_name'];
        }
        
        $man = new Manufacturer($name, $short_name);
        $dao = new ManufacturerDao();
        $dao->create($man);
        header('Location: ?route=manufacturers');
    }
    
    
    /**
     * Affichage du formulaire d'update d'un manufacturer
     * @param int $id l'id du manufacturer à modifier
     */
    public function updateForm(int $id) {
        $dao = new ManufacturerDao();
        $man = $dao->read($id);
        if ($man != null) {
            $view = new ManufacturerView();
            $view->updateForm($man);
        } else {
            //no result found
            $view = new DefaultView();
            $view->error404();
        }
    }
    
    
    /**
     * Traitement des données saisies dans le formulaire d'update d'un manufacturer
     * Génère l'écriture dans la base
     */
    public function updateProcessing() {
        $man = new Manufacturer($_POST['name'], $_POST['short_name'], $_POST['id']);
        $dao = new ManufacturerDao();
        $dao->update($man);
        header('Location: ?route=manufacturers');
    }
    
}

