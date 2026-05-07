<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "segrestan1");
define("DBLOGIN", "segrestan1");
define("DBPWD", "segrestan1");


function getAllMovies($age=0){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "select id, name, image from Movie WHERE min_age <= :age";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function getAllCategories(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer toutes les catégories
    $sql = "SELECT * FROM Category ORDER BY name";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function addMovie($title, $director, $year, $length, $description, $category, $image, $trailer, $min_age){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête SQL de mise à jour du menu avec des paramètres
    $sql = "INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age) 
            VALUES (:name, :director, :year, :length, :description, :id_category, :image, :trailer, :min_age)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Lie les paramètres aux valeurs
    $stmt->bindParam(':name', $title);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':length', $length, PDO::PARAM_INT);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_category', $category, PDO::PARAM_INT);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':trailer', $trailer);
    $stmt->bindParam(':min_age', $min_age, PDO::PARAM_INT);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère le nombre de lignes affectées par la requête
    $res = $stmt->rowCount();
    return $res; // Retourne le nombre de lignes affectées
}

function getMovie($id){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, Movie.director, Movie.year, Movie.length, Movie.description, Movie.id_category, Movie.image, Movie.trailer, Movie.min_age FROM Movie LEFT JOIN Category ON Movie.id_category = Category.id WHERE Movie.id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res;
}

function getMoviesByCategory($id_category){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, Movie.image FROM Movie LEFT JOIN Category ON Movie.id_category = Category.id WHERE Category.id = :id_category";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addProfile($name, $avatar, $min_age){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO Profile (name, avatar, min_age) VALUES (:name, :avatar, :min_age)";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':min_age', $min_age, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->rowCount();
    return $res;
}

function getProfiles(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Profile";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addFavorite($id_profile, $id_movie){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT id FROM Favorite WHERE id_profile = :id_profile AND id_movie = :id_movie";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetch()) return "Déjà en favori";

    $sql = "INSERT INTO Favorite (id_profile, id_movie) VALUES (:id_profile, :id_movie)";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}

function getFavorites($id_profile){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, Movie.image FROM Movie 
            JOIN Favorite ON Movie.id = Favorite.id_movie 
            WHERE Favorite.id_profile = :id_profile";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function removeFavorite($id_profile, $id_movie){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "DELETE FROM Favorite WHERE id_profile = :id_profile AND id_movie = :id_movie";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}