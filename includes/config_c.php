<?php
//Sert à faire la connexion à la base de données
$db_user = 'root';
<<<<<<< Updated upstream:includes/config_c.php
$db_password = 'Pmcq2929';
$db_name = 'test_tp2_serveur2';

$db = new PDO('mysql:host=mysql; dbname=' . $db_name . ';charset=utf8', $db_user, $db_password);
=======
$db_password = 'Player1';
$db_name = 'test_tp2_serveur2';

$db = new PDO('mysql:host=localhost;port=3308; dbname=' . $db_name . ';charset=utf8', $db_user, $db_password);
>>>>>>> Stashed changes:includes/config_Sham.php

//set some db attributes
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define('APP_NAME', 'PHP API REST LAB');
