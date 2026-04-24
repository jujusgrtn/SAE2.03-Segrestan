<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");


function readMoviesController(){
    $movies = getAllMovies();
    return $movies;
}

function addMovieController() {
    $name = $_POST['title'] ?? null;
    $director = $_POST['director'] ?? null;
    $year = !empty($_POST['year']) ? (int)$_POST['year'] : null;
    $length = !empty($_POST['length']) ? (int)$_POST['length'] : null;
    $description = $_POST['description'] ?? null;
    $id_category = $_POST['category'] ?? null;
    $image = $_POST['image'] ?? null;   
    $trailer = $_POST['trailer'] ?? null;
    $min_age = !empty($_POST['min_age']) ? (int)$_POST['min_age'] : null;

    if (!$name || !$director || !$year) {
        return ["status" => "error", "message" => "Champs obligatoires"];
    }   

    $result = addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer, $min_age);
    if ($result == true) {
        return ["status" => "success", "message" => "Film ajouté avec succès"];
    } else {
        return ["status" => "error", "message" => "Erreur lors de l'ajout du film"];
    }

}