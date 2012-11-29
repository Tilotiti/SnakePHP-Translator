<?php
$template->assign('title', 'Login');
$template->assign('page', 'login');
$template->assign('error', false);

if(isset($_POST['password'])):
	if(PASSWORD == $_POST['password']):
		$_SESSION['password'] = $_POST['password'];
		header('location: /');
		exit();
	else:
		$template->assign('error', true);
	endif;
endif;
?>