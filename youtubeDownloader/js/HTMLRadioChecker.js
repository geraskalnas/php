var myOption = false
function initValue() {
    myOption = document.forms[0].nameMethod[3]
}
 function fullName(form) {
    for (var i = 0; i < form.nameMethod.length; i++) {
        if (form.nameMethod[i].checked) {
            break
        }
    }
    console.log(form.nameMethod[i].value)
    if (form.nameMethod[i].value == "custom") {
    	showHide("customField", true)
    }else {
    	showHide("customField", false)
    }
}
function setShemp(setting) {
    myOption = setting
}
