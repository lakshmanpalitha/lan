
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <button style="border-radius: 0;float: right;margin: 5px 0;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_category">
                Create New Category
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modal_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">New category</h4>
                        </div>
                        <div style="display:none" id="error_body" class="modal-body">
                            <div id="error_msg" class="alert alert-danger">

                            </div>
                        </div>
                        <form id="new_category">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input name='category_name' id="category_name" class="form-control" placeholder="Category name">
                                </div>
                                <div class="form-group">
                                    <label>Category Description</label>
                                    <textarea name='category_description' id="category_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Category Image</label>
                                    <input name='category_image' type="file">
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button onclick="createNewCategory()" type="button" class="btn btn-primary">Save changes</button>
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
                    System user list
                    <div id="action_btn" style="float:right;display:none;">
                        <button onclick="changeCategoryState('A')" class="btn btn-success btn-xs" type="button">Activate</button>
                        <button onclick="changeCategoryState('I')" class="btn btn-warning btn-xs" type="button">Inactivate</button>
                        <button onclick="changeCategoryState('D')" class="btn btn-danger btn-xs" type="button">Delete</button>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <form id="category_list_form">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input onchange="chkAll(this)" id="shop_chk_all" type="checkbox" value=""></th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='category_list_body'>
                                    <?php
                                    if (!empty($this->category)) {
                                        foreach ($this->category as $cat) {
                                            ?>
                                                <tr style="background-color: <?php echo ($cat->category_status	 == 'I' ? '#f2dede' : ''); ?>" class="odd gradeX">
                                                <td><input onchange="chkEach(this)" class="chk_each" name="chk_each[]" id="shop_chk_<?php echo $cat->category_id ?>" type="checkbox" value="<?php echo $cat->category_id ?>"></td>
                                                <td><?php echo $cat->category_name ?></td>
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

