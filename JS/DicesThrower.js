class DicesThrower{
    /**
     * @private
     * @type {number}
     */
    _leftPercentage = 0;
    /**
     * @private
     * @type {number}
     */
    _rightPercentage = 0;
    /**
     * @private
     * @type {number}
     */
    _topPercentage = 0;
    /**
     * @private
     * @type {number}
     */
    _bottomPercentage = 0;
    /**
     * @private
     * @type {string}
     */
    _diceContainerSelector = "";

    /**
     * @public
     * @param leftPercentage
     * @param rightPercentage
     * @param topPercentage
     * @param bottomPercentage
     * @param diceContainerSelector
     * @constructor
     */
    Initialize(leftPercentage, rightPercentage, topPercentage, bottomPercentage, diceContainerSelector){
        this._leftPercentage = leftPercentage;
        this._rightPercentage = rightPercentage;
        this._topPercentage = topPercentage;
        this._bottomPercentage = bottomPercentage;
        this._diceContainerSelector = diceContainerSelector;
    }

    /**
     * @public
     * @method
     */
    RepositionDices(){
        const _this = this;

        $(".die").css("left", function(index, value){

            return _this.GetRandomLeftPosition() + "%";

        }).css("top", function(index, value){

            return _this.GetRandomTopPosition() + "%";

        });
    }

    /**
     * @private
     * @method
     * @return {number}
     */
    GetRandomLeftPosition(){
        let increment = (Math.random() * (this._rightPercentage - this._leftPercentage)).valueOf();

        return this._leftPercentage + increment;
    }

    /**
     * @private
     * @method
     * @return {number}
     */
    GetRandomTopPosition(){
        let increment = (Math.random() * (this._bottomPercentage - this._topPercentage)).valueOf();

        return this._topPercentage + increment;
    }

    /**
     * @param _this {DicesThrower}
     * @method
     */
    OnDiceThrowClick(_this){
        $.ajax("/API/ThrowDices.php").done(function (response){
            $(_this._diceContainerSelector).html(response);
            _this.RepositionDices();
        })
    }
}

export default new DicesThrower();