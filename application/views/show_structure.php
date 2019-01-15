<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HorTree - jQuery Horizontal Hierarchical Tree</title>
    <link rel="stylesheet" href="<?=base_url()?>resources/assets/css/jquery.hortree.css">
</head>
<body>
<?php
$treeData = array (
  'tree' => 
  array (
    'description' => 'Element 2',
    'children' => 
    array (
      0 => 
      array (
        'description' => 'Element 2.1 with tooltip',
        'tooltip' => 'Hey I\'m a tooltip',
        'children' => 
        array (
        ),
      ),
      1 => 
      array (
        'description' => 'Element 2.2',
        'children' => 
        array (
        ),
      ),
    ),
  ),
);

// echo json_encode($treeData['tree']);
$treekpi['kpi'] = array (
    'description' => 'KPI 2019',
    'children' => array ()
  );
$i = 0;
foreach ($kpi as $data) {
    $treekpi['kpi']['children'] += array (
        $i => array (
        'description' => $data['kpi'],
        'tooltip' => 'Hey I\'m a tooltip',
        'children' => 
        array (),
      ),
    );
    $i++;
}

for($i=0;$i<$row;$i++){
    $parent = $kpi[$i]['kpi'];
    
    if($this->db->where('kpi_parent',$parent)->get('tb_kpi_structure')->num_rows()!=0){
        $result = $this->db->where('kpi_parent',$parent)->get('tb_kpi_structure')->result();
        $j = 0;
        foreach ($result as $data) {
            $treekpi['kpi']['children'][$i]['children'] += array (
                $j => array (
                'description' => $data->kpi,
                'tooltip' => 'Hey I\'m a tooltip',
                'children' => 
                array (),
              ),
            );
            $j++;
        }
    }
}
echo array_search("KPI 2019", $treekpi,true);
for($i=0;$i<$row2;$i++){
    $parent = $kpi2[$i]['kpi'];
    
    if($this->db->where('kpi_parent',$parent)->get('tb_kpi_structure')->num_rows()!=0){
        $result = $this->db->where('kpi_parent',$parent)->get('tb_kpi_structure')->result();
        $j = 0;
        foreach ($result as $data) {
            $treekpi['kpi']['children'][$i]['children'] += array (
                $j => array (
                'description' => $data->kpi,
                'tooltip' => 'Hey I\'m a tooltip',
                'children' => 
                array (),
              ),
            );
            $j++;
        }
    }
}
// print_r($treekpi['kpi']['children']);

?>

<div id="my-container"></div>
<?php
// echo json_encode($treekpi['kpi']['children'][2]);

?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>

<!-- jQuery Line plugin : https://github.com/tbem/jquery.line -->
<script src="<?=base_url()?>resources/assets/js/jquery.line.js" type="text/javascript"></script>

<!-- jQuery HorTree plugin : https://github.com/alesmit/jquery-hortree -->
<script src="<?=base_url()?>resources/assets/js/jquery.hortree.min.js" type="text/javascript"></script>

<script type="text/javascript">

    (function () {
        var data = [<?=json_encode($treekpi['kpi'])?>];
        var data2 = [
            {
                description: "Element ROOT",
                children: [
                    {
                        description: "Element 1",
                        children: [
                            {
                                description: "Element 1.1",
                                children: []
                            },
                            {
                                description: "Element 1.2",
                                children: [
                                    {
                                        description: "Element 1.2.1",
                                        children: []
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        description: "Element 2",
                        children: [
                            {
                                description: "Element 2.1 with tooltip",
                                tooltip: "Hey I'm a tooltip",
                                children: []
                            },
                            {
                                description: "Element 2.2",
                                children: []
                            }
                        ]
                    },
                    {
                        description: "Element 3",
                        children: [
                            {
                                description: "Element 3.1",
                                children: []
                            },
                            {
                                description: "Element 3.2",
                                children: []
                            },
                            {
                                description: "Element 3.3",
                                children: [
                                    {
                                        description: "Element 3.3.1",
                                        children: []
                                    },
                                    {
                                        description: "Element 3.3.2",
                                        children: []
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ];

        $('#my-container').hortree({
            data: data
        });

    })();

</script>

</body>
</html>