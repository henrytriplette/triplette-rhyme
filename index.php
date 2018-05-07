<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');


if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once('assets/lib/PHP-MySQLi-Database-Class/MysqliDb.php');
require_once('assets/inc/config/ftp.php');
require_once('services/functions/rhyme_functions.php');


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Triplette Rhyme Generator</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link rel="stylesheet" href="assets/lib/uikit/css/uikit.min.css" />
				<link rel="stylesheet" href="assets/css/main.css" />

        <!-- JS -->
        <script src="assets/lib/uikit/js/uikit.min.js"></script>
        <script src="assets/lib/uikit/js/uikit-icons.min.js"></script>
				<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    </head>
		<body>
		    <div class="section-hero uk-background-blend-color-burn uk-background-top-center uk-background-cover uk-section-large1 cta" style="background-image: url(assets/img/fox.jpg)" >

		        <div class="uk-container hero">
		            <div class="uk-flex uk-flex-center uk-inliner">
		                <form class="uk-margin-medium-top uk-margin-xlarge-bottom uk-search uk-search-default" id="searchbox_form" target="_self">
		                    <a href="#" class="uk-search-icon-flip" uk-search-icon id="searchbox_submit"></a>
		                    <input id="search_word" class="uk-search-input uk-form-large" type="search" autocomplete="off" name="search_word" placeholder="Enter search term here" autofocus="autofocus" onfocus="this.select()">
		                </form>
		            </div>
		        </div>
		    </div>

		    <div class="uk-section uk-padding-remove-top uk-padding-remove-bottom">
		        <div class="uk-container">
		            <hr>
		        </div>
		    </div>

		    <div class="uk-section">
		        <div class="uk-container">
		            <div class="uk-child-width-1-3@s uk-grid-divider" uk-grid id="searchbox_output">
		            </div>
		        </div>
		    </div>

	    <footer id="footer" class="uk-section uk-margin-remove uk-section-xsmall uk-text-small uk-text-muted border-top">
	        <div class="uk-container">
	            <div class="uk-child-width-1-2@m uk-text-center" uk-grid>
	                <div class="uk-text-right@m">
	                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: facebook"></a>
	                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: google"></a>
	                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: vimeo"></a>
	                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: instagram"></a>
	                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: twitter"></a>
	                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: youtube"></a>
	                </div>
	                <div class="uk-flex-first@m uk-text-left@m">
	                    <p class="uk-text-small">Copyright <?php echo date('Y'); ?> Henry Triplette</p>
	                </div>
	            </div>
	        </div>
	    </footer>

			<script>
				/* Search function */
				jQuery("#searchbox_form").submit(function(e) {
			    e.preventDefault(); // avoid to execute the actual submit of the form.
					searchRhymes();
				});

				jQuery( document ).on( 'click', '#searchbox_submit', function(e) {
					e.preventDefault();
					searchRhymes();
				});

				function searchRhymes() {
					var search_word = jQuery('#search_word').val();

					jQuery("#searchbox_output").html('Loading rhymes for: '+ search_word);

					jQuery.ajax({
						type: "POST",
						url: "services/ajax/searchbox_input.php",
						data: {
							'search_word': search_word
						},
						dataType: "html",
						success: function(msg) {
							jQuery("#searchbox_output").html(msg);
						},
						error: function()	{
							jQuery.alert.open("Chiamata fallita, si prega di riprovare...");
						}
					});

				}
			</script>

    </body>
</html>
