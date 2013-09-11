<?php

function konzerte_ausgeben($konzerte) {
	print "<ul>";
	while ($ausgabe = mysql_fetch_assoc($konzerte)) {
		$titel = trim($ausgabe['titel']);
		$datum = trim($ausgabe['datum']);
		list($y,$m,$d) = explode("-",$datum);
		$datum = "$d.$m.$y";
		$titel_link = trim($ausgabe['titel_link']);
		$fotos_link = trim($ausgabe['fotos_link']);
		$lokalitaet = trim($ausgabe['lokalitaet']);
		$ort = trim($ausgabe['ort']);
		$zusatzinfo = trim($ausgabe['zusatzinfo']);
		
		print "<li>";
		print "$datum - ";
		if (!empty($titel_link)) print "<a target='_blank' href='$titel_link'>";
		print $titel;
		if (!empty($titel_link)) print "</a>";
		if (!empty($lokalitaet) ||  !empty($ort)) print " - ";
		if (!empty($lokalitaet)) print "($lokalitaet) ";
		if (!empty($ort)) print "$ort";
		if (!empty($fotos_link)) print " - <a href='$fotos_link'>Fotos</a>";
		if (!empty($zusatzinfo)) print " - $zusatzinfo";
		print "</li>";
	}
	print "</ul>";
}

print "<div id='modul'>";
print "<div id='modul_konzerte'>";

$konzerte_alt = mysql_query("SELECT * FROM modul_konzerte WHERE date(datum) < date(CURDATE()) ORDER by datum DESC");
$konzerte_neu = mysql_query("SELECT * FROM modul_konzerte WHERE date(datum) >= date(CURDATE()) ORDER by datum ASC");

if (mysql_num_rows($konzerte_alt) == 0 && mysql_num_rows($konzerte_neu)) {
	print "Noch keine Konzerte eingetragen.";
} else  {
	print "<h2>Kommt noch</h2>";
	konzerte_ausgeben($konzerte_neu);
	print "<h2>Schon vorbei</h2>";
	konzerte_ausgeben($konzerte_alt);
	
}




print "</div>";
print "</div>";
			
?>
