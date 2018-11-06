function cutLongerText(textToTrim, maxLength) {
        return textToTrim.substring(0, maxLength) + "[...]"
}

let textElt = document.getElementsByClassName("card-text");

const MAX_LEGTH_TEXT = 500;

for(let i=1; i<textElt.length; i++) {
    if (textElt[i].innerHTML.length>MAX_LEGTH_TEXT) {
    textElt[i].innerHTML = cutLongerText(textElt[i].innerHTML, MAX_LEGTH_TEXT);
    }
}