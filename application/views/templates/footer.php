<!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://gmf-aeroasia.co.id">GMF AeroAsia</a>.</strong> All rights
    reserved.
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
</body>
</html>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?=base_url()?>lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>lte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>lte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>lte/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>lte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url()?>resources/assets/js/jquery.canvasjs.min.js"></script>
<script>
$('#dt_table').DataTable( {

} );
$('#btn-info-modal').click(function(){
  // $('#modal-create-structure"').modal().hide();
  $('#modal-help').modal().show();
});

</script>