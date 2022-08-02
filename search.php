<?php

$API_KEY = "fe695c13"; // API key (string) provided by Open Movie DataBase (i.e., "ab123456")

session_start(); // Connect to the existing session

processPageRequest(); // Call the processPageRequest() function



function displaySearchForm()
{
    require_once("./templates/search_form.html");
}

function displaySearchResults($searchString)
{
    $results = file_get_contents('http://www.omdbapi.com/?apikey=' . $GLOBALS['API_KEY'] . '&s=' . urlencode($searchString) . '&type=movie&r=json');
    $resultsArray = json_decode($results, true)["Search"];
    require_once("./templates/results_form.html");



    return array($searchString, $resultsArray);
}

function processPageRequest()
{
    if (isset($_SESSION["displayName"]) && $_SESSION["displayName"]) {
    } else {

        header("Location: logon.php");
        exit();
    }





    if (empty($_POST)) {
        displaySearchForm();
    } else {




        if (isset($_POST["keyword"])) {
            $searchString = $_POST["keyword"];
            displaySearchResults($searchString);
        }
    }
}