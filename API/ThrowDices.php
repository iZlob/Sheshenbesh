<?php

dir("..");

require_once "Classes\Dice.php";

use Classes\Dice;

$dice = new Dice();
$dice->ThrowDice();
$diceHtml = $dice->GetDiceHtml();

echo $diceHtml;
