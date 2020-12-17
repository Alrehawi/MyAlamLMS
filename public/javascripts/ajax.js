// Ajax Started -------------------------------------------------------------------------------

var XMLHttpRequestObject = false;
if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
}
else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function getData(dataSource, divID)
{
    document.getElementById(divID).innerHTML = "Loading...";
    if (XMLHttpRequestObject)
    {
        var obj = document.getElementById(divID);
        //alert(dataSource);
        var dataSource = dataSource + '&done=ok';
        XMLHttpRequestObject.open("GET", dataSource);
        XMLHttpRequestObject.onreadystatechange = function ()
        {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
                document.getElementById(divID).innerHTML = XMLHttpRequestObject.responseText;
            } //else {alert ('error'+dataSource)}
        }

        XMLHttpRequestObject.send(null);

    }
}

// Ajax Ended --------------------------------------------------------------------------------------
