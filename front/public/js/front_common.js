$(document).ready(function() {
    console.log("ready!");
});

function xmlRequest(URL, param, div, returnFunc)
{
    var xmlhttp;
    if (param == "")
    {
        document.getElementById(div).innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {

            if (typeof returnFunc === 'function') {
                returnFunc(xmlhttp.responseText);
            }
        }
    }
    xmlhttp.open("POST", URL, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    try {
        xmlhttp.send(param);//here a xmlhttprequestexception number 101 is thrown 
    } catch (err) {
        alert('XMLHttprequest error: " + err.description + "');
        //this prints "XMLHttprequest error: undefined" in the body.
    }
}

function ajaxRequest(URL, param, div, returnFunc)
{
    $.ajax({
        url: URL,
        data: param,
        // THIS MUST BE DONE FOR FILE UPLOADING
        type: 'POST',
        processData: false,
        contentType: false,
        success: function(data) {
            if (typeof returnFunc === 'function') {
                returnFunc(data);
            }
        }
        // ... Other options like success and etc
    })
}




