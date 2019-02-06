
<!-- DataTables -->
<script src="<?=base_url()?>lte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
$('#dashboard_1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
  	  "pageLength"  : 5,
  	  "pagingType": "simple"
});

$('#dt_employee').DataTable( {
	'searching'   : false
} );

</script>