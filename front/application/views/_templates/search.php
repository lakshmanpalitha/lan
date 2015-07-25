<div class="search-form bg-white">
    <div class="container">
        <form action="<?php echo URL . FRONTEND ?>bid/listing/" method="GET">
            <div class="row">
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-md-12">
                            <input value="<?php echo isset($this->key) ? $this->key : '' ?>" class="form-control" placeholder="Key Word" name="key" id="key" type="text">
                        </div>
                    </div>
                </div>
                <!-- /.col 4 -->
                <div class="col-sm-3">
                    <select name="category" placeholder="Category" id="category" class="form-control sm-margin-bottom-10">
                        <option selected="selected"></option>
                        <?php
                        if (!empty($this->categorys)) {
                            foreach ($this->categorys as $cat) {
                                ?>
                                <option <?php echo (isset($this->cat) && $this->cat == $cat->category_id ) ? 'selected' : '' ?> value="<?php echo $cat->category_id ?>"><?php echo $cat->category_name ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <!-- /.col 3 -->
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-raised ripple-effect btn-success btn-block">Search Deals</button>
                </div>
                <!-- /.col 1 -->
            </div>
        </form>
    </div>
</div>