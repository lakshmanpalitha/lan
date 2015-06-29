$('#dataTables-example').dataTable();
function chkAll(e) {

    if (e.checked == true) {
        $('.chk_each').attr('checked', 'checked');
        document.getElementById("action_btn").style.display = "block";
    } else {
        $('.chk_each').removeAttr('checked');
        document.getElementById("action_btn").style.display = "none";
    }
}
function chkEach(e) {
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

function viewCategory(responseText) {
    var html = '';
    if (responseText)
        var jsonData = JSON.parse(responseText);

    if (jsonData) {
        if (jsonData.success == true) {
            for (var i in jsonData.data) {
                var bg_color = (jsonData.data[i]['category_status'] == 'I' ? '#f2dede' : '');

                html = html + "<tr style='background-color:" + bg_color + ";'>";
                html = html + "<td><input onchange='chkEach(this)' class='chk_each' name='chk_each[]' id='shop_chk_" + jsonData.data[i]['category_id'] + "' type='checkbox' value='" + jsonData.data[i]['category_id'] + "'></td>";
                html = html + "<td>" + jsonData.data[i]['category_name'] + "</td>";
                html = html + '<td><button class="btn btn-primary btn-circle" type="button"><i class="fa fa-list"></i></button></td>';
                html = html + "</tr>";
            }
            if (document.getElementById('category_list_body'))
                document.getElementById('category_list_body').innerHTML = html;
            if (document.getElementById('action_btn'))
                document.getElementById("action_btn").style.display = "none";
        } else {
            if (document.getElementById('error_msg'))
                document.getElementById('error_msg').innerHTML = jsonData.error;
            if (document.getElementById('error_body'))
                document.getElementById("error_body").style.display = "block";
        }
        if (document.getElementById('new_category'))
            document.getElementById("new_category").reset();
    }
}

function viewProducts(responseText) {
    var html = '';
    if (responseText)
        var jsonData = JSON.parse(responseText);

    if (jsonData) {
        if (jsonData.success == true) {
            for (var i in jsonData.data) {
                var bg_color = (jsonData.data[i]['product_status'] == 'I' ? '#f2dede' : '');

                html = html + "<tr style='background-color:" + bg_color + ";'>";
                html = html + "<td><input onchange='chkEach(this)' class='chk_each' name='chk_each[]' id='shop_chk_" + jsonData.data[i]['product_id'] + "' type='checkbox' value='" + jsonData.data[i]['product_id'] + "'></td>";
                html = html + "<td>" + jsonData.data[i]['product_name'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['category_id'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['product_market_price'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['product_bid_type'] + "</td>";
                html = html + "<td>" + (jsonData.data[i]['product_bid_type'] === 'C' ? jsonData.data[i]['product_max_bid_count'] : jsonData.data[i]['product_max_bid_time']) + "</td>";
                html = html + "<td>" + jsonData.data[i]['product_add_date'] + "</td>";
                html = html + "<td>" + jsonData.data[i]['product_publish_date'] + "</td>";
                html = html + '<td><button class="btn btn-primary btn-circle" type="button"><i class="fa fa-list"></i></button></td>';
                html = html + "</tr>";
            }
            if (document.getElementById('products_list_body'))
                document.getElementById('products_list_body').innerHTML = html;
            if (document.getElementById('action_btn'))
                document.getElementById("action_btn").style.display = "none";
        } else {
            if (document.getElementById('error_msg'))
                document.getElementById('error_msg').innerHTML = jsonData.error;
            if (document.getElementById('error_body'))
                document.getElementById("error_body").style.display = "block";
        }
        if (document.getElementById('new_product'))
            document.getElementById("new_product").reset();
    }
}

function changeCategoryState(e) {
    var msg = '';
    if (e == 'A') {
        msg = CONFIRM_ACTIVATE;
    } else if (e == 'I') {
        msg = CONFIRM_INACTIVATE;
    } else {
        msg = CONFIRM_DELETE;
    }
    if (doConfirm(msg)) {
        var params = $('#category_list_form').serialize();
        params = params + "&action=" + e;
        var nURL = URL + "admin/products/changeCategoryState/";
        xmlRequest(nURL, params, null, function(responseText) {
            viewCategory(responseText);
        });
    }
}



function createNewCategory() {
    var formData = new FormData();
    formData.append('section', 'general');
    formData.append('action', 'previewImg');
    // Main magic with files here
    formData.append('image', $('input[type=file]')[0].files[0]);

    var categoryName = document.getElementById('category_name').value;
    var categoryDesc = document.getElementById('category_description').value;
    formData.append('category_name', categoryName);
    formData.append('category_description', categoryDesc);


    var nURL = URL + "admin/products/createNewCategory/";
    ajaxRequest(nURL, formData, null, function(responseText) {
        viewCategory(responseText);
    });
}

function setBidTypeControll(e) {
    if (e === 'C') {
        document.getElementById("control_bid_time").style.display = "none";
        document.getElementById("control_bid_count").style.display = "block";
    } else if (e === 'T') {
        document.getElementById("control_bid_time").style.display = "block";
        document.getElementById("control_bid_count").style.display = "none";
    } else {
        document.getElementById("control_bid_time").style.display = "none";
        document.getElementById("control_bid_count").style.display = "none";
    }
}
function createNewProduct() {

    var params = $('#new_product').serialize();
    var nURL = URL + "admin/products/createNewProduct/";
    xmlRequest(nURL, params, null, function(responseText) {
        viewProducts(responseText);
    });
}
