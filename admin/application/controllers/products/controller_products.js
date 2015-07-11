$('#dataTables-example-pro').dataTable();

$(".pro_img").css("display", "none");

function newProduct() {
    try {
        document.getElementById('myModalLabel_pro').innerHTML = 'New Product';
        document.getElementById('pro_action').value = 'new';
        document.getElementById('pro_id').value = '';
        $("#new_product :input").prop('readonly', false);
        $("#new_product :input").attr("disabled", false);
        document.getElementById("pro_add_button").style.display = "block";
        document.getElementById("bid_time_lbl").style.display = "none";
        document.getElementById("control_bid_count").style.display = "none";
        document.getElementById("control_bid_time").style.display = "none";
        $('#myModal').modal('show', {backdrop: 'static'});
        document.getElementById("new_product").reset();
    } catch (err) {
        alert(err.message);
        return false;
    }
}
function chkAll(e) {
    try {
        if (e.checked == true) {
            $('.chk_each').attr('checked', 'checked');
            document.getElementById("action_btn").style.display = "block";
        } else {
            $('.chk_each').removeAttr('checked');
            document.getElementById("action_btn").style.display = "none";
        }
    } catch (err) {
        alert(err.message);
        return false;
    }

}
function chkEach(e, val) {
    try {

        if (e.checked == true) {
            if (val == 'P') {
                document.getElementById("bid_start").style.display = "block";
                document.getElementById("bid_peause").style.display = "none";
                document.getElementById("bid_delete").style.display = "block";
            } else if (val == 'R') {
                document.getElementById("bid_start").style.display = "none";
                document.getElementById("bid_peause").style.display = "block";
                document.getElementById("bid_delete").style.display = "none";
            } else if (val == 'S') {
                document.getElementById("bid_start").style.display = "block";
                document.getElementById("bid_peause").style.display = "none";
                document.getElementById("bid_delete").style.display = "block";
            }
            document.getElementById("action_btn").style.display = "block";

        } else {
            if ($('input[name="chk_each[]"]:checked').length > 0) {
                document.getElementById("action_btn").style.display = "block";
            } else {
                document.getElementById("action_btn").style.display = "none";
            }
        }
    } catch (err) {
        alert(err.message);
        return false;
    }

}

function viewCategory(responseText) {
    try {
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
    } catch (err) {
        alert(err.message);
        return false;
    }
}

