<?php
$start = microtime(true);

include('assets/simple_html_dom.php');
include('assets/scrapper.php');
$obj = scrap_ffxiv("http://eu.finalfantasyxiv.com/lodestone/character/6318718");

echo $obj;
$end = microtime(true);
$creationtime = ($end - $start);
printf("<hr><small>Page created in %.6f seconds.", $creationtime);
?>
