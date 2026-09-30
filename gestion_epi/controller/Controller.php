<?php
namespace controller;

/**
 * Classe contrôleur de base
 * Permet de créer des classes contrôleur pour chaque élément à gérer
 * @author V. Verdon
 * @version 20231115
 */
class Controller {
    
    protected string $method;
    protected string $action;
    
    /**
     * Constructeur classe parent Controller
     * @warning Doit être obligatoirement appelé par classe enfant !
     */
    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->action = '';
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
    }
}

