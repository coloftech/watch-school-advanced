	<div class="panel">
		<div class="panel-body">
		<h4>Viewer statistics <button class="btn btn-info pull-right" id="btn_country">COUNTRY</button></h4>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Title</th>
						<th>Views</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1; foreach ($statistics as $key): ?>
					
					<tr>
						<td><?=$i?>) <a href="<?=site_url('video/info/'.$key->video_id);?>"><?=$key->title?></a></td>
						<td><?=$key->counter?></td>
					</tr>
				<?php $i++; endforeach ?>
				</tbody>
			</table>
		</div>
	</div>