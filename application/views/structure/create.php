<?php
  $structure = $this->session->userdata('structure');
  $login = $this->session->userdata('login');
  echo form_open('gmf/insert_structure');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Structure
        <small>Create Structure</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#" data-toggle="modal" data-target="#modal-help"><i class="fa fa-info-circle"></i> Bantuan</a></li>
      </ol>
    </section>
        <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">KPI Level 2</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
            <!-- /.box-header -->
            <?php for($i=0;$i<$structure['level2'];$i++){?>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>KPI</label>
                      <input type="text" class="form-control" id="kpi_lv2_<?=$i?>" name="kpi_lv2_<?=$i?>" placeholder="Nama KPI(ex : Assets Manajemen)" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Target</label>
                      <input type="text" class="form-control" name="target_lv2_<?=$i?>" placeholder="Target(ex : 60)" required="" min="1" max="100">
                    </div>  
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>PIC</label>
                        <select class="form-control" name="pic_lv_2_<?=$i?>">
                          <?php foreach ($pic as $data) : ?>
                              <option value="<?=$data->id_pegawai?>"><?=$data->nama?>(<?=$data->jabatan?>)</option>
                          <?php endforeach ?>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Bobot</label>
                        <input type="text" class="form-control" id="precentage1<?=$i?>" name="weight_lv2_<?=$i?>" placeholder="Bobot(ex : 4.5%)" required="">
                      </div>
                  </div>
                </div>

              <hr>
              </div>
            <?php } ?>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title">KPI Level 3</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
            <!-- /.box-header -->
            <?php for($i=0;$i<$structure['level3'];$i++){?>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>KPI</label>
                      <input type="text" class="form-control" id="kpi_lv3_<?=$i?>" name="kpi_lv3_<?=$i?>" placeholder="Nama KPI(ex : Assets Manajemen)" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Target</label>
                      <input type="text" class="form-control" name="target_lv3_<?=$i?>" placeholder="Target(ex : 60)" required="" min="1" max="100">
                    </div>  
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>PIC</label>
                        <select class="form-control" name="pic_lv_3_<?=$i?>">
                          <?php foreach ($pic as $data) : ?>
                              <option value="<?=$data->id_pegawai?>"><?=$data->nama?>(<?=$data->jabatan?>)</option>
                          <?php endforeach ?>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Bobot</label>
                        <input type="text" class="form-control" id="precentage2<?=$i?>" name="weight_lv3_<?=$i?>" placeholder="Bobot(ex : 4.5%)" required="">
                      </div>
                  </div>
                </div>

              <hr>
              </div>
            <?php } ?>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">KPI Level 4</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
            <!-- /.box-header -->
            <?php for($i=0;$i<$structure['level4'];$i++){?>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>KPI</label>
                      <input type="text" class="form-control" id="kpi_lv4_<?=$i?>" name="kpi_lv4_<?=$i?>" placeholder="Nama KPI(ex : Assets Manajemen)" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Target</label>
                      <input type="text" class="form-control" name="target_lv4_<?=$i?>" placeholder="Target(ex : 60)" required="" min="1" max="100">
                    </div>  
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>PIC</label>
                        <select class="form-control" name="pic_lv_4_<?=$i?>">
                          <?php foreach ($pic as $data) : ?>
                              <option value="<?=$data->id_pegawai?>"><?=$data->nama?>(<?=$data->jabatan?>)</option>
                          <?php endforeach ?>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Bobot</label>
                        <input type="text" class="form-control" id="precentage3<?=$i?>" name="weight_lv4_<?=$i?>" placeholder="Bobot(ex : 4.5%)" required="">
                      </div>
                  </div>
                </div>

              <hr>
              </div>
            <?php } ?>
          </div>
          <a data-toggle="modal" data-target="#manageModal" class="btn btn-success" onclick="generate()" style="color: white;"><i class="fa fa-bars"></i> Manage</a>
          <!-- /.box -->
        </div>
      </div>

    </section>

  </div>
  <div class="modal fade" id="manageModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 5px">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Buat Struktur KPI</h4>
        </div>
        <div class="modal-body">
           <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">KPI</a></li>
                <li role="presentation"><a href="#tb_lv_2" aria-controls="tb_lv_2" role="tab" data-toggle="tab">Level 2</a></li>
                <li role="presentation"><a href="#tb_lv_3" aria-controls="tb_lv_3" role="tab" data-toggle="tab">Level 3</a></li>
                <li role="presentation"><a href="#tb_lv_4" aria-controls="tb_lv_4" role="tab" data-toggle="tab">Level 4</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content"><br>
                <div role="tabpanel" class="tab-pane active" id="home">
                  <div class="form-group">
                    <label>KPI</label>
                    <input type="text" class="form-control" readonly="" value="<?=$structure['kpi_name']?>">
                  </div>
                  <div class="form-group">
                    <label>Created By</label>
                    <input type="hidden" name="created" value="<?=$login['id_pegawai']?>">
                    <input type="text" class="form-control" placeholder="Nama KPI(ex : Assets Manajemen)" value="<?=$login['nama']?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Formula</label>
                    <select name="formula" class="form-control">
                      <option value="arcv">YTD = Menambahkan</option>
                      <option value="avg">TYD = Mempertahankan</option>
                    </select>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tb_lv_2"><br>
                    <div class="row" style="margin-left: 30px">
                      <?php for($i = 0;$i < $structure['level2'];$i++){ ?>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>KPI</label>
                            <input type="text" class="form-control" readonly="" id="svalue_lv2_<?=$i?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" placeholder="catatan...." name="remarks_lv_2_<?=$i?>"></textarea>
                          </div>
                      </div>
                    <?php } ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tb_lv_3"><br>
                    <div class="row">
                      <?php for($i = 0;$i < $structure['level3'];$i++){ ?>
                      <div class="col-md-2">
                           <div class="form-group">
                            <label>Parent</label>
                            <select class="form-control" id="parent_lv_3_<?=$i?>" name="parent_lv3_<?=$i?>" style="max-width: 150px">
                              <!-- Auto Generate dari Javascript -->
                            </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>KPI</label>
                            <input type="text" class="form-control" readonly="" id="svalue_lv3_<?=$i?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" placeholder="catatan...." name="remarks_lv_3_<?=$i?>"></textarea>
                          </div>
                      </div>
                    <?php } ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tb_lv_4"><br>
                    <div class="row">
                      <?php for($i = 0;$i < $structure['level4'];$i++){ ?>
                      <div class="col-md-2">
                           <div class="form-group">
                            <label>Parent</label>
                            <select class="form-control" id="parent_lv_4_<?=$i?>" name="parent_lv4_<?=$i?>" style="max-width: 150px">
                              <!-- Auto Generate dari Javascript -->
                            </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>KPI</label>
                            <input type="text" class="form-control" readonly="" id="svalue_lv4_<?=$i?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" placeholder="catatan...." name="remarks_lv_4_<?=$i?>"></textarea>
                          </div>
                      </div>
                    <?php } ?>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Confirm</button>
        </div>
        <?=form_close()?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<script type="text/javascript">
