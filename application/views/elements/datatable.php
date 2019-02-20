
<!-- DataTables -->
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
} );


/* Formatting function for row details - modify as you need */

function format (d) {
    // `d` is the original data object for the row
    var table = "<table class='table' id='dt_detail_"+d+"'>"+
    	"<tr><thead>"+
    		"<th></th>"+
    		"<th>KPI</th>"+
    		"<th>Actual</th>"+
    		"<th>Archievment</th>"+
    	"</tr></thead>";
    // for(i = 0;i < d.length; i++){
    // 	table += "<tr>"+
    // 		"<td><i class='fa fa-plus'></i></td>"+
    // 		'<td>'+d[i]['kpi']+'</td>'+
    // 		'<td>'+d[i]['weight']+'</td>'+
    // 		'<td>'+d[i]['target']+'</td>'+
    // 	"</tr>";
    // }
    table += "</table>";
    return table;
}

function format2(d){
	var table;
	if(d.length == 0){
		// table = "";
        alert("NO DATA");
	}else{
	table = "<table class='table' cellspacing='0' border='0'>";
    for(i = 0;i < d.length; i++){
    	table += "<tr>"+
    		'<td width="6%"></td>'+
            '<td width="24.5%">'+d[i]['kpi']+'</td>'+
            '<td width="20%"></td>'+
            '<td width="18.5%">'+d[i]['actual']+'</td>'+
    		'<td>'+d[i]['arcv']+' %'+'</td>'+
    	"</tr>";
    }
    table += "</table>";
	}
    return table;
}

var tableCounter = 0;

$(document).ready(function() {
    var table = $('#dt_score').DataTable( {
        "ajax": "<?=site_url()?>gmf/json_score",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "kpi" },
            { "data": "weight" },
            { "data": "target" },
            { "data": "actual" },
            { "data": "arcv", render: $.fn.dataTable.render.number(',', '.', 2, ' ', ' %')}
        ],
        "order": [[1, 'asc']],
    } );
     
    // Add event listener for opening and closing details
    $('#dt_score tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            var dtTable = [];
            $.ajax({
    			url: "<?php echo site_url('gmf/json_score_tree')?>",
    			dataType: "JSON",
    			type: "POST",
    			data:{
        			id: row.data().kpi,
    			},success: function(json){
    				$.each(json, function(key, value){
        				dtTable.push({weight: value['weight'],target: value['target'],kpi: value['kpi'],actual: value['actual'],arcv: value['arcv']});
    				});

                    if(json.length == 0){
                        alert('NO DATA');
                    }else{
    				row.child(format(tableCounter)).show();
            		tr.addClass('shown');

            		childTable = $('#dt_detail_' + tableCounter).DataTable( {
            			data : dtTable,
            			'paging'      : false,
      					'lengthChange': false,
      					'searching'   : false,
      					'ordering'    : false,
      					'info'        : false,
      					'autoWidth'   : false,
    				    "columns" : [
    				    {
                				"className":      'details-control1',
                				"orderable":      false,
                				"data":           null,
                				"defaultContent": ''
            				},
    				    	{ data:'kpi' },
                   			{ data: "actual" },
            				{ data: "arcv", render: $.fn.dataTable.render.number(',', '.', 2, ' ', ' %')}
    				    ]
    				} );

    				$('#dt_detail_' + tableCounter + ' tbody').on('click', 'td.details-control1', function () {
        				var tr = $(this).closest('tr');
        				var row = childTable.row( tr );

        				if (row.child.isShown() ) {
        				    // This row is already open - close it
        				    row.child.hide();
        				    tr.removeClass('shown');
        				}else{
        					var dtTable2 = [];
            					$.ajax({
    								url: "<?php echo site_url('gmf/json_score_tree')?>",
    								dataType: "JSON",
    								type: "POST",
    								data:{
        								id: row.data().kpi,
    								},success: function(json){
    									$.each(json, function(key, value){
        									dtTable2.push({weight: value['weight'],target: value['target'],kpi: value['kpi'],actual: value['actual'],arcv: value['arcv']});
    									});
    									row.child(format2(dtTable2)).show();
            							tr.addClass('shown');
    								}
    							});
        				}
        			});
    				tableCounter++;
    			}
            }
    		});
        }
    } );
} );
</script>