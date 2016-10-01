<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">Machine/Product Wise Details</h3>
				<h5 class="page-header">Shift Timing : {!!  $result["shiftTiming"]["startDate"] ." to " .$result["shiftTiming"]["endDate"]!!}</h5>					
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
								<th class="right">Shot Counter</th> 
								<th class="right">Shot Counter timer</th>
								<th class="right">Purging</th>
								<th class="right">Plan Id</th>
								<th class="right">Production Quantity</th>
								<th class="right">Total Downtime</th>								
								<th class="right">Total Rejection</th>
								<th class="center">Done</th>
							</tr>
						</thead>
					 	
						<tbody>		
							@foreach($result['data'] as $key)			
							<tr>
								<td align="right">{!! ++$count !!}</td>
								<td aligh="left">{!! $key['machine'] !!}</td>
								<td aligh="left">{!! $key['product'] !!}</td>
								<td align="right">{!! $key['endShortCounter'] !!}</td>
								<td align="right">{!! $key['shortCounterTime'] !!}</td>
								<td align="right">{!! $key['purging'] !!}</td>
								<td align="right">{!! $key['planId'] !!}</td>
								<td align="right">{!! $key['productionQuantity'] !!}</td>
								<td align="right">{!! $key['totalDowntime'] !!}</td>
								<td align="right">{!! $key['totalRejection'] !!}</td>
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