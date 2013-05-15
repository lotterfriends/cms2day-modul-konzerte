<?php

if (!isset($_SESSION['login'])) {
	print "KEINE BERECHTIGUNG!";
	exit;
}

require_once('update.inc.php');

$konzerte = mysql_query("SELECT * FROM modul_konzerte ORDER by datum DESC");

if (isset($_GET['action']) && $_GET['action'] == "delete") {
	mysql_query("DELETE FROM modul_konzerte WHERE id = '".(int)$_GET['id']."'");
	header ("Location: index.php?seite=modul&modul=".$_GET['modul']."&datei=admin&speichern=okay");
	exit;

} else if (isset($_GET['action']) && $_GET['action'] == "update") {
	$konzert = mysql_fetch_assoc(mysql_query("SELECT titel FROM modul_konzerte WHERE id = '".(int)$eintrag['id']."'"));	
	header ("Location: index.php?seite=modul&modul=".$_GET['modul']."&datei=admin&speichern=okay");
	exit;
}


?>

<div id="tabs">
    <h1>Modul : Konzerte</h1>
    <ul>
        <li><a id="tab1_link" onclick="cswitch('<?php print $_GET['seite']."-".$_GET['modul']."-".$_GET['datei']; ?>','tab1')" class="aktiv">&Uuml;bersicht</a></li>
    </ul>
</div>

<div id="tab1">
	<div class="box">
    
    	<?php

		if (mysql_num_rows($konzerte) == 0) {
			
			print '<div class="info">Bisher keine Konzert eingetragen. ';
			print '  <a title="Konzert eintragen" href="index.php?seite=modul&amp;modul='.$_GET['modul'].'&amp;datei=neu">';
			print '    Konzert eintragen';
			print '  </a>';
			print '</div>';
		
		} else {
		
			print "<table width='100%' cellspacing='0' cellpadding='0' summary='text'>";
			print "  <tr>";
			print "    <td width='80%' align='left'><h3>".mysql_num_rows($konzerte)." Konzerte </h3></td>";
			print "    <td width='20%' align='right'>";
			print "      <p><a title='Konzert eintragen' href='index.php?seite=modul&amp;modul=".$_GET['modul']."&amp;datei=neu'>";
			print "      <img src='../../includes/module/konzerte/images/neu.png' alt='' border='0' /></a></p>";
			print "    </td>";
			print "  </tr>";
			print "</table>";
			
			print "<table class='getTabelle' cellspacing='0' cellpadding='0' summary='text'>";		
			print "  <tr class='getTR_main'>";
			print "    <td style='border-right: none;'>Konzerte</td>";
			print "    <td width='50' align='right'></td>";
			print "  </tr>";

			$i = 0;
			while ($ausgabe = mysql_fetch_assoc($konzerte)) {
				$change_tr = $i % 2 == 0 ? "getTR_2" : "getTR_1";

				print "<tr class='$change_tr'>";
				print "  <td style='border-right: none;'>";
				
				$titel = trim($ausgabe['titel']);
				$datum = trim($ausgabe['datum']);
				list($y,$m,$d) = explode("-",$datum);
				$datum = "$d.$m.$y";
				$titel_link = trim($ausgabe['titel_link']);
				$fotos_link = trim($ausgabe['fotos_link']);
				$lokalitaet = trim($ausgabe['lokalitaet']);
				$ort = trim($ausgabe['ort']);
				print "$datum - ";
				print $titel;
				if (!empty($lokalitaet) ||  !empty($ort)) print " - ";
				if (!empty($lokalitaet)) print "($lokalitaet) ";
				if (!empty($ort)) print "$ort";
				print "  </td>";


				
				print "  <td>";
				print "    <ul>"; 
				
				print "      <li>";
				print "        <a title='Bearbeiten' href='index.php?seite=modul&amp;modul=".$_GET['modul']."&amp;datei=edit&amp;action=edit&amp;id=".$ausgabe['id']."'>";
				print "          <img alt='Bearbeiten' src='../data/images/edit.png'>";
				print "        </a>";
				print "      </li>";
				
				print "      <li>";
				print "        <a class='iconDelete' title='Löschen' 
				                  href='index.php?seite=modul&amp;modul=".$_GET['modul']."&amp;datei=admin&amp;action=delete&amp;id=".$ausgabe['id']."' onclick='return loeschen();'>";
				print "      </a></li>";
				print "    </ul>";
				print "  </td>";
				print "</tr>";
				
				$i++;
			}
			print "</table>";
		}
		?>

	</div>

</div>
