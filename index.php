<?php
$start = microtime(true);

include('assets/simple_html_dom.php');
include('assets/scrapper.php');
//header("Content-type:application/json");
$obj = scrap_ffxiv("bob");


$end = microtime(true);
$creationtime = ($end - $start);
printf("<hr><small>Page created in %.6f seconds.", $creationtime);
?>
