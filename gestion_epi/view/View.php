<?php
namespace view;


/**
 * Classe permettant de créer les vues
 * Faire hériter les classes vues de cette classe
 * @author V. Verdon
 * @version 20231115
 */
class View {
    
    /**
     * Charge l'entête HTML + bandeau de l'appli Web
     */
    public function getHeader() {
        require_once 'blocs/header.php';
    }
    
    /**
     * Charge le pied de page + ferme le doc HTML
     */
    public function getFooter() {
        require_once 'blocs/footer.php';
    }
}