function generate(){
  //Lv 2 Sructure KPI
  <?php
    for($i = 0; $i < $structure['level2']; $i++){?>
      document.getElementById('svalue_lv2_<?=$i?>').value =  $('#kpi_lv2_<?=$i?>').val();
    <?php }
  ?>
  // Clear Option
  <?php
    for($i = 3; $i <=4; $i++){
      $lv = "level".$i;
      for($j = 0; $j < $structure[$lv];$j++){?>
        document.getElementById("parent_lv_<?=$i?>_<?=$j?>").options.length=0;<?php
      }
    }

  // Lv 3 Structure
    for($i = 0; $i < $structure['level3']; $i++){?>
      document.getElementById('svalue_lv3_<?=$i?>').value =  $('#kpi_lv3_<?=$i?>').val();<?php
      for($j = 0; $j < $structure['level2']; $j++){?>
        $('#parent_lv_3_<?=$i?>').append(new Option($('#kpi_lv2_<?=$j?>').val(), $('#kpi_lv2_<?=$j?>').val(), true));
      <?php }
    }
  ?>
  // Lv 4 structure
  <?php
    for($i = 0; $i < $structure['level4']; $i++){?>
      document.getElementById('svalue_lv4_<?=$i?>').value =  $('#kpi_lv4_<?=$i?>').val();<?php
      for($j = 0; $j < $structure['level3']; $j++){?>
        $('#parent_lv_4_<?=$i?>').append(new Option($('#kpi_lv3_<?=$j?>').val(), $('#kpi_lv3_<?=$j?>').val(), true));
      <?php }
    }
  ?>
}
</script>