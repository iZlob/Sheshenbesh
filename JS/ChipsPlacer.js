class ChipsPlacer{

    /**
     * @private
     */
    _serializedWhiteChipsPosition;

    /**
     * @private
     */
    _deserializedWhiteChipsPosition;
    /**
     * @private
     */
    _serializedBlackChipsPosition;

    /**
     * @private
     */
    _deserializedBlackChipsPosition;

    /**
     * @private
     * @method
     */
    GetWhiteChipsPosition(internalFunc){
        const _this = this;
        
        $.ajax("/API/GetWhiteChips.php").done(function(data){
            _this._serializedWhiteChipsPosition = data;
            _this._deserializedWhiteChipsPosition = JSON.parse(data);
            internalFunc(_this);
        })
    }

    /**
     * @private
     * @method
     */
    GetBlackChipsPosition(internalFunc){
        const _this = this;

        $.ajax("/API/GetBlackChips.php").done(function(data){
            _this._serializedBlackChipsPosition = data;
            _this._deserializedBlackChipsPosition = JSON.parse(data);
            internalFunc(_this);
        })
    }

    /**
     * @private
     * @method
     */
    PlaceWhiteChipsInternal(_this) {
        const chipPlaceArray = _this._deserializedWhiteChipsPosition["ChipPlace"];
        let chipPlaceIndexes = new Array(25).fill(1);

        for (const chipPlaceElement of chipPlaceArray){
            const chipContainerId = `Chip_container_${chipPlaceElement}`;
            const chipContainerChipPlace = chipPlaceIndexes[chipPlaceElement];
            chipPlaceIndexes[chipPlaceElement]++;
            const chipPlaceClass = `ChipPlace_${chipContainerChipPlace}`;

            $(`#${chipContainerId} .${chipPlaceClass}`).html("<img src='/images/FishkaWhite.png'>");
        }
    }

    /**
     * @private
     * @method
     */
    PlaceBlackChipsInternal(_this) {
        const chipPlaceArray = _this._deserializedBlackChipsPosition["ChipPlace"];
        let chipPlaceIndexes = new Array(25).fill(1);

        for (const chipPlaceReverseIndex of chipPlaceArray){
            const chipPlaceElement = 23 - chipPlaceReverseIndex;
            const chipContainerId = `Chip_container_${chipPlaceElement}`;
            const chipContainerChipPlace = chipPlaceIndexes[chipPlaceElement];
            chipPlaceIndexes[chipPlaceElement]++;
            const chipPlaceClass = `ChipPlace_${chipContainerChipPlace}`;

            $(`#${chipContainerId} .${chipPlaceClass}`).html("<img src='/images/FishkaBlack.png'>");
        }
    }

    PlaceWhiteChips() {
        this.GetWhiteChipsPosition(this.PlaceWhiteChipsInternal)
    }

    PlaceBlackChips() {
        this.GetBlackChipsPosition(this.PlaceBlackChipsInternal)
    }
}

export default new ChipsPlacer;