function viewProducts(responseText) {
    try {
        var html = '';
        if (responseText)
            var jsonData = JSON.parse(responseText);

        if (jsonData) {
            if (jsonData.success == true) {
                for (var i in jsonData.data) {
                    var bg_color = (jsonData.data[i]['product_status'] == 'P' ? '#f2dede' : '');
                    var status = '';

                    if (jsonData.data[i]['product_bid_status'] == 'P') {
                        status = '<button disabled class="btn btn-warning btn-xs" type="button">Pending</button>';
                    } else if (jsonData.data[i]['product_bid_status'] == 'R') {
                        status = '<button disabled class="btn btn-info btn-xs" type="button">Running</button>';
                    } else if (jsonData.data[i]['product_bid_status'] == 'S') {
                        status = '<button disabled class="btn btn-danger btn-xs" type="button">Pause</button>';
                    } else if (jsonData.data[i]['product_bid_status'] == 'E') {
                        status = '<button disabled class="btn btn-success btn-xs" type="button">End</button>';
                    }

                    html = html + "<tr style='background-color:" + bg_color + ";'>";
                    html = html + "<td><input onchange=chkEach(this,'" + jsonData.data[i]['product_bid_status'] + "') class='chk_each' name='chk_each[]' id='shop_chk_" + jsonData.data[i]['product_id'] + "' type='radio' value='" + jsonData.data[i]['product_id'] + "'></td>";
                    html = html + "<td>" + jsonData.data[i]['product_name'] + "</td>";
                    html = html + "<td>" + jsonData.data[i]['cat_name'] + "</td>";
                    html = html + "<td>" + jsonData.data[i]['product_real_price'] + "</td>";
                    html = html + "<td>" + (jsonData.data[i]['product_bid_type'] === 'C' ? 'Bid Count' : 'Bid Time') + "</td>";
                    html = html + "<td>" + (jsonData.data[i]['product_bid_type'] === 'C' ? jsonData.data[i]['bid_count'] : jsonData.data[i]['bit_time']) + "</td>";
                    html = html + "<td>" + jsonData.data[i]['product_bid_interval'] + "</td>";
                    html = html + "<td>" + jsonData.data[i]['product_create_date'] + "</td>";
                    html = html + "<td>" + status + "</td>";
                    html = html + "<td>" + jsonData.data[i]['product_bid_start_date'] + "</td>";
                    html = html + '<td><button onclick=showProductDesc("' + jsonData.data[i]['product_id'] + '") class="btn btn-primary btn-xs" type="button">Add more</button>&nbsp;<button onclick=showImgModel("' + jsonData.data[i]['product_id'] + '") class="btn btn-primary btn-xs" type="button">Image</button>&nbsp;<button onclick=viewEachProduct("' + jsonData.data[i]['product_id'] + '")  class="btn btn-primary btn-xs" type="button">View</button></td>';
                    html = html + "</tr>";
                }
                if (document.getElementById('products_list_body')) {
                    document.getElementById('products_list_body').innerHTML = html;
                }
                if (document.getElementById('action_btn')) {
                    document.getElementById("action_btn").style.display = "none";
                }
                if (document.getElementById('new_product')) {
                    document.getElementById("new_product").reset();
                }
           
            } else {
                if (document.getElementById('error_msg'))
                    document.getElementById('error_msg').innerHTML = jsonData.error;
                if (document.getElementById('error_body'))
                    document.getElementById("error_body").style.display = "block";
            }

        }
    } catch (err) {
        alert(err.message);
        return false;
    }

}

function viewEachProduct(val) {
    document.getElementById('myModalLabel_pro').innerHTML = 'View Product';
    document.getElementById('pro_action').value = 'modify';
    document.getElementById('pro_id').value = val;

    $('#myModal').modal('show', {backdrop: 'static'});
    document.getElementById("new_product").reset();
    var params;
    params = params + "&product_id=" + val;
    var nURL = URL + "admin/products/viewEachProduct/";
    xmlRequest(nURL, params, null, function(responseText) {
        if (responseText)
            var jsonData = JSON.parse(responseText);
        if (jsonData) {
            if (jsonData.success == true) {
                if (jsonData.data[0]['product_bid_status'] != 'P') {
                    $("#new_product :input").prop('readonly', true);
                    $("#new_product :input").attr("disabled", true);
                    document.getElementById("pro_add_button").style.display = "none";
                } else {
                    $("#new_product :input").prop('readonly', false);
                    $("#new_product :input").attr("disabled", false);
                    document.getElementById("pro_add_button").style.display = "block";
                }
                document.getElementById('product_name').value = jsonData.data[0]['product_name'];
                document.getElementById('product_category').value = jsonData.data[0]['category_id'];
                document.getElementById('product_video_link').value = jsonData.data[0]['product_video_link'];
                document.getElementById('product_market_price').value = jsonData.data[0]['product_bid_int_hour'];
                document.getElementById('product_market_price').value = jsonData.data[0]['product_real_price'];
                document.getElementById('product_bid_type').value = jsonData.data[0]['product_bid_type'];

                var bid_time = jsonData.data[0]['product_bid_interval'];
                var arr = bid_time.split(':');
                var days = (Math.floor(arr[0] / 24));
                var hours = (arr[0] % 24);

                document.getElementById('product_bid_int_days').value = days;
                document.getElementById('product_bid_int_hour').value = hours;
                document.getElementById('product_bid_int_min').value = arr[1];
                document.getElementById('product_bid_int_sec').value = arr[2];

                if (jsonData.data[0]['product_bid_type'] == 'T') {
                    var bid_interval = jsonData.data[0]['bit_time'];
                    var arr = bid_interval.split(':');
                    var days = (Math.floor(arr[0] / 24));
                    var hours = (arr[0] % 24);

                    document.getElementById('product_max_days').value = days;
                    document.getElementById('product_max_hour').value = hours;
                    document.getElementById('product_max_min').value = arr[1];
                    document.getElementById('product_max_sec').value = arr[2];
                    document.getElementById("control_bid_time").style.display = "block";
                    document.getElementById("bid_time_lbl").style.display = "block";
                    document.getElementById("control_bid_count").style.display = "none";

                } else {
                    document.getElementById('product_max_count').value = jsonData.data[0]['bid_count'];
                    document.getElementById("control_bid_time").style.display = "none";
                    document.getElementById("bid_time_lbl").style.display = "none";
                    document.getElementById("control_bid_count").style.display = "block";

                }
            }
        }
    });
}

