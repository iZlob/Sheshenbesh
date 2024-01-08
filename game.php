<?php

require_once "Classes/DataModel/LayoutDataModel.php";
require_once "Classes/GlobalsUtility.php";
require_once "Classes/Dice.php";

use Classes\DataModel\LayoutDataModel;
use Classes\GlobalsUtility;
use Classes\Dice;

$globalsUtility = new GlobalsUtility();
$layoutDataModel = $globalsUtility -> GetLayoutDataModel();

$layoutDataModel->setPageName("Бой насяльника.");
$layoutDataModel -> IncludeCss("Board");
$layoutDataModel -> IncludeCss("ChipContainer");
$layoutDataModel -> IncludeCss("die_faces");
$layoutDataModel -> IncludeJsLink("https://code.jquery.com/jquery-3.7.1.js");
$layoutDataModel -> IncludeJsText(<<<JS_CODE
$(".Board > div:nth-child(2) > div > div > div:nth-child(1) .ChipContainer")
    .html(`
        <div class="ChipPlace_1"></div>
        <div class="ChipPlace_2"></div>
        <div class="ChipPlace_3"></div>
        <div class="ChipPlace_4"></div>
        <div class="ChipPlace_5"></div>
        <div class="ChipPlace_6"></div>`
    );
$(".Board > div:nth-child(2) > div > div > div:nth-last-child(1) .ChipContainer")
    .html(`
        <div class="ChipPlace_6"></div>
        <div class="ChipPlace_5"></div>
        <div class="ChipPlace_4"></div>
        <div class="ChipPlace_3"></div>
        <div class="ChipPlace_2"></div>
        <div class="ChipPlace_1"></div>
    `);

JS_CODE);

$layoutDataModel -> IncludeJsText(<<<JS

import ChipsPlacer from "/JS/ChipsPlacer.js" 
import DicesThrower from "/JS/DicesThrower.js"

ChipsPlacer.PlaceWhiteChips();
ChipsPlacer.PlaceBlackChips();
DicesThrower.Initialize(0, 70, 0, 40, "#Dice_left_container");
DicesThrower.RepositionDices();
$("#ThrowDiceButton").on("click", function (){
    DicesThrower.OnDiceThrowClick(DicesThrower);
});

JS);

$topLeftChipContainers = ChipContainerGenerator(6, 11, true);
$topRightChipContainers = ChipContainerGenerator(0,5,true);
$bottomLeftChipContainers = ChipContainerGenerator(12, 17, false);
$bottomRightChipContainers = ChipContainerGenerator(18, 23, false);

$dice = new Dice();
$dice->ThrowDice();
$diceHtml = $dice->GetDiceHtml();

$layoutDataModel -> AddBodySegment(<<<BODY
    <div class="Board">
        <div>
            <button id="ThrowDiceButton">Throw dice</button>
        </div>
        <div >
            <div></div>
            <div>
                <div><!--Left field part-->
                    <div><!-- top left part-->
                        $topLeftChipContainers                       
                    </div>
                    <div id="Dice_left_container">$diceHtml</div><!-- center left part-->
                    <div><!-- bottom left part-->
                        $bottomLeftChipContainers                       
                    </div>
                </div>
                <div></div> <!--center part-->
                <div><!--right part-->
                    <div><!--top right part-->
                        $topRightChipContainers                        
                    </div>
                    <div id="Dice_right_container"></div><!--center right part-->
                    <div><!--bottom right part-->
                        $bottomRightChipContainers                       
                    </div>
                </div> 
            </div>
            <div></div>
        </div>
        <div ></div>
    </div>
BODY
);

require_once "Layout/Layout.inc";

function ChipContainerGenerator(int $firstIndex, int $lastIndex, bool $isReverseId):string
{
    $result = "";
    for ($counter = $firstIndex; $counter <= $lastIndex; $counter++){
        $currentId = $isReverseId ? $lastIndex - $counter : $firstIndex + $counter;
        $chipContainer = <<<CHIP_CONTAINER
            <div id="Chip_container_$currentId" class="ChipContainer"></div>
        CHIP_CONTAINER;

        $result .= $chipContainer;
    }

    return $result;
}