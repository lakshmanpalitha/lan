
$(document).ready(function() {
    try {
        setInterval(function() {
            var nURL = URL + MODULE + "/index/jsonProductBid/";
            var param = '';
            ajaxRequest(nURL, param, null, function(responseText) {
                try {
                    if (responseText)
                        var jsonData = JSON.parse(responseText);
                    if (jsonData) {
                        if (jsonData.success == true) {
                            for (var i in jsonData.data) {
                                var time_string = '';
                                if (jsonData.data[i].status == 'A') {
                                    if (jsonData.data[i].type == 'T') {
                                        var bid_time = jsonData.data[i].count;
                                        var arr = bid_time.split(':');
                                        var days = (Math.floor(arr[0] / 24));
                                        var hours = (arr[0] % 24);
                                        var min = arr[1];
                                        var sec = arr[2];
                                        time_string = '<i class="ti-timer color-green"></i>' + (days > 0 ? "'<b>' + days + '</b>d." : "") + '<b>' + hours + '</b>st.<b>' + min + '</b>min.<b>' + sec + '</b>sec.';

                                    } else {
                                        time_string = '<i class="ti-timer color-green"></i><b>' + jsonData.data[i].count + '</b> Bid limit <b>' + jsonData.data[i].bid_count_left + '</b> Bid left';
                                    }
                                } else {
                                    time_string = "<p>Bid Closed</p>";
                                    document.getElementById("index_pro_button_" + jsonData.data[i].id).style.display = "none";
                                    document.getElementById("sidebar_pro_button_" + jsonData.data[i].id).style.display = "none";
                                }
                                if ($("#sidebar_pro_timer_" + jsonData.data[i].id).length > 0) {
                                    $("#sidebar_pro_timer_" + jsonData.data[i].id).html(time_string);
                                }
                                if ($("#index_pro_timer_" + jsonData.data[i].id).length > 0) {
                                    $('#index_pro_timer_' + jsonData.data[i].id).html(time_string);
                                }
                            }
                        }
                    }
                } catch (err) {
                    alert(err.message);
                    return false;
                }
            });
        }, 1000);
    } catch (err) {
        alert(err.message);
        return false;
    }

});
//$(document).ready(function() {
//    var objs = $(".fright");
//
//    $.each(objs, function(itm, val) {
//        var htlid = $(val).find("span").attr("class");
//        jQuery.support.cors = true;
//        $.ajax({
//            url: '/web/20150202191309/http://www.ileisurebookings.com/bookings/api.php?hotel=' + htlid + '&dfghj=240ac9371ec2671ae99847c3ae2e6384&sfrj=c4ca4238a0b923820dcc509a6f75849b',
//            cache: false,
//            dataType: 'JSON',
//            success: function(data)
//            {
//
//                $.each(data, function() {
//                    $.each(this, function(k, v) {
//                        if (k == "hotelData")
//                        {
//                            $.each(v, function(k2, v2) {
//                                if (k2 == "hotel")
//                                {
//                                    $.each(v2, function(k3, v3) {
//                                        if (k3 == "minPrice")
//                                        {
//                                            $(val).html("<font color='#447639' size='2px' face='Arial, Helvetica, sans-serif'><span>from</span></font><br/><font color='#447639' size='3px' face='Arial, Helvetica, sans-serif' style='font-weight:bold'>USD </font><span class='bookingprice'>" + v3 + "</span>");
//                                            $(val).css({"visibility": "visible"});
//                                        }
//                                        if (k3 == "bookingLink")
//                                        {
//
//                                            $(".frightt" + htlid).html("<a href='" + v3 + "' style='text-decoration:none'><font color='#ffffff'>Check availability</font></a>");
//                                        }
//                                    });
//
//                                }
//                            });
//                        }
//                    });
//                });
//
//            },
//            error: function(xhr, ajaxOptions, thrownError) {
//                // alert(xhr.status);
//                // alert(thrownError);
//            }
//        });
//
//
//
//    });
//});


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
        xmlhttp.send(param); //here a xmlhttprequestexception number 101 is thrown 
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
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + thrownError);
        }
    })
}



