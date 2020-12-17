/***************************************/
/*    Check and unCheck all    */
/***************************************/
function checkUncheckAll(theElement) {
    var theForm = theElement.form, z = 0;
    for (z = 0; z < theForm.length; z++) {
        if (theForm[z].type == 'checkbox' && theForm[z].name != 'checkall') {
            theForm[z].checked = theElement.checked;
            if (!jQuery(theForm[z]).closest('tr').hasClass('cli')) {
                if (theForm[z].checked) {
                    jQuery(theForm[z]).closest('tr').addClass('cli');
                }
            } else {
                if (!theForm[z].checked) {
                    jQuery(theForm[z]).closest('tr').removeClass('cli');
                }
            }
        }
    }
}

// confirm deleting messeges
function confirmation(message) {
    x = confirm(message);
    if (x == true) {
        return true
    }
    if (x == false) {
        return false
    }
}

// keyboard write only in numbers mode
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

/***************************************/
/*    Change textField's value to upperCase    */
/***************************************/

function changeToUpperCase(field) {
    var valueStr = new String(field.value);
    field.value = valueStr.toUpperCase();
}

/***************************************/
/*    to enable the user to press enter to start logon      */
/***************************************/
function logonWithEnter(event) {
    var whichCode = (window.event) ? window.event.keyCode : event.which;
    if (whichCode == 13)
        doSubmit(); //enter key
    return letternumberPass(event)
}
/*****************************************/
/*    Prevent Ctrl+v Event               */
/*****************************************/
function disablePaste(e, element) {
    var key;
    var isCtrl;

    if (window.event)
    {
        key = window.event.keyCode; //IE
        if (window.event.ctrlKey) {
            isCtrl = true;
        } else {
            isCtrl = false;
        }
    } else {
        key = e.which; //firefox
        if (e.ctrlKey) {
            isCtrl = true;
        } else {
            isCtrl = false;
        }
    }

    if (isCtrl && (key == 86 || key == 118)) {
        e.returnValue = false;
        return false;
    }
    return true;
}

/***************************************/
/*    used to enable English Only      */
/*    used in Registration and Reset Password and Change Passowrd  */
/*    With fileds : userid & password	*/
/***************************************/
function acceptEnglishOnly(event) {
    var whichCode = (window.event) ? window.event.keyCode : event.which;
    /*1642 %
     42 *
     43 +
     45 -
     47 /
     58 :
     60 >
     62 <
     40(
     41)
     64@
     35#
     36jQuery
     37%
     */
    if ((whichCode > 127) || (whichCode < 32) || (whichCode == 1642) || (whichCode == 42) || (whichCode == 43)
            || (whichCode == 45) || (whichCode == 47) || (whichCode == 58) || (whichCode == 60) || (whichCode == 62)
            || (whichCode == 40) || (whichCode == 41) || (whichCode == 64) || (whichCode == 35))
        return false;
}

function acceptPassChars(event) {
    var whichCode = (window.event) ? window.event.keyCode : event.which;
    if (whichCode == 8)
        return true;
    if ((whichCode > 126) || (whichCode < 48) || (whichCode == 1642) || ((whichCode > 57) && (whichCode < 65))
            || ((whichCode > 90) && (whichCode < 97)))
        return false;
}

function checkInvalidChars(myNumber) {
    var alphaCheck = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    var text = myNumber.value;
    var validText = "";
    for (i = 0; i <= text.length; i++)
    {
        if (alphaCheck.indexOf(text.charAt(i)) != -1) {
            validText = validText + text.charAt(i);
        }
    }
    myNumber.value = validText;
}

function checkInvalidCharsNoWhitEmpty(myNumber) {
    var alphaCheck = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-_";

    var text = myNumber.value;
    text = text.replace(/ /gi, '_');
    var validText = "";
    for (i = 0; i <= text.length; i++)
    {
        if (alphaCheck.indexOf(text.charAt(i)) != -1) {
            validText = validText + text.charAt(i);
        }
    }
    myNumber.value = validText;
}

// write the text to uppercase
function checkAccountValidChars(myNumber) {
    var alphaCheck = "_-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    var text = myNumber.value;
    var validText = "";
    var minusRepeat = false;
    var previous = "";
    for (i = 0; i <= text.length; i++)
    {
        if (alphaCheck.indexOf(text.charAt(i)) != -1 && minusRepeat == false) {
            validText = validText + text.charAt(i);
        }
        previous = text.charAt(i);
    }
    myNumber.value = validText.toUpperCase();
}

// use dropdown menu to redirect to required id
function get_dropdown_id(page) {
    b = document.assign.drop.value;
    a = page + b;
    document.location.href = a;
}

function get_dropdown_id_multi(page, field) {
    b = document.assign.elements[field].value;
    a = page + b;
    document.location.href = a;
}




function showMe(id) { // This gets executed when the user clicks on the checkbox
    var obj = document.getElementById(id);
    if (obj.style.display == "none") { // if it is checked, make it visible, if not, hide it
        obj.style.display = "block";
    } else {
        obj.style.display = "none";
    }
}

function showMeTblRow(id, classNmaes) { // This gets executed when the user clicks on the checkbox
    var obj = document.getElementById(id);
    $('.' + classNmaes).css('display', 'none');
    $('.' + classNmaes + ' select').val("Null");
    if (obj.style.display == "none") { // if it is checked, make it visible, if not, hide it
        obj.style.display = "block";
    } else {
        obj.style.display = "none";
    }
}

function showMeJQ(id) { // This gets executed when the user clicks on the checkbox
    $("#" + id).toggle();
}

function showIfNotNull(value, id, target_style) {

    var obj = document.getElementById(id);
    if (value != "Null") { // if it is checked, make it visible, if not, hide it
        obj.style.display = target_style;
        //document.getElementById('show_submenu').checked=true;
    } else {
        obj.style.display = "none";
    }
}


function showIfNull(value, id) {

    var obj = document.getElementById(id);
    if (value == "Null") {
        obj.style.display = 'block';
    } else {
        obj.style.display = "none";
    }
}


jQuery(document).ready(function () {
    jQuery('#editor').show(1000);
});


function addEvent(code) {
    var ni = document.getElementById('myDiv');
    var numi = document.getElementById('theValue');
    var num = (document.getElementById("theValue").value - 1) + 2;
    numi.value = num;
    var divIdName = "my" + num + "Div";
    var newdiv = document.createElement('div');
    newdiv.setAttribute("id", divIdName);
    newdiv.innerHTML = code + "<a href=\"javascript:;\" onclick=\"removeElement(\'" + divIdName + "\')\"><img src=\"../../back_images/del.png\"></a>";
    ni.appendChild(newdiv);
}

function removeElement(divNum) {
    var d = document.getElementById('myDiv');
    var olddiv = document.getElementById(divNum);
    d.removeChild(olddiv);
}

function filter(begriff) {
    var suche = begriff.value.toLowerCase();
    var table = document.getElementById("filetable");
    var ele;
    for (var r = 1; r < table.rows.length; r++) {
        ele = table.rows[r].cells[1].innerHTML.replace(/<[^>]+>/g, "");
        if (ele.toLowerCase().indexOf(suche) >= 0)
            table.rows[r].style.display = '';
        else
            table.rows[r].style.display = 'none';
    }
}

function selectAll(obj) {
    var oFileList = obj.elements['chkfiles[]'];
    for (i = 0; i < oFileList.length; ++i) {
        if (obj.selall.checked == true)
            oFileList[i].checked = true;
        else
            oFileList[i].checked = false;
    }
}

function formSubmit(formID)
{
     $( '#'+formID).submit();
}
