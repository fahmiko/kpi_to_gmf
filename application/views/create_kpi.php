<div class="container" style="margin-top: 20px">
	<ul class="nav nav-tabs">
				<li class="nav-item">
					<a href="#" class="nav-link" onclick="change_header('List KPI')" id="lkpi">List KPI</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" onclick="change_header('buat KPI')" id="bkpi">Buat KPI</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" onclick="change_header('isi Skor')" id="iskor">Isi Skor</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link"><?=$this->session->userdata('username')?>/<?=$this->session->userdata('jabatan')?></a>
				</li>
			</ul>
	<div class="card bg-light mb-3" style="margin-top: 20px" id="card-list">
  		<div class="card-header" id="title">Header</div>
  		<div class="card-body">
    		<h5 class="card-title">Light card title</h5>
    		<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  		</div>
	</div>

	<div class="card bg-light mb-3" style="margin-top: 20px" id="card-create">
  		<div class="card-header" id="title">Header</div>
  		<div class="card-body">
    		<h5 class="card-title">Light card title</h5>
    		<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  		</div>
	</div>
</div>
<script type="text/javascript">
function change_header(menu){
	$('#title').html(menu);
	if(menu == "list KPI"){
		$('#lkpi').class('nav-link active');
	}else if(menu == "buat KPI"){
		$('#bkpi').class('nav-link active');
	}else if (menu == "isi Skor") {
		$('#iskor').class('nav-link active');
	}
}
</script>