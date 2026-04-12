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
	if( isset($_SESSION['user_role']) && $_SESSION['user_role'] === 1 ) {
		return true;
	}
}


function slugy($text) {

	$map = [
        'á'=>'a','ä'=>'a','č'=>'c','ď'=>'d','é'=>'e','ě'=>'e','í'=>'i',
        'ľ'=>'l','ĺ'=>'l','ň'=>'n','ó'=>'o','ô'=>'o','ř'=>'r','š'=>'s',
        'ť'=>'t','ú'=>'u','ů'=>'u','ý'=>'y','ž'=>'z',
        'Á'=>'a','Ä'=>'a','Č'=>'c','Ď'=>'d','É'=>'e','Ě'=>'e','Í'=>'i',
        'Ľ'=>'l','Ĺ'=>'l','Ň'=>'n','Ó'=>'o','Ô'=>'o','Ř'=>'r','Š'=>'s',
        'Ť'=>'t','Ú'=>'u','Ů'=>'u','Ý'=>'y','Ž'=>'z'
    ];

    // nahradenie diakritiky
    $text = strtr($text, $map);

    //bez diakritky
    $text = iconv("UTF-8", "ASCII//TRANSLIT", $text);

    //malé písmená
    $text = strtolower($text);

    //nahradiť špeciálne znaky
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);

    $text = trim($text, '-');

    return $text;
}

function is_api($api) {
	global $database; 

	if ($isAccount = $database->has("users", ["AND" => ['API' => $_GET['api']] ])) {
		return true;
	}
}