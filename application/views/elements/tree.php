<?php
$treekpi['kpi'] = array (
    'description' => @$this->session->userdata('dashboard'),
    'children' => array ()
  );
$i = 0;
$row_lv2 = 0;
$row_lv3 = 0;
foreach ($kpi1 as $data) {
    $treekpi['kpi']['children'] += array (
        $i => array (
        'description' => $data['kpi'],
        'children' => 
        array (),
      ),
    );
    $i++;
    $row_lv2++;
}

for($i=0;$i<$row;$i++){
    $parent = $kpi1[$i]['kpi'];
    if($this->db->where('kpi_parent',$parent)->get('tb_kpi_structure')->num_rows()!=0){
        $result = $this->db->where('kpi_parent',$parent)->get('tb_kpi_structure')->result();
        $j = 0;
        foreach ($result as $data) {
            $treekpi['kpi']['children'][$i]['children'] += array (
                $j => array (
                'description' => $data->kpi,
                'children' => 
                array (),
              ),
            );
            $j++;
            $row_lv3++;
        }
    }
}

for($i = 0;$i < $row_lv2;$i++){
    $num = count($treekpi['kpi']['children'][$i]['children']);
    for($j = 0; $j < $num;$j++){
        $parent = $treekpi['kpi']['children'][$i]['children'][$j]['description'];
        $result = $this->db->where('kpi_parent',$parent)->get('tb_kpi_structure');
        if($result->num_rows()!=0){
            $k = 0;
            foreach ($result->result() as $data) {
                $treekpi['kpi']['children'][$i]['children'][$j]['children'] += array (
                    $k => array (
                    'description' => $data->kpi,
                    'children' => 
                    array (),
                  ),
                );
                $k++;
            }
        }
    }
}
?>

<!-- jQuery Line plugin : https://github.com/tbem/jquery.line -->
<script src="<?=base_url()?>resources/assets/js/jquery.line.js" type="text/javascript"></script>
<!-- jQuery HorTree plugin : https://github.com/alesmit/jquery-hortree -->
<script src="<?=base_url()?>resources/assets/js/jquery.hortree.min.js" type="text/javascript"></script>
<script type="text/javascript">
    // $(selector).line(x1, y1, x2, y2, options);
    (function () {
        var data = [<?=json_encode($treekpi['kpi'])?>];
        $('#my-container').hortree({
            data: data
        });

    })();

</script>
