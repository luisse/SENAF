<br>

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
								<?php echo str_replace("¡retne!",'<br>',$result['Ft']['personal'])?>							
							</td>
							<td width='300px'>
								<?php echo str_replace("¡retne!",'<br>',$result['Ft']['domicilio'])?>							
							</td>
							<td>
								<div class="btn-group">
									<?php foreach($buttonacces as $buttonacce):?>
									<?php echo $this->Html->link($buttonacce['Buttonuser']['buttondescr'],array('controller'=>trim($buttonacce['Buttonuser']['modelname']),
										'action'=>trim($buttonacce['Buttonuser']['actionname']),$result['Ft']['persona_id']),array('escape' => false,'class'=>'btn btn-app'))?>
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
						<?php 
							$paginador = $this->paginator->numbers(array(
								    'before' => '',
								    'separator' => '',
								    'currentClass' => 'active',
								    'tag' => 'li',
									 'currentTag' => 'a',
								    'after' => ''));
						?>				
						<div class="pagination">
							<?php if(!empty($paginador)): ?>
							<nav>
								<ul class="pagination">
  								  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
								  <li><?php echo $paginador;?></li>
								  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
								</ul>
							</nav>
						<?php endif;?>			
						</div>
				</center>
			</td>
			</tr>
		</tfoot>
	</table>
</div>