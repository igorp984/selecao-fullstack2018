<?php
require_once '_inc/global.php';

$header = new GHeader('Início');
$header->addLib(array('paginate'));
$header->show(false, 'index.php');
// ---------------------------------- Header ---------------------------------//



// ---------------------------------- Footer ---------------------------------//
$footer = new GFooter();
$footer->show();
?>