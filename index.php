<?php

$EMAIL_ID = 3444556; // 9-digit integer value (i.e., 123456789)
$API_KEY = "fe595c15"; // API key (string) provided by Open Movie DataBase (i.e., "ab123456")

session_start(); // Connect to the existing session

require_once '/home/common/php/dbInterface.php'; // Add database functionality
require_once '/home/common/php/mail.php'; // Add email functionality
require_once '/home/common/php/p4Functions.php'; // Add Project 4 base functions

processPageRequest(); // Call the processPageRequest() function



function addMovieToCart($imdbID)
{
    if (movieExistsInDB($imdbID) === 0) {
        $result = file_get_contents('http://www.omdbapi.com/?apikey=' . $GLOBALS['API_KEY'] . '&i=' . $imdbID . '&type=movie&r=json');
        $movieInfo = json_decode($result, true);
        // var_dump($movieInfo);
        // addMovie($imdbID, $Title, $Year, $rating, $runtime, $genre, $actors, $director, $writer, $plot, $poster);
        $movieId = addMovie($movieInfo['imdbID'], $movieInfo["Title"], $movieInfo["Year"], $movieInfo["Rated"], $movieInfo["Runtime"], $movieInfo["Genre"], $movieInfo["Actors"], $movieInfo["Director"], $movieInfo["Writer"], $movieInfo["Plot"], $movieInfo["Poster"]);


        addMovieToShoppingCart($_SESSION["userId"], $movieId);
        displayCart();
    }
}

function displayCart()
{
    $userId = $_SESSION["userId"];
    getMoviesInCart($userId);

    require_once('templates/cart_form.html');
}

function processPageRequest()
{

    if (isset($_SESSION["displayName"]) && $_SESSION["displayName"]) {
    } else {

        header("Location: logon.php");
        exit();
    }


    if (!isset($_GET['action'])) {


        displayCart();
    } else {

        if ($_GET['action'] === "add") {

            $imdbID = $_GET['imdb_id'];
            addMovieToCart($imdbID);
            header("Location: index.php");
        }
        if ($_GET['action'] === "remove") {
            removeMovieFromCart($_GET['movie_id']);
            header("Location: index.php");
        }
    }
}

function removeMovieFromCart($movieId)
{
    removeMovieFromShoppingCart($_SESSION["userId"], $movieId);
    header("Location: index.php");
}