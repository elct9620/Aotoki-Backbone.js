<?php
/**
 * Aotoki's Backbone Practice
 * 
 * @author Aotoki
 * @version 1.0
 */

/* Load Library */
require('lib/Slim/Slim.php');

/* Load Config */

/* Initialize Framework */
$app = new Slim(
		array(
			//'http.version' => '1.0',
			'templates.path' => 'views',
			'DEBUG' => TRUE
		)
	);

/* Load Models */

/* Load APP */

/* Home Page */

$app->get('/', function() use ($app){
	
	$datas = array(
		'app' => $app,
	);
	
	$app->render('home.php', $datas);
});

/* Run Application */
$app->run();
?>