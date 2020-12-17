// PopUp Window
function PopUpWindow(str) {
    window.open(str, '', 'toobar=no,menubar=no,directories=no,status=no,scrollbars=yes,resizable=yes,copyhistory=no,width=500,height=400,left=400,top=200');
}

function alert_msg(str) {
    alert(str);
}

function close_PopUp(str) {
    alert(str);
    window.close();
}

function ShowMenu(num, menu, max)
{
    //num is selected value, menu is the name of the div, max is the number of divs
    for (i = 1; i <= max; i++) {
        //add number onto end of menu
        var menu_div = menu + i;

        //if current show
        if (i == num) {
            document.getElementById(menu_div).style.display = 'block';
        } else {
            //if not, hide
            document.getElementById(menu_div).style.display = 'none';
        }
    }
}

function validate_email(field, alerttxt)
{
    with (field)
    {
        apos = value.indexOf("@")
        dotpos = value.lastIndexOf(".")
        if (apos < 1 || dotpos - apos < 2) {
            alert(alerttxt);
            return false
        }
        else {
            return true;
        }
    }
}

function refresh_div(div) {
    curDiv = document.getElementById(div);
    return curDiv.reload();
}

function showKeyCode(e)
{
    //alert("Inside function showKeyCode(e)");
    var keycode = (window.event) ? event.keyCode : e.keyCode;

    if (keycode == 116) {
        event.keyCode = 0;
        event.returnValue = false;
        return false;
    }
}

function do_action(id, txt) {
    var x = document.getElementById(id);
    if (x.value == txt) {
        x.value = '';
    }
    x.onblur = function () {
        if (x.value == '') {
            x.value = txt;
        }
    }
}