function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    console.log(charCode)
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function isCharacterKey(event) {
	var key = event.keyCode;
	return ((key >= 65 && key <= 90) || key == 8 || key == 9 || key == 13 || (key >= 32 && key <= 40) || key == 46 || key == 116 || key == 189 || key == 192)
}
