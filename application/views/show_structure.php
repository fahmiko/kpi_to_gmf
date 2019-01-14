<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HorTree - jQuery Horizontal Hierarchical Tree</title>
    <link rel="stylesheet" href="../dist/jquery.hortree.css">
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

echo json_encode($treeData['tree']);

?>

<div id="my-container"></div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>

<!-- jQuery Line plugin : https://github.com/tbem/jquery.line -->
<script src="jquery.line.js" type="text/javascript"></script>

<!-- jQuery HorTree plugin : https://github.com/alesmit/jquery-hortree -->
<script src="../dist/jquery.hortree.min.js" type="text/javascript"></script>

<script type="text/javascript">

    (function () {
        var data = [<?=json_encode($treeData['tree'])?>];
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