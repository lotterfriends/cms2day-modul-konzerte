<?php

if (!isset($_SESSION['login'])) {

	print "KEINE BERECHTIGUNG!";
	exit;
	
}

function updateModulDB() {

	require_once('info.inc.php');

	$modul = mysql_fetch_assoc(mysql_query("SELECT * FROM module WHERE ordner = '".mysql_real_escape_string($modul_ordner)."' LIMIT 1"));

	if ($modul['version'] < $modul_version) {
		
		mysql_query ("UPDATE module SET version = '".mysql_real_escape_string($modul_version)."' WHERE ordner = '".mysql_real_escape_string($modul_ordner)."' LIMIT 1");
		
	}

}

updateModulDB();

?>
