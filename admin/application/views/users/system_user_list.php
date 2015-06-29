
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">System Users</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <button style="border-radius: 0;float: right;margin: 5px 0;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                Create New System User
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">New user</h4>
                        </div>
                        <div style="display:none" id="error_body" class="modal-body">
                            <div id="error_msg" class="alert alert-danger">

                            </div>
                        </div>
                        <form id="new_sys_user">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input name='user_email' class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>User Password</label>
                                    <input maxlength='10' name='user_password' class="form-control" type="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input maxlength='10' name='confirm_user_password' class="form-control" type="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Admin Type</label>
                                    <select name='user_type' class="form-control">
                                        <option value=''>-Select user's shop-</option>
                                        <option value='SU'>Supper Admin</option>
                                        <option value='SH'>Shop Admin</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button onclick="createNewSystemUser()" type="button" class="btn btn-primary">Save changes</button>
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
                        <button onclick="changeSystemUserState('A')" class="btn btn-success btn-xs" type="button">Activate</button>
                        <button onclick="changeSystemUserState('I')" class="btn btn-warning btn-xs" type="button">Inactivate</button>
                        <button onclick="changeSystemUserState('D')" class="btn btn-danger btn-xs" type="button">Delete</button>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <form id="sys_user_list_form">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input onchange="chkAllShop(this)" id="shop_chk_all" type="checkbox" value=""></th>
                                        <th>User Id</th>
                                        <th>User email</th>
                                        <th>User type</th>
                                        <th>User reg date</th>
                                        <th>User last log</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='sys_user_list_body'>
                                    <?php
                                    if (!empty($this->systemUsers)) {
                                        foreach ($this->systemUsers as $us) {
                                            ?>
                                            <tr style="background-color: <?php echo ($us->user_sataus == 'I' ? '#f2dede' : ''); ?>" class="odd gradeX">
                                                <td><input onchange="chkEachShop(this)" class="chk_each" name="chk_each[]" id="shop_chk_<?php echo $us->user_id ?>" type="checkbox" value="<?php echo $us->user_id ?>"></td>
                                                <td><?php echo $us->user_id ?></td>
                                                <td><?php echo $us->user_email ?></td>
                                                <td><?php echo $us->user_type ?></td>
                                                <td><?php echo $us->user_reg_date ?></td>
                                                <td><?php echo $us->user_last_log ?></td>
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

