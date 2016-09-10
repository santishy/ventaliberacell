<?php 
	require_once ('vendor/autoload.php');
	$fb = new Facebook\Facebook([
			  'app_id' => '463785683829735', // Replace {app-id} with your app id
			  'app_secret' => 'c40d3e4bb9c615b0dfd0b5bfc47bcd7d',
			  'default_graph_version' => 'v2.7',
			  ]);
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; // Optional permissions
		$data['loginUrl'] = $helper->getLoginUrl('http://iscocomputadoras.com/inicio/respuesta', $permissions);
		echo '<a href="' . htmlspecialchars($loginUrl) .'">Log in with Facebook!</a>';