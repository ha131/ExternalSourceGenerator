<?php
session_start();
require_once 'config.php';
require_once 'classes/settings.class.php';

$st = new settings;
if ( isset($_COOKIE['token']) ) {
	$token = htmlspecialchars( $_COOKIE['token'] );
} else {
	$token = 'pfjkdllfmdk';
}
if ( $st->checkToken( $token ) === false ) {
	setcookie('token', '');
	$_SESSION['lg'] = 'nlg';
} else {
	$_SESSION['lg'] = 'lg';
}

if ( ( !isset($_SESSION['lg']) ) or ( $_SESSION['lg'] == 'nlg' ) ) {
	header("Location: login.php");
	die();
}
?>