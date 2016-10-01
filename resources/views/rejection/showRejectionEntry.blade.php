<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">Rejection Slip</h3>
			</div>	
			<div class="clear"></div>						
		</div>			
	</div>
</div><!-- pageTableHeading end -->
		<div class="row">
			<div class="col-xs-12">
			@if(!empty($result['data']))	
			<?php $count = 0; 
			?>	
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th class="left">Color</th>
								<th class="left">Quantity Received By Store</th>  
								<th class="left">Quantity as Per QC</th> 							
								<th class="center">Done</th>
							</tr>
						</thead>
					 	
						<tbody>		
							@foreach($result['data'] as $key)			
							<tr>
								<td align="right">{!! ++$count !!}</td>
								<td aligh="left">{!! $key['color'] !!}</td>
								<td aligh="left">{!! $key['qtyRecievedByStore'] !!}</td>
								<td align="left">{!! $key['qtyAsPerQc'] !!}</td>
								<?php if($key['isCompleted'] == 'Y') {?>
								<td align="center">Yes</td>
								<?php } else {?>
								<td align="center">No</td>
								<?php }?>
							</tr>
							@endforeach											
						</tbody>
				  </table><!-- table end -->
				 
				</div><!-- table responsive end -->
			@else
			<div class="alert alert-info">No record found</div>	
			@endif
			</div>
		</div>