<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Chart
      <small>List Chart</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">chart</li>
    </ol>
  </section>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Chart</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin:10px">
              <div id="chartContainer" style="height: 300px; width: 100%;"></div> 
            </div>
            </div>
          </div>
        </div>
    </section>
  </div>

<div class="modal fade" id="modal-kpi-chart">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 5px">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Chart KPI</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div id="donutChart" style="height: 300px; width: 100%;"></div>  
            </div>
            <div class="col-md-6">
              <div id="donutChart2" style="height: 300px; width: 100%;"></div>  
            </div>
            
          </div>
          
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>