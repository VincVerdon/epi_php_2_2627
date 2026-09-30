<?php
namespace api;

/**
 * Génère la réponse d'erreur pour l'API REST
 * @author V. Verdon
 * @version 20231115
 */
class ErrorApi {
    
    public function __construct() {
        header('HTTP/1.1 404 Not Found');
        header("Content-Type: application/json");
        $response = array('message' => 'Not Found');
        echo json_encode($response);
    }
}

