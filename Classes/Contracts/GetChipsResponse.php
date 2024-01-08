<?php

namespace Classes\Contracts;

class GetChipsResponse
{
    private array $_chipPlace;

    public function __construct($chipPlaceArray){
        $this->_chipPlace = $chipPlaceArray;
    }

    public function GetSerializedResponse(): string
    {
        return json_encode(array("ChipPlace" => $this -> _chipPlace));
    }
}