function changeCategoryState(e) {
    try {
        var msg = '';
        if (e == 'A') {
            msg = CONFIRM_ACTIVATE;
        } else if (e == 'I') {
            msg = CONFIRM_INACTIVATE;
        } else if (e == 'P') {
            msg = CONFIRM_PUBLISH;
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
    } catch (err) {
        alert(err.message);
        return false;
    }
}

function changeProductState(e) {
    try {
        var msg = '';
        if (e == 'R') {
            msg = CONFIRM_BID_START;
        } else if (e == 'S') {
            msg = CONFIRM_BID_STOP;
        } else if (e == 'D') {
            msg = CONFIRM_DELETE;
        }
        if (doConfirm(msg)) {
            var params = $('#products_list_form').serialize();
            params = params + "&action=" + e;
            var nURL = URL + "admin/products/changeProductState/";
            xmlRequest(nURL, params, null, function(responseText) {
               viewProducts(responseText);
            });
        }
    } catch (err) {
        alert(err.message);
        return false;
    }
}



function createNewCategory() {
    try {
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
    } catch (err) {
        alert(err.message);
        return false;
    }

}

function setBidTypeControll(e) {
    try {
        if (e === 'C') {
            document.getElementById("control_bid_time").style.display = "none";
            document.getElementById("bid_time_lbl").style.display = "none";
            document.getElementById("control_bid_count").style.display = "block";
        } else if (e === 'T') {
            document.getElementById("control_bid_time").style.display = "block";
            document.getElementById("bid_time_lbl").style.display = "block";
            document.getElementById("control_bid_count").style.display = "none";
        } else {
            document.getElementById("control_bid_time").style.display = "none";
            document.getElementById("bid_time_lbl").style.display = "none";
            document.getElementById("control_bid_count").style.display = "none";
        }
    } catch (err) {
        alert(err.message);
        return false;
    }
}
function createNewProduct() {
    try {
        var params = $('#new_product').serialize();
        var nURL = URL + "admin/products/createNewProduct/";
        xmlRequest(nURL, params, null, function(responseText) {
            viewProducts(responseText);
        });
    }
    catch (err) {
        alert(err.message);
        return false;
    }
}

function showProductDesc(val) {
    try {

        if (document.getElementById('editor'))
            document.getElementById('editor').innerHTML = '';
        loading('editor');
        $('#model_desc').modal('show', {backdrop: 'static'});
        var params = 'product_id=' + val;
        var nURL = URL + "admin/products/jsonGetProductDesc/";
        xmlRequest(nURL, params, null, function(responseText) {
            viewProductDesc(responseText);
        });



    } catch (err) {
        endLoading('editor');
        alert(err.message);
        return false;
    }
}
function addProductDesc() {
    try {
        var params = "product_desc=" + document.getElementById('editor').value;
        var nURL = URL + "admin/products/addProductDesc/";
        xmlRequest(nURL, params, null, function(responseText) {
            viewProductDesc(responseText);
        });
    }
    catch (err) {
        endLoading('editor');
        alert(err.message);
        return false;
    }
}
function viewProductDesc(responseText) {
    try {
        if (responseText)
            var jsonData = JSON.parse(responseText);
        if (jsonData) {
            if (jsonData.success == true) {
                if (document.getElementById('editor'))
                    document.getElementById('editor').innerHTML = jsonData.data;
            }
        }
        initSample(jsonData.data);
    } catch (err) {
        endLoading('editor');
        alert(err.message);
        return false;
    }
}
function addProductImg() {
    try {
        loading('ul_pro_img');
        var formData = new FormData();
        var no_of_img = document.getElementById('no_of_img').value;
        var product_id = document.getElementById('product_id').value;
        if (product_id && no_of_img > 0) {
            formData.append('product_id', product_id);
            formData.append('img_count', no_of_img);
            // Main magic with files here
            if (no_of_img > 0) {
                for (var i = 0; i <= parseInt(no_of_img - 1); i++) {
                    formData.append('image' + i, $('input[type=file]')[i].files[0]);
                }
            }

            var nURL = URL + "admin/products/addProductImg/";
            ajaxRequest(nURL, formData, null, function(responseText) {
                viewProductImg(responseText);
            });
        }
    }
    catch (err) {
        endLoading('ul_pro_img');
        alert(err.message);
        return false;
    }
}

function viewProductImg(responseText) {
    try {
        if (responseText)
            var jsonData = JSON.parse(responseText);
        var html = '';
        if (jsonData) {

            if (jsonData.success == true) {
                for (var i in jsonData.data) {
                    html = html + '<li>' +
                            '<img src="' + URL + "public/uploads/product/thumb/thumb_" + jsonData.data[i]['image_name'] + '" width="60" height="60"/>' +
                            '<span><span class="glyphicon glyphicon-remove"></span></span>' +
                            '<span><input ' + (jsonData.data[i]['default_image'] == "Y" ? "checked" : "") + ' value="' + jsonData.data[i]['product_id'] + '#' + jsonData.data[i]['image_id'] + '" id="def_img" name="def_img" type="radio" onclick="setDefaultImg(this)"></span>' +
                            '</li>';
                }
                if (document.getElementById('ul_pro_img'))
                    document.getElementById('ul_pro_img').innerHTML = html;
            } else {
                endLoading('ul_pro_img');
                if (document.getElementById('error_msg_img')) {
                    document.getElementById('error_msg_img').innerHTML = jsonData.error;
                }
                if (document.getElementById('error_body_img')) {
                    document.getElementById("error_body_img").style.display = "block";
                }
            }

        }
    }
    catch (err) {
        alert(err.message);
        return false;
    }
}
function selectUploadImg(val) {
    try {
        loading();
        $(".pro_img").css("display", "none");
        if (val > 0) {
            for (var i = 1; i <= val; i++) {

                $("#img" + i).css("display", "block");
            }
        }
    }
    catch (err) {
        alert(err.message);
        return false;
    }
}

function showImgModel(val) {
    try {
        loading('ul_pro_img');
        var product_id = document.getElementById('product_id').value = val;
        if (product_id) {
            if (document.getElementById('error_msg_img')) {
                document.getElementById('error_msg_img').innerHTML = '';
            }
            if (document.getElementById('error_body_img')) {
                document.getElementById("error_body_img").style.display = "none";
            }
            $(".pro_img").css("display", "none");
            $("#no_of_img").val('');
            $('#model_image').modal('show', {backdrop: 'static'});
            var params = 'product_id=' + product_id;
            var nURL = URL + "admin/products/jsonGetProductImg/";
            xmlRequest(nURL, params, null, function(responseText) {
                viewProductImg(responseText);
            });
        }
    }
    catch (err) {
        endLoading('ul_pro_img');
        alert(err.message);
        return false;
    }
}

function setDefaultImg(e) {
    try {
        var arr = e.value.split('#');
        loading('ul_pro_img');
        var params = 'product_id=' + arr[0] + "&img_id=" + arr[1];
        var nURL = URL + "admin/products/setDefaultProductImg/";
        xmlRequest(nURL, params, null, function(responseText) {
            viewProductImg(responseText);
        });
    }
    catch (err) {
        endLoading('ul_pro_img');
        alert(err.message);
        return false;
    }
}


