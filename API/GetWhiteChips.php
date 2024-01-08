<?php

require_once "../Classes/Contracts/GetChipsResponse.php";
require_once "../Classes/DataBaseProvider.php";

use \Classes\Contracts\GetChipsResponse;
use \Classes\DataBaseProvider;

$database = new DataBaseProvider();
$database->AddWhiteChipToBoard("5");
$chips = $database->GetWhiteChipsOnBoard();

$response = new  GetChipsResponse($chips);
$serializedResponse = $response -> GetSerializedResponse();
echo $serializedResponse;
