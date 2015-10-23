<br>
<?php $paginador = $this->paginator->numbers();?>
<div class="table-responsive">
		<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
				<th width='30px'></th>
				<th><div class="sort"><?php echo __('Persona');?></div></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($resultsearch as $result):?>
				<tr>
					<td><i class="glyphicon glyphicon-user"></i></td>
					<td>
					<table>
						<tr>
							<td width='300px'>
								<?php echo str_replace("\n",'<br>',$result['Contenedorb']['datos'])?>							
							</td>
							<td>
								<div class="btn-group">
									<?php foreach($buttonacces as $buttonacce):?>
									<?php echo $this->Html->link($buttonacce['Buttonuser']['buttondescr'],array('controller'=>trim($buttonacce['Buttonuser']['modelname']),
										'action'=>trim($buttonacce['Buttonuser']['actionname']),$result['Contenedorb']['id_pers']),array('escape' => false,'class'=>'btn btn-app'))?>
									<?php endforeach;?>
								</div>   
							</td>
						</tr>
					</table>
					</td>
				</tr>
			<?php
	endforeach;?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="7" class='row1'>
				<center>
				<div class="pagination">
						<?php if(!empty($paginador)): ?>						
						<center>
								<ul class="pagination">
								  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
								  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
								  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
								</ul>
							</center>
						<?php endif;?>			
						</div>
				</center>
			</td>
			</tr>
		</tfoot>
	</table>
</div>