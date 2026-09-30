<?php
namespace view;


/**
 * Classe fournissant les vues de base de l'appli Web
 * @author V. Verdon
 * @version 20231115
 */
class DefaultView extends View {
    
    /**
     * Vue page d'accueil
     */
    public function welcome() {
        $this->getHeader();
        
        echo "<p>Page d'accueil</p>";
        
        $this->getFooter();
    }
    
    /**
     * Vue erreur 404
     */
    public function error404() {
        
        header('HTTP/1.1 404 Not Found');
        $this->getHeader();
        
        echo "<p>Erreur 404. Page introuvable</p>";
        
        $this->getFooter();
    }
}

