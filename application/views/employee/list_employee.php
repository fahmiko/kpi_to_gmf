<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Employee
      <small>List Employee</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Employee</li>
    </ol>
  </section>
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if(validation_errors()){?>
      <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?=validation_errors()?>
      </div>
      <?php } 
      if($this->session->flashdata('alert_success')!=null){?>
      <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?=$this->session->flashdata('alert_success')?>
      </div>
      <?php }
      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pegawai</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a class="btn btn-default" style="margin-bottom: 10px" onclick="create()"><span class="fa fa-plus"></span> Pegawai</a>
              <table id="dt_employee" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="40px">Action</th>
                  <th>ID Pegawai</th>
                  <th>Nama Pegawai</th>
                  <th>Jabatan</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($employee as $data):?>
                    <tr>
                      <td align="center">
                        <a href="#" onclick="edit_employee('<?=$data->id_pegawai?>','<?=$data->nama?>','<?=$data->jabatan?>')"><span class="fa fa-pencil"></span></a>
                        <a href="#" onclick="delete_employee('<?=$data->id_pegawai?>','<?=$data->nama?>','<?=$data->jabatan?>')"><span class="fa fa-trash"></span></a>
                      </td>
                      <td><?=$data->id_pegawai?></td>
                      <td><?=$data->nama?></td>
                      <td><?=$data->jabatan?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
  </section>
</div>
<?=form_open('gmf/manage_employee')?>
<div class="modal fade" id="employee-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="md-title"></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>ID Pegawai</label>
            <input type="text" name="id_pegawai" id="id_pegawai" class="form-control" placeholder="Employee ID">
        </div>
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Employee Name">
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" class="form-control" readonly="" id="jabatan-text">
            <select name="jabatan" class="form-control" id="jabatan-select">
              <option value="VP">VP</option>
              <option value="GM">GM</option>
              <option value="Manager">Manager</option>
              <option value="Staff">Staff</option>
            </select>
        </div>
        <div class="form-group" id="lb_password">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required="" placeholder="Password">
          </div>
      </div>
      <input type="hidden" name="manage" id="manage">
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" id="btn-manage">Save changes</button>
      </div>
    </div>
    <?=form_close()?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  function create(){
    $("#md-title").html("Create Pegawai");
    $("#btn-manage").html("Create");
    // Insert Value to text box
    document.getElementById('id_pegawai').value =  "";
    document.getElementById('nama').value =  "";
    document.getElementById('manage').value =  "insert";
    $('#id_pegawai').prop('readonly', false);
    $('#nama').prop('readonly', false);
    // Change Option text
    $("#user_information").show();
    $("#jabatan-text").hide();
    $("#jabatan-select").show();
    $("#lb_password").show();
    // change CSS 
    $("#employee-modal").removeClass();
    $("#btn-manage").removeClass();
    $("#employee-modal").addClass('modal fade');
    $("#btn-manage").addClass('btn btn-success');
    $("#employee-modal").modal({show: true}); 
  }

  function edit_employee(id, name, pos){
     $("#md-title").html("Edit Pegawai");
     $("#btn-manage").html("Update");
     // Change Option text
     document.getElementById('id_pegawai').value =  id;
     document.getElementById('nama').value =  name;
     document.getElementById('manage').value =  "update";
     $('#id_pegawai').prop('readonly', true);
     $('#nama').prop('readonly', false);
     // Change Option text
     $("#jabatan-text").hide();
     $("#jabatan-select").show();
     $("#lb_password").hide();
     // change CSS 
     $("#employee-modal").removeClass();
     $("#btn-manage").removeClass();
     $("#employee-modal").addClass('modal fade');
     $("#btn-manage").addClass('btn btn-info');
     $("#employee-modal").modal({show: true});
  }

  function delete_employee(id, name, pos){
     $("#md-title").html("Delete Pegawai");
     // Insert Value to text box
     document.getElementById('id_pegawai').value =  id;
     document.getElementById('nama').value =  name;
     document.getElementById('jabatan-text').value =  pos;
     document.getElementById('manage').value =  "delete";
     // Change Option text
     $('#id_pegawai').prop('readonly', true);
     $('#nama').prop('readonly', true);
     $("#jabatan-text").show();
     $("#jabatan-select").hide();
     $("#lb_password").hide();
     // change CSS 
     $("#employee-modal").removeClass();
     $("#employee-modal").addClass('modal modal-danger fade');
     $("#btn-manage").removeClass();
     $("#btn-manage").addClass('btn btn-danger');
     $("#btn-manage").html("Delete");
     $("#employee-modal").modal({show: true});
  }
  
</script>