
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products list</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <button onclick="newProduct()"style="border-radius: 0;float: right;margin: 5px 0;" class="btn btn-primary btn-xs">
                Create New Product
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_pro">New product</h4>
                        </div>
                        <div style="display:none" id="error_body" class="modal-body">
                            <div id="error_msg" class="alert alert-danger">

                            </div>
                        </div>
                        <form id="new_product">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input name='product_name' id="product_name" class="form-control" placeholder="Category name">
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select id="product_category" name='product_category' class="form-control">
                                        <option value=''>-Select product category-</option>
                                        <?php
                                        if (!empty($this->category)) {
                                            foreach ($this->category as $cat) {
                                                ?>
                                                <option value="<?php echo $cat->category_id ?>"><?php echo $cat->category_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input name='product_video_link' id="product_video_link" class="form-control" placeholder="Category name">
                                </div>
                                <div class="form-group">
                                    <label>Real Price</label>
                                    <input onkeypress='return isOnlyNumberKey(event)' name='product_market_price' id="product_market_price" class="form-control" placeholder="Category name">
                                </div>
                                <div  class="form-group">
                                    <label>Bid Interval</label>
                                    <label class="checkbox-inline">
                                        <select name='product_bid_int_hour' id="product_bid_int_hour" class="form-control">
                                            <option value=''>-Max hour-</option>
                                            <?php
                                            for ($i = 0; $i <= 120; $i++) {
                                                ?>
                                                <option value='<?php echo ($i <= 9 ? 0 : '') . $i ?>'><?php echo $i ?>(hr)</option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label class="checkbox-inline">
                                        <select name='product_bid_int_min' id="product_bid_int_min" class="form-control">
                                            <option value=''>-Max minute-</option>
                                            <?php
                                            for ($i = 0; $i <= 60; $i++) {
                                                ?>
                                                <option value='<?php echo ($i <= 9 ? 0 : '') . $i ?>'><?php echo $i ?>(min)</option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label class="checkbox-inline">
                                        <select name='product_bid_int_sec' id="product_bid_int_sec"class="form-control">
                                            <option value=''>-Max second-</option>
                                            <?php
                                            for ($i = 0; $i <= 60; $i++) {
                                                ?>
                                                <option value='<?php echo ($i <= 9 ? 0 : '') . $i ?>'><?php echo $i ?>(sec)</option>
                                            <?php } ?>
                                        </select>
                                    </label>

                                </div>

                                <div class="form-group">
                                    <label>Bid Type</label>
                                    <select onchange="setBidTypeControll(this.value)" name='product_bid_type' id="product_bid_type" class="form-control">
                                        <option value=''>-Select bid type-</option>
                                        <option value='C'>Bid count</option>
                                        <option value='T'>Bid time</option>
                                    </select>
                                </div>
                                <div style="display:none;" id="control_bid_time" class="form-group">
                                    <label>Max bid time</label>
                                    <label class="checkbox-inline">
                                        <select name='product_max_hour' id="product_max_hour" class="form-control">
                                            <option value=''>-Max hour-</option>
                                            <?php
                                            for ($i = 0; $i <= 120; $i++) {
                                                ?>
                                                <option value='<?php echo ($i <= 9 ? 0 : '') . $i ?>'><?php echo $i ?>(hr)</option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label class="checkbox-inline">
                                        <select name='product_max_min' id="product_max_min" class="form-control">
                                            <option value=''>-Max minute-</option>
                                            <?php
                                            for ($i = 0; $i <= 60; $i++) {
                                                ?>
                                                <option value='<?php echo ($i <= 9 ? 0 : '') . $i ?>'><?php echo $i ?>(min)</option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label class="checkbox-inline">
                                        <select name='product_max_sec' id="product_max_sec"class="form-control">
                                            <option value=''>-Max second-</option>
                                            <?php
                                            for ($i = 0; $i <= 60; $i++) {
                                                ?>
                                                <option value='<?php echo ($i <= 9 ? 0 : '') . $i ?>'><?php echo $i ?>(sec)</option>
                                            <?php } ?>
                                        </select>
                                    </label>

                                </div>
                                <div style="display:none;" id="control_bid_count" class="form-group">
                                    <label>Max bid count</label>
                                    <input onkeypress='return isOnlyNumberKey(event)' name='product_max_count' id="product_max_count" class="form-control" placeholder="Bid count">
                                </div>

                            </div>
                            <input type="hidden" name="pro_action" value="" id="pro_action">
                            <input type="hidden" name="pro_id" value="" id="pro_id">
                        </form>
                        <div class="modal-footer" id="pro_add_button">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button onclick="createNewProduct()" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- Modal desc -->
            <div class="modal fade" id="model_desc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width:90% !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Product Description</h4>
                        </div>
                        <div style="display:none" id="error_body" class="modal-body">
                            <div id="error_msg" class="alert alert-danger">

                            </div>
                        </div>
                        <form id="product_desc">
                            <div class="modal-body">
                                <textarea  name="product_desc" id="editor">adad</textarea>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button onclick="addProductDesc()" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.end modal desc -->
            <!-- Modal image -->
            <div class="modal fade" id="model_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width:60% !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Product Images</h4>
                        </div>
                        <div style="display:none" id="error_body_img" class="modal-body">
                            <div id="error_msg_img" class="alert alert-danger">

                            </div>
                        </div>
                        <div class="modal-body">
                            <form id="product_img" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label>No of image</label>
                                    <select id="no_of_img" onchange="selectUploadImg(this.value)" style="border-radius:0 !important;width:20%;height:30px;"name='product_max_min' id="product_max_min" class="form-control">
                                        <option value=''>-Image-</option>
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            ?>
                                            <option value='<?php echo $i ?>'><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>

                                    <input name="img1" class="pro_img" id="img1" type="file">                          
                                    <input name="img2" class="pro_img" id="img2" type="file">               
                                    <input name="img3" class="pro_img" id="img3" type="file">               
                                    <input name="img4" class="pro_img" id="img4" type="file">                          
                                    <input name="img5" class="pro_img" id="img5" type="file">
                                </div>
                                <div class="form-group">
                                    <ul id="ul_pro_img">

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <input value="" type="hidden" id="product_id" name="product_id"/>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button onclick="addProductImg()" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.end modal image -->



        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products list
                    <div id="action_btn" style="float:right;display:none;">

                        <button onclick="changeProductState('A')" class="btn btn-success btn-xs" type="button">Activate</button>
                        <button onclick="changeProductState('I')" class="btn btn-warning btn-xs" type="button">Inactivate</button>
                        <button onclick="changeProductState('D')" class="btn btn-danger btn-xs" type="button">Delete</button>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <form id="products_list_form">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input onchange="chkAll(this)" id="shop_chk_all" type="checkbox" value=""></th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Market Price</th>
                                        <th>Bid Type</th>
                                        <th>Max Bid Control</th>
                                        <th>Bid Interval</th>
                                        <th>Add Date</th>
                                        <th>Status</th>
                                        <th>Publish Date</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='products_list_body'>
                                    <?php
                                    if (!empty($this->products)) {
                                        foreach ($this->products as $pro) {
                                            ?>
                                            <tr style="background-color: <?php echo ($pro->product_status == 'I' ? '#f2dede' : ''); ?>" class="odd gradeX">
                                                <td><input onchange="chkEach(this)" class="chk_each" name="chk_each[]" id="shop_chk_<?php echo $pro->product_id ?>" type="checkbox" value="<?php echo $pro->product_id ?>"></td>
                                                <td><?php echo $pro->product_name ?></td>
                                                <td><?php echo $pro->cat_name ?></td>
                                                <td><?php echo $pro->product_real_price ?></td>
                                                <td><?php echo ($pro->product_bid_type == 'C' ? 'Bid ount' : 'Bid Time') ?></td>
                                                <td><?php echo ($pro->product_bid_type == 'C' ? $pro->bid_count : $pro->bit_time) ?></td>
                                                <td><?php echo $pro->product_bid_interval ?></td>
                                                <td><?php echo $pro->product_create_date ?></td>
                                                <td>
                                                    <?php
                                                    if ($pro->product_status == 'A') {
                                                        echo '<button class="btn btn-success btn-xs" type="button">Activate</button>';
                                                    } else {
                                                        echo '<button class="btn btn-warning btn-xs" type="button">Inactivate</button>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $pro->product_bid_start_date ?></td>
                                                <td>
                                                    <p>
                                                        <button onclick="showProductDesc('<?php echo $pro->product_id ?>')" class="btn btn-primary btn-xs" type="button">Add more</button>
                                                        <button onclick="showImgModel('<?php echo $pro->product_id ?>')" class="btn btn-primary btn-xs" type="button">Image</button>
                                                        <button onclick="viewEachProduct('<?php echo $pro->product_id ?>')" class="btn btn-primary btn-xs" type="button">View</button>
                                                    </p>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr>
                                            <td colspan='8'>No Record Found</td>
                                          <tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->

