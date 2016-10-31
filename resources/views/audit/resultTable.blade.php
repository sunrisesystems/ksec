<header class="page-header-wrapper">
	<div class="page-heading">
		<h2>Manage Audit</h2>
	</div>
	<div class="header-actions">
		<!-- <a title="Create Voice" class="btn btn-white add-user" href="{!! route('voice.create')!!}">
			<span class="icon-wrapper"><i class="fa fa-plus" aria-hidden="true"></i></span> Create Voice
		</a> -->
	</div>
</header>
@if($audit['success'])
<div class="main-container-inner">			
		@if(count($audit['data']))
		<?php 
			$auditData = $audit['data'];
		//	Lib::pr($auditData->toArray());
		?>
		<div class="table-responsive">
			<table id="drawingList" class="category table table-hover">
				<thead>
					<tr>
						<th class="center">#</th>
						<th class="center">Form</th>
						<th class="center">Id</th>
						<th class="left">Date</th>  
						<th class="left">Process</th> 
						<th class="left">Agent</th>
						<th class="left">Manager</th>
						<th class="left">Team Lead</th>
						<th class="left">Category</th>
						<th class="left">Fatal</th>
						<th class="left">Adherence</th>
						<th class="center">Quality %</th>
						<th class="center">Actions</th>
					</tr>
				</thead>
			  <?php $count = ($auditData->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
			 	?>
				<tbody>
					@foreach($audit['data'] as $key => $value)
					<tr>
						<td align="center">{!! $count++ !!}</td>
						<td align="center">{!! $value->sqForm->formname !!}</td>
						<td align="center">{!! $value->id !!}</td>
						<td align="left">{!! Lib::convertDateFormat("Y-m-d",$value->trdate,"d-M-Y") !!}</td>
						<td align="left">{!! $value->process->process !!}</td>
						<td align="left">{!! $value->agent->emp_name !!}</td>
						<td align="left">{!! $value->manager->emp_name !!}</td>
						<td align="left">{!! $value->teamLead->emp_name !!}</td>
						<td align="left">{!! $value->category->code_value !!}</td>
						@if($value->fatal == 'Y')
							<td align="left">Yes</td>
						@elseif($value->fatal == 'N')
							<td align="left">No</td>
						@else
							<td align="left"></td>
						@endif

						@if($value->adherence == 'Y')
							<td align="left">Yes</td>
						@elseif($value->adherence == 'N')
							<td align="left">No</td>
						@else
							<td align="left"></td>
						@endif

						<td align="center">{!! Lib::roundOffNumber($value->quality_per,2) !!}</td>
						<td align="center" class="action-icon">								
							<a href="{!! route('voice.edit',[$value->id]) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Audit" class="edit-user">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
						</td>
						
					</tr>
					@endforeach
				</tbody>
		  </table><!-- table end -->
		  {!! $auditData->render() !!}
		</div><!-- table responsive end -->
		@else
			<div class="alert alert-info">No Record Found</div>
		@endif
</div>
@else
<div class="alert alert-info">{!! $audit['data'] !!}</div>
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$('.pagination a').on('click', function(e){
		    e.preventDefault();
		    var url = $(this).attr('href');
		   
		    $.post(url, $('#auditForm').serialize(), function(data){
		        $("#auditTable").html(data);
		    });
		});
	})
</script>