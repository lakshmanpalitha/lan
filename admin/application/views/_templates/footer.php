</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo FILE_URL ?>public/theme/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo FILE_URL ?>public/theme/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo FILE_URL ?>public/theme/js/plugins/metisMenu/metisMenu.min.js"></script>



<!-- DataTables JavaScript -->
<script src="<?php echo FILE_URL ?>public/theme/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo FILE_URL ?>public/theme/js/plugins/dataTables/dataTables.bootstrap.js"></script>


<!-- Custom Theme JavaScript -->
<script src="<?php echo FILE_URL ?>public/theme/js/sb-admin-2.js"></script>
<script src="<?php echo FILE_URL ?>public/js/common.js"></script>
<script src="<?php echo FILE_URL ?>public/js/error.js"></script>
<?php echo (file_exists($jsController) ? '<script type="text/javascript" src="' . URL . $jsController . '"></script>' : "") ?>
<?php echo (file_exists($jsView) ? '<script type="text/javascript" src="' . URL . $jsView . '"></script>' : "") ?>
</body>

</html>