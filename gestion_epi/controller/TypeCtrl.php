<?php
namespace controller;
use dao\TypeDao;
use view\TypeView;
use model\Type;
use view\DefaultView;


/**
 * Contrôleur pour la vue TypeView
 * @version 20261015
 *
 */
class TypeCtrl extends Controller {
    
    public function __construct() {
        
        //parent constructor call
        parent::__construct();
        
        /**
         * On tente la transformation en int pour obtenir un id
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         */
        $id = 0;
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
     * Affichage de la vue donnant la liste des types
     */
    public function listAll() {
        $dao = new TypeDao();
        $types_list = $dao->readAll();
        $view = new TypeView();
        $view->listAll($types_list);
    }
    
    
    /**
     * Affichage du formulaire de création d'un type
     */
    public function addForm() {
        $view = new TypeView();
        $view->addForm();
    }
    
    
    /**
     * Traitement des données saisies dans le formulaire d'ajout d'un type
     * Génère l'écriture dans la base
     */
    public function addProcessing() {
        /**
         * @warning Code sensible aux attaques
         * @todo Attention prévoir de protéger le code des injections !
         */
        $name = null;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        
        $type = new Type($name);
        $dao = new TypeDao();
        $dao->create($type);
        header('Location: ?route=types');
    }
    
    
    /**
     * Affichage du formulaire d'update d'un type
     * @param int $id l'id du type à modifier
     */
    public function updateForm(int $id) {
        $dao = new TypeDao();
        $type = $dao->read($id);
        if ($type != null) {
            $view = new TypeView();
            $view->updateForm($type);
        } else {
            //no result found
            $view = new DefaultView();
            $view->error404();
        }
    }
    
    
    /**
     * Traitement des données saisies dans le formulaire d'update d'un type
     * Génère l'écriture dans la base
     */
    public function updateProcessing() {
        $type = new Type($_POST['name'], $_POST['id']);
        $dao = new TypeDao();
        $dao->update($type);
        header('Location: ?route=types');
    }
    
}
