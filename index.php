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

/* Initialize ORM */
ORM::configure('mysql:host=localhost;dbname=backbone.js');
ORM::configure('username', 'root');
ORM::configure('password', 'root');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

/* Load Models */

/* Load APP */

/* Home Page */
 
/* Run Application */
$app->run();
?>