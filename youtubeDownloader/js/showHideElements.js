function showHide(id, disp=(document.getElementById(id).style.display === 'none')) {//id is the HTML element id, disp is
    var x = document.getElementById(id);
    if (disp) {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}