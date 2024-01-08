<?php

namespace Classes;

require_once "Classes/DieObject.php";

use Classes\DieObject;
use Classes\Exceptions\DieValueIsNotInitialisedException;

class Dice{
    private array $_dice = [];

    public function __construct(){
        $this->_dice[] = new DieObject();
        $this->_dice[] = new DieObject();
    }

    function ThrowDice(): void{
        /**
         * @var $value DieObject
         */
        foreach ($this->_dice as $value){
            $value->ThrowDie();
        }
    }

    /**
     * @throws DieValueIsNotInitialisedException if dice is not throw earlier
     */
    public function GetDiceValue(): string{
        $result = "";

        /**
         * @var $index int
         * @var $dieObject DieObject
         */
        foreach ($this->_dice as $index => $dieObject){
            $value = $dieObject->GetDieValue();

            $result = <<<RESULT_ACCUMULYTOR
            $result <span>Dice no $index throw value $value</span>
            RESULT_ACCUMULYTOR;
        }

        return $result;
    }

    /**
     * @throws DieValueIsNotInitialisedException if dice is not throw earlier
     */
    public function GetDiceHtml(): string{
        $result = "";

        /**
         * @var $dieObject DieObject
         */
        foreach ($this->_dice as $dieObject){
            $result .= $dieObject->GetDieHtml();
        }

        return $result;
    }
}