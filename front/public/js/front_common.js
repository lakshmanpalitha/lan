$( document ).ready(function() {
    // LEAK GLOBAL OPTIONS
    $.validationEngine= {fieldIdCounter: 0,defaults:{
       validationEventTrigger: "blur",
        scroll: true,
        focusFirstField:true,
        showPrompts: true,
       validateNonVisibleFields: false,
        ignoreFieldsWithClass: 'ignoreMe',
        promptPosition: "bottomLeft",
        bindMethod:"bind",
        inlineAjax: false,
        ajaxFormValidation: false,
        ajaxFormValidationURL: false,
        ajaxFormValidationMethod: 'get',
        onAjaxFormComplete: $.noop,
        onBeforeAjaxFormValidation: $.noop,
        onValidationComplete: false,
        doNotShowAllErrosOnSubmit: false,
        custom_error_messages:{},
        binded: true,
        notEmpty: false,
        showArrow: true,
        showArrowOnRadioAndCheckbox: false,
        isError: false,
        maxErrorsPerField: false,
        ajaxValidCache: {},
        autoPositionUpdate: false,
        InvalidFields: [],
        onFieldSuccess: false,
        onFieldFailure: false,
        onSuccess: false,
        onFailure: false,
        validateAttribute: "class",
        addSuccessCssClassToField: "",
        addFailureCssClassToField: "",
        autoHidePrompt: false,
        autoHideDelay: 10000,
        fadeDuration: 300,
        prettySelect: false,
        addPromptClass : "",
        usePrefix: "",
        useSuffix: "",
        showOneMessage: false
    }};


    if($("#user_login_form").length)
    {
        $("#user_login_form").validationEngine();
    }

    if($("#user_register_form").length)
    {
        $("#user_register_form").validationEngine();
    }

    if($('#reset_pwd').length)
    {
        $('#reset_pwd').validationEngine();
    }

    if($('#update-profile').length)
        {
            $('#update-profile').validationEngine();
        }



    function close_accordion_section() {
        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }

    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).next('div');

        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();

            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $(currentAttrValue).slideDown(300).addClass('open');
        }

        e.preventDefault();

    });


});

function bid_info() {
    try {
        setInterval(function() {
            var nURL = URL + MODULE + "/index/jsonProductBid/";
            var param = '';
            ajaxRequest(nURL, param, function(responseText) {
                bid_info_print(responseText);
            });
        }, 1000);
    } catch (err) {
        //alert(err.message);
        return false;
    }

}
function bid_info_each(val) {
    try {
        setInterval(function() {
            var nURL = URL + MODULE + "/index/jsonProductBid/" + val + "/";
            var param = '';
            ajaxRequest(nURL, param, function(responseText) {
                bid_info_print(responseText);
            });
        }, 1000);
    } catch (err) {
        //alert(err.message)
        return false;
    }

}
function bid_info_print(responseText) {
    try {
        if (responseText)
            var jsonData = responseText;
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
                            time_string = '<i class="ti-timer color-green"></i>' + (days > 0 ? '<b>' + days + '</b>d.' : "") + '<b>' + hours + '</b>st.<b>' + min + '</b>min.<b>' + sec + '</b>sec.';

                        } else {
                            time_string = '<i class="ti-timer color-green"></i><b>' + jsonData.data[i].count + '</b> Bid limit <b>' + jsonData.data[i].bid_count_left + '</b> Bid left';
                        }
                        if ($("#index_pro_button_" + jsonData.data[i].id).length > 0) {
                            document.getElementById("index_pro_button_" + jsonData.data[i].id).style.display = "block";
                        }
                        if ($("#sidebar_pro_button_" + jsonData.data[i].id).length > 0) {
                            document.getElementById("sidebar_pro_button_" + jsonData.data[i].id).style.display = "block";
                        }
                    } else {
                        time_string = "<p>Bid Closed</p>";
                        if ($("#index_pro_button_" + jsonData.data[i].id).length > 0) {
                            document.getElementById("index_pro_button_" + jsonData.data[i].id).style.display = "none";
                        }
                        if ($("#sidebar_pro_button_" + jsonData.data[i].id).length > 0) {
                            document.getElementById("sidebar_pro_button_" + jsonData.data[i].id).style.display = "none";
                        }
                    }
                    if ($("#sidebar_pro_timer_" + jsonData.data[i].id).length > 0) {
                        $("#sidebar_pro_timer_" + jsonData.data[i].id).html(time_string);
                    }
                    if ($("#sidebar_pro_user_count_" + jsonData.data[i].id).length > 0) {
                        $("#sidebar_pro_user_count_" + jsonData.data[i].id).html(jsonData.data[i].user_count);
                    }
                    if ($("#sidebar_pro_bid_count_" + jsonData.data[i].id).length > 0) {
                        $("#sidebar_pro_bid_count_" + jsonData.data[i].id).html(jsonData.data[i].bid_count);
                    }
                    if ($("#index_pro_timer_" + jsonData.data[i].id).length > 0) {
                        $('#index_pro_timer_' + jsonData.data[i].id).html(time_string);
                    }
                }
            }
        }
    } catch (err) {
        //alert(err.message);
        return false;
    }
}
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
        //alert('XMLHttprequest error: " + err.description + "');
        //this prints "XMLHttprequest error: undefined" in the body.
    }
}

function ajaxRequest(URL, param, returnFunc)
{
    jQuery.ajax({
        url: URL,
        data: param,
        type: 'POST',
        timeout: 60000,
        async: true,
        success: function(data) {
            try {
                if (typeof returnFunc === 'function') {
                    if (data) {
                        returnFunc(JSON.parse(data));
                    } else {
                        returnFunc(false);
                    }
                }
            }
            catch (err) {
                if (typeof returnFunc === 'function') {
                    returnFunc(false);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (typeof returnFunc === 'function') {
                returnFunc(false);
            }
        }

    })
}

function loading(div) {
    if (document.getElementById(div)) {
        document.getElementById(div).innerHTML = '';
        document.getElementById(div).innerHTML = '<div id="loding_img"><img src="' + URL + 'public/img/loading.gif"/></div>';

    }
}
function endLoading(div) {
    if (document.getElementById(div)) {
        document.getElementById(div).innerHTML = '';
    }
    return true;
}



