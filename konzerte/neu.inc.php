<?php

if (!isset($_SESSION['login'])) {
	print "KEINE BERECHTIGUNG!";
	exit;
}

 if (isset($_GET['action']) && $_GET['action'] == "speichern") {
	if ($_POST['titel'] == "" || $_POST['datum'] == "" ) {
	
		header ("Location: index.php?seite=modul&modul=".mysql_real_escape_string($_GET['modul'])."&datei=admin&speichern=fehler");
		exit;
		
	} else {
	
	$titel      = (!isset($_POST['titel']))      ? "" : trim($_POST['titel']);
	$datum      = (!isset($_POST['datum']))      ? "" : trim($_POST['datum']);
	$titel_link = (!isset($_POST['titel_link'])) ? "" : trim($_POST['titel_link']);
	$fotos_link = (!isset($_POST['fotos_link'])) ? "" : trim($_POST['fotos_link']);
	$ort        = (!isset($_POST['ort']))        ? "" : trim($_POST['ort']);
	$lokalitaet = (!isset($_POST['lokalitaet'])) ? "" : trim($_POST['lokalitaet']);
	$zusatzinfo = (!isset($_POST['zusatzinfo'])) ? "" : trim($_POST['zusatzinfo']);
	list($d,$m,$y) = explode(".",$datum);
	
	mysql_query ("INSERT INTO modul_konzerte (titel,datum,titel_link,fotos_link,ort,lokalitaet,zusatzinfo) VALUES (
		'".mysql_real_escape_string($titel)."',
		'".mysql_real_escape_string("$y-$m-$d 00:00:00")."',
		'".mysql_real_escape_string($titel_link)."',
		'".mysql_real_escape_string($fotos_link)."',
		'".mysql_real_escape_string($ort)."',
		'".mysql_real_escape_string($lokalitaet)."',
		'".mysql_real_escape_string($zusatzinfo)."')");	
		
		header ("Location: index.php?seite=modul&modul=".$_GET['modul']."&datei=admin&speichern=okay");
		exit;
	}
 }

?>

<div id="tabs">

    <h1>Modul : Konzerte</h1>

    <ul>
    
        <li><a id="tab1_link" onclick="cswitch('<?php print $_GET['seite']."-".$_GET['modul']."-".$_GET['datei']; ?>','tab1')" class="aktiv">Konzert eintragen</a></li>
    
    </ul>

</div>

<div id="tab1">

	<div class="box">

		<form name="konzerte" method="post" action="index.php?seite=modul&amp;modul=konzerte&amp;datei=neu&amp;action=speichern" onsubmit="return checkneuskonzert()">
        
			<h2>Datum:</h2>
			<h3>Datum des Konzerts.</h3>
			<p><input id="datum" type="text" name="datum" value="" class="formular" maxlength="10" /></p>
        
			<h2>Titel:</h2>
			<h3>Titel des Konzerts.</h3>
			<p><input type="text" name="titel" value="" class="formular" maxlength="255" /></p>
            
			<h2>Titel Link:</h2>
			<h3>Verlinkung des Titels z.B. auf die Facebook Veranstaltung.</h3>
			<p><input type="text" name="titel_link" value="" class="formular" maxlength="255" /></p>
            
			<h2>Foto Link:</h2>
			<h3>Falls es eine Galerie gibt kann hier der Link zu dieser eingetragen werden.</h3>
			<p><input type="text" name="fotos_link" value="" class="formular" maxlength="255" /></p>

			<h2>Ort:</h2>
			<h3>Der Ort wo das Konzert veranstaltet wird, z.B. Hannover.</h3>
			<p><input type="text" name="ort" value="" class="formular" maxlength="255" /></p>

			<h2>Lokal:</h2>
			<h3>Falls das Konzert in einem Lokal veranstaltet wird, kann dieses Hier eingetragen werden, z.B. Musikzentrum.</h3>
			<p><input type="text" name="lokalitaet" value="" class="formular" maxlength="255" /></p>

			<h2>Zusatzinfos:</h2>
			<h3>Bei Bandcontests z.B. den Platz (Auch HTML erlaubt).</h3>
			<p><input type="text" name="zusatzinfo" value="" class="formular" maxlength="255" /></p>


			<table width="100%" cellspacing="0" cellpadding="0" summary="text">
				<tr>
					<td width="50%" align="left"><p><input type="button" onclick="history.back(-1);" value="Zur&uuml;ck" class="button" /></p></td>
					<td width="50%" align="right"><p><input type="submit" value="Speichern" class="button" /></p></td>
				</tr>
			</table>
		</form>
	</div>
</div>
