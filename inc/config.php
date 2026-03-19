<?php 

//Nastavenie a prepojenie s Databázou
// Require Composer's autoloader.

use Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
 
// Using Medoo namespace.
use Medoo\Medoo;
 
$database = new Medoo([
	// [required]
	'type' => 'mysql',
	'host' => $_ENV['DB_HOST'],
	'database' => $_ENV['DB_NAME'],
	'username' => $_ENV['DB_USER'],
	'password' => $_ENV['DB_PASS'],
]);

//Nastavenie base URL
$base_url = 'http://localhost/crystal-media/';


//Funkcia na paragrafy
function auto_p( $text ) {
	if(trim($text) === '') {
		return;
	}

	$text = str_replace("\r\n", "\r", $text);

	$text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

	$paragrafy = preg_split("/\n\s*\n/", trim($text));

	$out = '';

	foreach ($paragrafy as $p) {
		$p = nl2br(trim($p));
		$out .= "<p>$p</p>\n";
	}

	return $out;
}

function parity($number) {
	if ($number % 2 == 0) {
		return 'parne';
	} else {
		return 'neparne';
	}
}

function is_admin() {
	if( $_SESSION['user_role'] === 1 ) {
		return true;
	}
}