


if(getCookieValue("acceptCookie")!=="true") {
    if (window.confirm("Sind Sie mit der Verwendung von Cookies einverstanden?")) {
        document.cookie = "acceptCookie=true;";
    }
}

function getCookieValue(VaraibleName) {
    var decodedCookie = decodeURIComponent(document.cookie);
    VaraibleName=VaraibleName+"=";

    //find the index where VariableName begins
    let pos =decodedCookie.search(VaraibleName)
    if(pos ===-1) return "error: this cooke Variable doesnt exist"

    //skip the String of "VariableName=" and set pos to index for the
    //value of VaraibleName
    pos+=VaraibleName.length;
    let i = pos
    //get the last index of value
    while (i<decodedCookie.length && decodedCookie[i] !== ";")
        i++;

    return decodedCookie.slice(pos, i);
}
