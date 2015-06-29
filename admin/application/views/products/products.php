
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
            <button style="border-radius: 0;float: right;margin: 5px 0;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                Create New Product
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">New product</h4>
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
                                    <label>Product Category</label>
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
                                    <label>Product Description</label>
                                    <textarea name='product_description' id="product_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Video Link</label>
                                    <input name='product_video_link' id="product_video_link" class="form-control" placeholder="Category name">
                                </div>
                                <div class="form-group">
                                    <label>Product Market Price</label>
                                    <input onkeypress='return isOnlyNumberKey(event)' name='product_market_price' id="product_market_price" class="form-control" placeholder="Category name">
                                </div>
                                <div class="form-group">
                                    <label>Product Bid Type</label>
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
                                                <option value='<?php echo $i ?>'><?php echo $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label class="checkbox-inline">
                                        <select name='product_max_min' id="product_max_min" class="form-control">
                                            <option value=''>-Max minute-</option>
                                            <?php
                                            for ($i = 0; $i <= 60; $i++) {
                                                ?>
                                                <option value='<?php echo $i ?>'><?php echo $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label class="checkbox-inline">
                                        <select name='product_max_sec' id="product_max_sec"class="form-control">
                                            <option value=''>-Max second-</option>
                                            <?php
                                            for ($i = 0; $i <= 60; $i++) {
                                                ?>
                                                <option value='<?php echo $i ?>'><?php echo $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>

                                </div>
                                <div style="display:none;" id="control_bid_count" class="form-group">
                                    <label>Max bid count</label>
                                    <input onkeypress='return isOnlyNumberKey(event)' name='product_max_count' id="product_max_count" class="form-control" placeholder="Bid count">
                                </div>

                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button onclick="createNewProduct()" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products list
                    <div id="action_btn" style="float:right;display:none;">
                        <button onclick="changeCategoryState('A')" class="btn btn-success btn-xs" type="button">Activate</button>
                        <button onclick="changeCategoryState('I')" class="btn btn-warning btn-xs" type="button">Inactivate</button>
                        <button onclick="changeCategoryState('D')" class="btn btn-danger btn-xs" type="button">Delete</button>
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
                                        <th>Product Category</th>
                                        <th>Product Market Price</th>
                                        <th>Product Bid Type</th>
                                        <th>Product Max Bid Control</th>
                                        <th>Product Add Date</th>
                                        <th>Product Publish Date</th>
                                        <th>Action</th>
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
                                                <td><?php echo $pro->category_id ?></td>
                                                <td><?php echo $pro->product_market_price ?></td>
                                                <td><?php echo $pro->product_bid_type ?></td>
                                                <td><?php echo ($pro->product_bid_type === 'C' ? $pro->product_max_bid_count : $pro->product_max_bid_time) ?></td>
                                                <td><?php echo $pro->product_add_date ?></td>
                                                <td><?php echo $pro->product_publish_date ?></td>
                                                <td class="center">
                                                    <button class="btn btn-primary btn-circle" type="button"><i class="fa fa-list"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr>
                                            <td colspan='7'>No Record Found</td>
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

