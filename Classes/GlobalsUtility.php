<?php

namespace Classes;

require_once "Classes/DataModel/LayoutDataModel.php";

use Classes\DataModel\LayoutDataModel;

class GlobalsUtility
{
    public function GetLayoutDataModel():LayoutDataModel{
        /**
         * @global $_LAYOUT_DATA_MODEL LayoutDataModel
         * @
         */
        global $_LAYOUT_DATA_MODEL;

        if(!isset($_LAYOUT_DATA_MODEL)){
            $_LAYOUT_DATA_MODEL = new LayoutDataModel();
        }

        return $_LAYOUT_DATA_MODEL;
    }
}