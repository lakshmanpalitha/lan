
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Online Users</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Online user list
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($this->registerUsers)) {
                                    foreach ($this->registerUsers as $us) {
                                        ?>
                                        <tr style="background-color: <?php echo ($us->user_sataus == 'I' ? '#f2dede' : ''); ?>" class="odd gradeX">
                                            <td><input onchange="chkEachShop(this)" class="chk_each" name="chk_each[]" id="shop_chk_<?php echo $us->user_id ?>" type="checkbox" value="<?php echo $us->user_id ?>"></td>
                                            <td><?php echo $us->user_id ?></td>
                                            <td><?php echo $us->user_f_name ?></td>
                                            <td><?php echo $us->user_email ?></td>
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

