$('#dataTables-sop-list').dataTable();

function chkAllShop(e) {

    if (e.checked == true) {
        $('.chk_each').attr('checked', 'checked');
        document.getElementById("action_btn").style.display = "block";
    } else {
        $('.chk_each').removeAttr('checked');
        document.getElementById("action_btn").style.display = "none";
    }
}
function chkEachShop(e) {
    if (e.checked == true) {
        document.getElementById("action_btn").style.display = "block";
    } else {
        if ($('input[name="chk_each[]"]:checked').length > 0) {
            document.getElementById("action_btn").style.display = "block";
        } else {
            document.getElementById("action_btn").style.display = "none";
        }
    }
}

function viewSystemUsers(responseText) {
    var html = '';
    if (responseText)
        var jsonData = JSON.parse(responseText);

    if (jsonData) {
        if (jsonData.success == true) {
            for (var i in jsonData.data) {
                var bg_color = (jsonData.data[i]['user_sataus'] == 'I' ? '#f2dede' : '');

                html = html + "<tr style='background-color:" + bg_color + ";'>";
                html = html + "<td><input onchange='chkEachShop(this)' class='chk_each' name='chk_each[]' id='shop_chk_" + jsonData.data[i]['user_id'] + "' type='checkbox' value='" + jsonData.data[i]['user_id'] + "'></td>";
                html = html + "<td>" + jsonData.data[i]['user_id'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['user_email'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['user_type'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['user_reg_date'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['user_last_log'] + "</td>";
                html = html + '<td><button class="btn btn-primary btn-circle" type="button"><i class="fa fa-list"></i></button></td>';
                html = html + "</tr>";
            }
            if (document.getElementById('sys_user_list_body'))
                document.getElementById('sys_user_list_body').innerHTML = html;
            if (document.getElementById('action_btn'))
                document.getElementById("action_btn").style.display = "none";
        } else {
            if (document.getElementById('error_msg'))
                document.getElementById('error_msg').innerHTML = jsonData.error;
            if (document.getElementById('error_body'))
                document.getElementById("error_body").style.display = "block";
        }
        if (document.getElementById('new_sys_user'))
            document.getElementById("new_sys_user").reset();
    }
}

function createNewSystemUser() {

    var params = $('#new_sys_user').serialize();
    var nURL = URL + "admin/users/createNewSystemUser/";
    xmlRequest(nURL, params, null, function(responseText) {
        viewSystemUsers(responseText);
    });
}

function changeSystemUserState(e) {
    var msg = '';
    if (e == 'A') {
        msg = CONFIRM_ACTIVATE;
    } else if (e == 'I') {
        msg = CONFIRM_INACTIVATE;
    } else {
        msg = CONFIRM_DELETE;
    }
    if (doConfirm(msg)) {
        var params = $('#sys_user_list_form').serialize();
        params = params + "&action=" + e;
        var nURL = URL + "admin/users/changeSystemUserStatus/";
        xmlRequest(nURL, params, null, function(responseText) {
            viewSystemUsers(responseText);
        });
    }
}
