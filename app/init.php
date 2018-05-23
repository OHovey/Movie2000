<?php

// initialise database connectction

$server = '127.0.0.1';
$user = 'root';
$password = 'somepassword';
$db = 'somedatabase';
$Database = new mysqli($server, $user, $password, $db);

if ($Database->connect_error) {
    die('Error: ' . $Database->connect_error);
}

// mysqli_report(MYSQLI_REPORT_ERROR);
// ini_set('display_errors', 1);


// autoloader
function __autoloader($classname)
{
    include_once 'app/models' . $classname . '.php';
}

// import and instantiate objects
include('models/Template.php');
include('models/Movie.php');
include('models/Graphs.php');

$Template = new Template();
$Movie = new Movie();
$Graphs = new Graphs();



// set up constants
define('SITE_NAME', 'MOVIE 2000');
define('SITE_PATH', 'var/www/hmtl/');
define('IMAGES', 'var/www/hmtl/path/to/images');

?>