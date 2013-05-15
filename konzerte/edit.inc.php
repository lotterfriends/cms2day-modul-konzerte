<?php

if (!isset($_SESSION['login'])) {
	print "KEINE BERECHTIGUNG!";
	exit;
}

if (isset($_GET['action']) && $_GET['action'] == "speichern") {

	if (isset($_POST['id']) && $_POST['id'] != "") {
		
		if ($_POST['titel'] == "" || $_POST['datum'] == "" ) {
			header ("Location: index.php?seite=modul&modul=".$_GET['modul']."&datei=admin&speichern=fehler");
			exit;
		} else {
			$datum = (!isset($_POST['datum'])) ? "" : trim($_POST['datum']);
			list($d,$m,$y) = explode(".",$datum);
			mysql_query ("UPDATE modul_konzerte SET 
				titel='".mysql_real_escape_string($_POST['titel'])."',
				datum='".mysql_real_escape_string("$y-$m-$d 00:00:00")."',
				titel_link='".mysql_real_escape_string($_POST['titel_link'])."',
				fotos_link='".mysql_real_escape_string($_POST['fotos_link'])."',
				ort='".mysql_real_escape_string($_POST['ort'])."',
				lokalitaet='".mysql_real_escape_string($_POST['lokalitaet'])."',
				zusatzinfo='".mysql_real_escape_string($_POST['zusatzinfo'])."'
				WHERE id='".mysql_real_escape_string($_POST['id'])."'");			
			header("Location: index.php?seite=modul&modul=".$_GET['modul']."&datei=admin&speichern=okay");
			exit;
		}		
		
	}
	
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {

	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM modul_konzerte WHERE id='".mysql_real_escape_string($_GET['id'])."'"));
	list($y,$m,$d) = explode("-",readTextFromDB($data['datum']));
	$datum = "$d.$m.$y";
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

        <form name="konzerte" method="post" action="index.php?seite=modul&amp;modul=konzerte&amp;datei=edit&amp;action=speichern" onsubmit="return checkneuskonzert()">
        
            <input type="hidden" value="<?php print $_GET['id'] ?>" name="id" />	
        
            <h2>Datum:</h2>
            <h3>Datum des Konzerts.</h3>
            <p><input id="datum" type="text" name="datum" value="<?php print $datum ?>" class="formular" maxlength="10" /></p>
        
            <h2>Titel:</h2>
            <h3>Titel des Konzerts.</h3>
            <p><input type="text" name="titel" value="<?php print readTextFromDB($data['titel']) ?>" class="formular" maxlength="255" /></p>
            
            <h2>Titel Link:</h2>
            <h3>Verlinkung des Titels z.B. auf die Facebook Veranstaltung.</h3>
            <p><input type="text" name="titel_link" value="<?php print readTextFromDB($data['titel_link']) ?>" class="formular" maxlength="255" /></p>
            
            <h2>Foto Link:</h2>
            <h3>Falls es eine Galerie gibt kann hier der Link zu dieser eingetragen werden.</h3>
            <p><input type="text" name="fotos_link" value="<?php print readTextFromDB($data['fotos_link']) ?>" class="formular" maxlength="255" /></p>

            <h2>Ort:</h2>
            <h3>Der Ort wo das Konzert veranstaltet wird, z.B. Hannover.</h3>
            <p><input type="text" name="ort" value="<?php print readTextFromDB($data['ort']) ?>" class="formular" maxlength="255" /></p>

            <h2>Lokal:</h2>
            <h3>Falls das Konzert in einem Lokal veranstaltet wird, kann dieses Hier eingetragen werden, z.B. Musikzentrum.</h3>
            <p><input type="text" name="lokalitaet" value="<?php print readTextFromDB($data['lokalitaet']) ?>" class="formular" maxlength="255" /></p>

            <h2>Zusatzinfos:</h2>
            <h3>Bei Bandcontests z.B. den Platz (Auch HTML erlaubt).</h3>
            <p><input type="text" name="zusatzinfo" value="<?php print readTextFromDB($data['zusatzinfo']) ?>" class="formular" maxlength="255" /></p>

            <table width="100%" cellspacing="0" cellpadding="0" summary="text">
            <tr>
            <td width="50%" align="left"><p><input type="button" onclick="history.back(-1);" value="Zur&uuml;ck" class="button" /></p></td>
            <td width="50%" align="right"><p><input type="submit" value="Speichern" class="button" /></p></td>
            </tr>
            </table>
        
        </form>

	</div>

</div>



