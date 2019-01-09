<div class="container" style="margin-top: 20px">
	<table class="table table-hovered" id="example">
		<thead>
			<tr>
				<td>KPI</td>
				<td>WEIGHT</td>
				<td>PIC</td>
				<td>START</td>
				<td>FINISH</td>
				<td>ARCHIEVMENT</td>
				<td>TARGET</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kpi as $data): ?>
				<tr>
					<td><?=$data->kpi?></td>
					<td><?=$data->weight?></td>
					<td><?=$data->pic?></td>
					<td><?=$data->start_date?></td>
					<td><?=$data->finish_date?></td>
					<td><?=$data->archievment?></td>
					<td><?=$data->target?></td>
				</tr>
			<?php endforeach?>
		</tbody>
	</table>

	<a href="<?=site_url()?>welcome/create" class="btn btn-success" style="margin-top: 10px">Create KPI</a>
</div>