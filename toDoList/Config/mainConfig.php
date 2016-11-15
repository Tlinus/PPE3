<?php
// ---------------------------------------------------------------
// CONFIGURATION GENERALE
// ---------------------------------------------------------------
// CHEMINS vers les DOSSIERS 				=> INDICATION DES CHEMINS CORRECTS !
if(!defined('PATH_ROOT')) 					define('PATH_ROOT', 					'localhost/ToDoList'); // EN LOCAL !
//if(!defined('PATH_ROOT')) 				define('PATH_ROOT', 					$_SERVER['DOCUMENT_ROOT']); // en production
//if(!defined('PATH_ROOT')) 				define('PATH_ROOT', 					'http://www.todolist.fr/DVP/PHP-GESTION-DE-PROJET-V5/');

if(!defined('PATH_PROJET')) 				define('PATH_PROJET', 					PATH_ROOT.'/Projet'); // EN LOCAL !

//CHEMINS vers le projet ToDoList 
if(!defined('PATH_TODOLIST'))				define('PATH_TODOLIST',					PATH_ROOT.'/todolist/');

//CHEMIN vers le fichier CSS principale du site
if(!defined('PATH_CSS'))					define('PATH_CSS',						'/todolist/style.css');

//CHEMIN vers le Dossier des scripts SQL
if(!defined('PATH_SQL'))					define('PATH_SQL',						'/SQL');

//CHEMIN vers le fichier de connexion à la base de donnée du site
if(!defined('PATH_BDD'))					define('PATH_BDD',						PATH_SQL.'connectbdd.php');

//CHEMIN vers le Dossiers des class PHP
if(!defined('PATH_CLASS'))					define('PATH_CLASS',					'/Class');

//CHEMIN vers le Dossiers des scripts PHP
if(!defined('PATH_SCRIPT'))					define('PATH_SCRIPT',					'/Script_PHP');


?>