<?php
ini_set('display_errors', 1);
session_start();

require_once( '../../assets/lib/PHP-MySQLi-Database-Class/MysqliDb.php');
require_once( '../../assets/inc/config/ftp.php');

//========================================================
//  	DATABSAE
//========================================================
$db = new MysqliDb (TRIPLETTE_RHYME_DB_HOST, TRIPLETTE_RHYME_DB_USER, TRIPLETTE_RHYME_DB_PASSWORD, TRIPLETTE_RHYME_DB_NAME)
  or die ('Could not connect to the database server');

// Insert Cliente into MySQL table
// -------------------------------------------------------------- */

$insert = ($_POST);
if(!isset($_POST['search_word'])) { die('hell no;'); };

// Keep only letters
$insert['search_word'] = strtolower($insert['search_word']);
$insert['search_word'] = preg_replace('/\s+/', '', $insert['search_word']); // Remove whitespace
$insert['search_word'] = preg_replace("/[^a-z]+/", "", $insert['search_word']); // Keep only letters

// Let's get last letters from word
$last_letters_array = [];
for ($i=2; $i < strlen($insert['search_word']); $i++) {
  if ( $i < 6 ) {
    $last_letters_array[] = substr($insert['search_word'], -$i); // returns last chars
  }
}

// Begin output
$output = '';

// Find words
$last_letters_array = array_reverse($last_letters_array); // Reverse array, longer first
foreach ($last_letters_array as $key => $last_letters) {
  $words = $db->rawQuery("SELECT * FROM `dictionary_ita` WHERE `word` LIKE '%".$last_letters."'");

  $output .= '<div>
      <h3>'.strlen($last_letters).' - ...'.$last_letters.'</h3>
      <div class="uk-panel uk-panel-scrollable uk-height-medium uk-padding-small">
      <ul class="uk-list uk-list-divider link-icon-right">';
        foreach ($words as $word) {
          $output .= '<li>'.$word['word'].'</li>';
        }
      $output .= '</ul>
      </div>
  </div>';
}

// Return output
echo $output;
