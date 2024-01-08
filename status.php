<?php

require_once "Classes/DataModel/LayoutDataModel.php";
require_once "Classes/GlobalsUtility.php";

use Classes\DataModel\LayoutDataModel;
use Classes\GlobalsUtility;

$globalsUtility = new GlobalsUtility();
$layoutDataModel = $globalsUtility -> GetLayoutDataModel();

$layoutDataModel -> SetPageName("Status:");
$layoutDataModel -> AddBodySegment("<h1>Status:</h1>");
$layoutDataModel -> AddBodySegment("<hr>");
$sqlite3ClassExist = class_exists("\SQLite3") ? "Yes" : "No";
$sqlite3ExtensionExist = extension_loaded("sqlite3") ? " Yes" : "No";
$layoutDataModel -> AddBodySegment(<<<STATUS_TABLE
<table>
    <thead>
        <tr>
            <td>Who are duty today?</td>
            <td>Status is...</td>
        </tr>    
    </thead>
    <tr>
        <td>\SQLite3 is?</td>
        <td>$sqlite3ClassExist</td>
    </tr>
    <tr>
        <td>sqlite3 is?</td>
        <td>$sqlite3ExtensionExist</td>
    </tr>
</table>
STATUS_TABLE
);

require_once "Layout/layout.inc";

phpinfo();