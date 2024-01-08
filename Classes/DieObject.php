<?php

namespace Classes;

require_once "Classes/Exceptions/DieValueIsNotInitialisedException.php";

use Classes\Exceptions\DieValueIsNotInitialisedException;
use Random\Randomizer;

class DieObject
{
    private const DIE_SIDE_STYLE_DICTIONARY = array(
        1 => "die die_one",
        2 => "die die_two",
        3 => "die die_three",
        4 => "die die_four",
        5 => "die die_five",
        6 => "die die_six"
    );

    private null|int $_dieValue = null;

    public function ThrowDie():void{
        $randomizer = new Randomizer();
        $this->_dieValue = $randomizer->getInt(1,6);
    }

    /**
     * @throws DieValueIsNotInitialisedException if die not throw earlier
     */
    public function GetDieValue(): int{
        if($this->_dieValue === null){
            throw new DieValueIsNotInitialisedException();
        }

        return $this->_dieValue;
    }

    /**
     * @throws DieValueIsNotInitialisedException if die not throw earlier
     */
    public function GetDieHtml(): string{
        $dieStyle = self::DIE_SIDE_STYLE_DICTIONARY[$this->GetDieValue()];

        return <<<DIE_IMAGE
            <div class="$dieStyle"></div>
        DIE_IMAGE;
    }
}