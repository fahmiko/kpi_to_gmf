<?php
$login = $this->session->userdata('login');
$color = $this->session->userdata('color');
$initial = strtoupper(substr($login['nama'], 0,2));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KPI GMF AeroAsia</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>resources/assets/css/buttons.dataTables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>lte/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Hotree Css -->
  <link rel="stylesheet" href="<?=base_url()?>resources/assets/css/jquery.hortree.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>lte/bower_components/select2/dist/css/select2.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .circle-text {
        display: inherit;
        height: 40px; /*change this and the width
        for the size of your initial circle*/
        width: 40px;
        border-radius: 50%;
        /*make it pretty*/
        background: #<?=$color['bg']?>;

        font-size: 25px;
        color: #fff;
        }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>PI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>KPI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>

   <!-- Left side column. contains the logo and sebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <div class="circle-text" style="text-align: center;vertical-align: middle;margin-left: -4px"><?=$initial?></div>
        </div>
        <div class="pull-left info">
          <p><?=$login['nama']?></p>
          <a href="#"><i class="fa fa-circle" style="color: #<?=$color['status']?>"></i> <?=$login['jabatan']?> (<?=$login['status']?>)</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php echo ($this->uri->segment(2) == null) ? "active" : "" ?>">
          <a href="<?=site_url()?>gmf">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview <?php echo ($this->uri->segment(2) == "list") ? "active" : "" ?>">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>KPI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>gmf/list"><i class="fa fa-list"></i> KPI</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modal-create-structure"><i class="fa fa-book"></i> Buat Struktur KPI</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modal-help"><i class="fa fa-info-circle"></i> Bantuan</a></li>
        </ul>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview <?php echo ($this->uri->segment(2) == "employee") ? "active" : "" ?>">
          <a href="<?=site_url()?>gmf/employee">
            <i class="fa fa-user"></i>
            <span>Pegawai</span>
          </a>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview <?php echo ($this->uri->segment(2) == "score") ? "active" : "" ?>">
          <a href="<?=site_url()?>gmf/score">
            <i class="fa fa-rocket"></i>
            <span>Skor</span>
          </a>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview <?php echo ($this->uri->segment(2) == "report") ? "active" : "" ?>">
          <a href="<?=site_url()?>gmf/report">
            <i class="fa fa-line-chart"></i>
            <span>Report</span>
          </a>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview <?php echo ($this->uri->segment(2) == "chart") ? "active" : "" ?>">
          <a href="<?=site_url()?>gmf/chart">
            <i class="fa fa-pie-chart"></i>
            <span>Chart</span>
          </a>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="<?=site_url()?>gmf/logout">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
          </a>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="modal fade" id="modal-create-structure">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Buat Struktur KPI</h4>
        </div>
        <div class="modal-body">
           <?=form_open('gmf/create_structure')?>
           <div class="form-group">
                <label>KPI</label>
                <input type="text" name="kpi_name" class="form-control" required="" placeholder="Masukan nama KPI(ex:KPI <?=date('Y')?>)">
            </div>
            <div class="form-group">
                <label>Level 2</label>
                <input type="number" name="level2" class="form-control" required="" placeholder="Jumlah Level 2(ex:3)">
            </div>
            <div class="form-group">
                <label>Level 3</label>
                <input type="number" name="level3" class="form-control" required="" placeholder="Jumlah Level 2(ex:3)">
            </div>
            <div class="form-group">
                <label>Level 4</label>
                <input type="number" name="level4" class="form-control" required="" placeholder="Jumlah Level 2(ex:3)">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success pull-right">Confirm</button>
        </div>
        <?=form_close()?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal Help -->
    <div class="modal fade" id="modal-help">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Bantuan Membuat Struktur KPI</h4>
        </div>
        <div class="modal-body">
              <ul class="timeline">
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-book bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Struktur</a></h3>

                <div class="timeline-body">
                  Memberi nama KPI(Key Performance Indicator) dan 
                  memasukan jumlah anggota tiap level yang ada pada KPI
                </div>
                <div class="timeline-footer">
                  <img style="width: 100%;height: 20%;" align="center" src="<?=base_url()?>resources/img/guide/create_structure.png">
                </div>
              </div>
            </li>
            <li>
              <i class="fa fa-list-alt bg-yellow"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Atribut</a></h3>

                <div class="timeline-body">
                  Melengkapi struktur, pemberian nama pada struktur KPI, penanggung jawab, target dan bobot
                </div>
                <div class="timeline-footer">
                  <img style="width: 100%;height: 20%;"  align="center" src="<?=base_url()?>resources/img/guide/atribut.png">
                </div>
              </div>
            </li>
            <li>
              <i class="glyphicon glyphicon-indent-left bg-red"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Relasi</a></h3>

                <div class="timeline-body">
                  Mengelola relasi yang ada (menghubungkan antara parent dan child)
                </div>
                <div class="timeline-footer">
                  <img style="width: 100%;height: 20%;"  align="center" src="<?=base_url()?>resources/img/guide/relation.png">
                </div>
              </div>
            </li>
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>   
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>