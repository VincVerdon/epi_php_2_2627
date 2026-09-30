<?php
namespace view;
use model\Manufacturer;

/**
 * Classe fournissant les vues pour la gestion des manufacturers
 * @author V. Verdon
 * @version 20231115
 */
class ManufacturerView extends View {
    
    /**
     * Affichage vue principale de gestion des manufacturers
     * Affiche la liste
     * @param array $list
     */
    public function listAll(array $list) {
        $this->getHeader();
        echo '
            <h2>Liste des fabricants</h2>
            <p><a href="?route=manufacturers&action=add">Ajouter un fabricant</a></p>
            <table><tr><th>Numero</th><th>Nom</th><th>Nom court</th></tr>
        ';
        foreach ($list as $man)
        {
            echo '<tr>';
            echo '<td>' . $man->getId() . '</td>';
            echo '<td>' . $man->getName() . '</td>';
            echo '<td>' . $man->getShortName() . '</td>';
            echo '<td><a href = "?route=manufacturers&action=update&id=' . $man->getId() . '">Modifier</a></td>';
            echo "</tr>\n";
        }
        echo '</table>';
        echo '<p><a href="?route=manufacturers&action=add">Ajouter un fabricant</a></p>';
        
        $this->getFooter();
    }
    
    
    /**
     * Affichage formulaire d'ajout d'un manufacturer
     */
    public function addForm() {
        $this->getHeader();
        
        echo '<form method="post" action="?route=manufacturers&action=add">';
        echo '<p><label id="name">Nom : </label><input type="text" placeholder="Nom du fabricant" name="name" id="name" /></p>';
        echo '<p><label id="short">Nom court : </label><input type="text" placeholder="Nom court ou sigle" name="short_name" id="short" /></p>';
        echo '<p><input type="submit" value="Envoyer" /><input type="reset" value="Annuler" /></p>';
        echo "</form>\n";
        
        $this->getFooter();
    }
    
    
    /**
     * Affichage formulaire d'update d'un manufacturer
     * @param Manufacturer $m
     */
    public function updateForm(Manufacturer $m) {
        $this->getHeader();
        
        echo '<form method="post" action="?route=manufacturers&action=update">';
        echo '<p><label id="id">Id : </label><input type="text" value="' . $m->getId() . '" name="id" id="id" readonly="readonly"/></p>';
        echo '<p><label id="name">Nom : </label><input type="text" value="' . $m->getName() . '" name="name" id="name" /></p>';
        echo '<p><label id="short">Nom court : </label><input type="text" value="' . $m->getShortName() . '" name="short_name" id="short" /></p>';
        echo '<p><input type="submit" value="Envoyer" /><input type="reset" value="Annuler" /></p>';
        echo "</form>\n";
        
        $this->getFooter();
    }
}

