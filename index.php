<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
include ROOT.'/config.php';
session_start();
date_default_timezone_set('Europe/Paris');
include ROOT.'/include/class.smarty.php';

// Autoload Function
$dir = opendir(ROOT.'/include');
while ($file = readdir($dir)):
    if(preg_match('#^function.([\w]+).php$#', $file)):
        require_once ROOT.'/include/'.$file;
    endif;
endwhile;
closedir($dir);

// Initialisation du template
$template = new smarty();
$template->setTemplateDir(ROOT.'/template');
$template->setCompileDir(ROOT.'/cache');

if(file_exists(ROOT.'/source/'.get(1).'.php')):
	if(!PASSWORD || (isset($_SESSION['password']) && PASSWORD == $_SESSION['password'])):
		$template->assign('page', get(1));
		include ROOT.'/source/'.get(1).'.php';
	else:
		$template->assign('page', 'login');
		include ROOT.'/source/login.php';
	endif;
else:
	include ROOT.'/source/404.php';
endif;

$template->display('template.tpl');
exit();
?>