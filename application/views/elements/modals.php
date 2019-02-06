<script type="text/javascript">
$(document).ready(function(){
    $('#select-kpi').click(function(){
        $('#modal-select-kpi').modal().show();
    });

    <?php foreach ($tb_kpi_name as $data):?>
    	$('#select-kpi-option').append(new Option('<?=$data->kpi_name?>', '<?=$data->kpi_name?>', true));
    <?php endforeach;?>
    
});
</script>