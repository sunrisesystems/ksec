<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">FG Return Slip</h3>
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
								<th class="left">Machine</th>
								<th class="left">Product</th>  
								<th class="right">Production Quantity</th> 
								<th class="right">Box Type</th>
								<th class="right">Type of Packing</th>
								<th class="right">Quantity Per Box</th>
								<th class="right">Box Received</th>
								<th class="right">Quantity Received</th>								
								<th class="right">Partial Quantity</th>								
								<th class="center">Done</th>
							</tr>
						</thead>
					 	
						<tbody>		
							@foreach($result['data'] as $key)			
							<tr>
								<td align="right">{!! ++$count !!}</td>
								<td aligh="left">{!! $key['machine'] !!}</td>
								<td aligh="left">{!! $key['product'] !!}</td>
								<td align="right">{!! $key['productionQuantity'] !!}</td>
								<td align="right">{!! $key['typeOfBox'] !!}</td>
								<td align="right">{!! $key['typeOfPacking'] !!}</td>
								<td align="right">{!! $key['quantityPerBox'] !!}</td>
								<td align="right">{!! $key['boxReceived'] !!}</td>
								<td align="right">{!! $key['quantityReceived'] !!}</td>
								<td align="right">{!! $key['partialQuantity'] !!}</td>
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