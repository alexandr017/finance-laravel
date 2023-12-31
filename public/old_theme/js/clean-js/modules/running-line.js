class RunningLine {
    typedTextSpan; // span для текста
    cursorSpan; // span для курсора

    ArrValues; // массив строк с текстом
    typeSpeed;// ск-ть набора
    backSpeed; // ск-ть удаления набора
    newTextDelay; // пауза между набором
    ArrValuesIndex; // индекс текущей строки из массива текста
    charIndex; //индекс текущего символа

    /**
     * @param textId
     * @param cursorId
     * @param ArrValues
     */
    constructor(textId, cursorId, ArrValues) {
        this.typedTextSpan = document.querySelector(textId);
        this.cursorSpan = document.querySelector(cursorId);
        this.ArrValues = ArrValues;
        this.typeSpeed = 60;
        this.backSpeed = 60;
        this.newTextDelay = 2000;
        this.ArrValuesIndex = 0;
        this.charIndex = 0;
    }

    /**
     * @param _typedTextSpan
     * @param _cursorSpan
     * @param _ArrValues
     * @param _typeSpeed
     * @param _backSpeed
     * @param _newTextDelay
     * @param _ArrValuesIndex
     * @param _charIndex
     */
    static type(_typedTextSpan, _cursorSpan, _ArrValues, _typeSpeed, _backSpeed, _newTextDelay, _ArrValuesIndex, _charIndex) {
        if (_charIndex < _ArrValues[_ArrValuesIndex].length) {
            if (!_cursorSpan.classList.contains("typing")) _cursorSpan.classList.add("typing");
            _typedTextSpan.textContent += _ArrValues[_ArrValuesIndex].charAt(_charIndex);
            _charIndex++;
            setTimeout(RunningLine.type, _typeSpeed, _typedTextSpan, _cursorSpan, _ArrValues, _typeSpeed, _backSpeed, _newTextDelay, _ArrValuesIndex, _charIndex);
        } else {
            _cursorSpan.classList.remove("typing");
            setTimeout(RunningLine.erase, _newTextDelay, _typedTextSpan, _cursorSpan, _ArrValues, _typeSpeed, _backSpeed, _newTextDelay, _ArrValuesIndex, _charIndex);
        }
    }

    /**
     * @param _typedTextSpan
     * @param _cursorSpan
     * @param _ArrValues
     * @param _typeSpeed
     * @param _backSpeed
     * @param _newTextDelay
     * @param _ArrValuesIndex
     * @param _charIndex
     */
    static erase(_typedTextSpan, _cursorSpan, _ArrValues, _typeSpeed, _backSpeed, _newTextDelay, _ArrValuesIndex, _charIndex) {
        if (_charIndex > 0) {
            if (!_cursorSpan.classList.contains("typing")) _cursorSpan.classList.add("typing");
            _typedTextSpan.textContent = _ArrValues[_ArrValuesIndex].substring(0, _charIndex - 1);
            _charIndex--;
            setTimeout(RunningLine.erase, _backSpeed, _typedTextSpan, _cursorSpan, _ArrValues, _typeSpeed, _backSpeed, _newTextDelay, _ArrValuesIndex, _charIndex);
        } else {
            _cursorSpan.classList.remove("typing");
            _ArrValuesIndex++;
            if (_ArrValuesIndex >= _ArrValues.length) _ArrValuesIndex = 0;
            setTimeout(RunningLine.type, _typeSpeed + 1100, _typedTextSpan, _cursorSpan, _ArrValues, _typeSpeed, _backSpeed, _newTextDelay, _ArrValuesIndex, _charIndex);
        }
    }

    start() {
        if (this.ArrValues.length) {
            setTimeout(RunningLine.type, this.newTextDelay + 250, this.typedTextSpan, this.cursorSpan, this.ArrValues, this.typeSpeed, this.backSpeed,
                this.newTextDelay, this.ArrValuesIndex, this.charIndex)
        }
    }
}