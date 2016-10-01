<?php use Sunpet\Libraries\Lib; ?>
@if(count($planning))			
	<div class="table-responsive">
		<table id="drawingList" class="category table table-hover">
			<thead>
				<tr>
					<th class="right">#</th>
					<th class="left">Machine Name</th>
					<th class="left">Start Date Time</th> 
					<th class="left">End Date Time</th>
					<th class="center">Status</th>
				</tr>
			</thead>
		  	<?php $count = 1;?>
			<tbody>
			@foreach($planning as $key)
				<tr>
					<td align="right">{!! $count++ !!}</td>
					<td>{!! $machine[$key->machine_id] !!}</td>
					<td>{!! Lib::convertDateFormat("Y-m-d H:i:s",$key->start_date_time,"d-m-Y H:i") !!}</td>
					<td>{!!  Lib::convertDateFormat("Y-m-d H:i:s",$key->end_date_time,"d-m-Y H:i") !!}</td>
					<td align="center" class="status">
						@if($key->status == 'P')
						<span class="label-status label-warning-active">planned</span>
						@elseif ($key->status == 'R')
						<span class="label-status label-warning-running">running</span>
						@else
						<span class="label-status label-warning-inactive">inactive</span>
						@endif
					</td>								
				</tr>
			@endforeach						
			</tbody>
	  </table><!-- table end -->	
	</div><!-- table responsive end -->	
@endif	
