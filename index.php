<?php

require_once "Classes/DataModel/LayoutDataModel.php";
require_once "Classes/GlobalsUtility.php";

use Classes\DataModel\LayoutDataModel;
use Classes\GlobalsUtility;

$globalsUtility = new GlobalsUtility();
$layoutDataModel = $globalsUtility -> GetLayoutDataModel();

$layoutDataModel -> setPageName("Велькам");
$layoutDataModel -> AddBodySegment("<h1>Велкам то Шашенбеш</h1>");
$layoutDataModel -> AddBodySegment('<a href="game.php"><button>Стартуем</button></a>');

require_once "Layout/Layout.inc";
