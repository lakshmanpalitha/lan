<div class="search-form bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" placeholder="Search Deals" type="text">
                    </div>
                </div>
            </div>
            <!-- /.col 4 -->
            <div class="col-sm-3">
                <select class="form-control sm-margin-bottom-10">
                    <option value="0" selected="selected">
                        Select your categorie
                    </option>
                    <?php
                    if (!empty($this->categorys)) {
                        foreach ($this->categorys as $cat) {
                            ?>
                            <option value="<?php echo $cat->category_id ?>"><?php echo $cat->category_name ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <!-- /.col 3 -->
            <div class="col-sm-2">
                <a class="btn btn-raised ripple-effect btn-success btn-block" href="results.html">
                    Search Deals
                </a>
            </div>
            <!-- /.col 1 -->
        </div>
    </div>
</div>