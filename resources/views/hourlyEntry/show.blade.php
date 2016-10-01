@extends('layout.admin')
@section('content')
@if (Session::has('message'))
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="{!! Session::get('class') !!}">{!! Session::get('message') !!}</div>
			</div>
		</div>
	</div>
@endif
<div class="clearfix"></div>
<div id="main-container" class="main-container ">  
    <div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li>
						Production
					</li>
					<li>
						Transaction
					</li>
					<li>
						<a href="{!!URL::to('hourlyEntry')!!}">Manage Hourly Entry</a>
					</li>
					<li class="active">
						<strong>View Hourly Entry</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-10">
					<h2 class="page-header">View Hourly Entry</h2>					
				</div>
				<div class="col-lg-2">
						<h2 class="page-header"><a href="{!! Session::get('hourlyEntryShowRedirection') !!}">Back</a></h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="dailyEntry" class="form-container">
			
						<div class="form-control-wrapper" >
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('shift', 'Shift')) !!}
										{!! Form::select('shift',$result['shifts'], $result['shift'], ['id'=>'shift','class' => 'form-control','readonly'=>true]) !!}
										<div id="shift_alert" class="error validationAlert validationError"></div>
									</div>

									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('date', 'Date')) !!}
										{!! Form::text('date',$result['date'],array('class' => 'form-control','placeholder'=>'Date','id'=>'date','readonly'=>true)) !!}
										<div id="date_alert" class="error validationAlert validationError"></div>
									</div>

									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('time', 'Time')) !!}
										{!! Form::text('time',$result['time'],array('class' => 'form-control','placeholder'=>'Time','id'=>'time','readonly'=>true)) !!}
										<div id="time_alert" class="error validationAlert validationError"></div>
									</div>
								</div>
							</div>
							<!-- action wrapper -->
						</div>

				</section><!-- section Form end -->
				
				<section id="editHourlyEntryDetails" class="form-container">
					<div class="pageTableHeading">
						<div class="row ">			
							<div class="page-title">			
								<div class="col-lg-12">
									<h3 class="page-header">Hourly Entry Details</h3>					
								</div>							
							</div>			
						</div>
					</div><!-- pageTableHeading end -->
					@if($result['success'])
					
					<div class="row">
						<div class="form-control-wrapper col-md-12" >
							<div class="form-group">
								@if(!empty($result['data']))
								<?php $count = 0; ?>
								<table class="category table table-hover" id="hourlyEntryTable">
									<thead>
										<tr>
											<th>#</th>
											<th >Machine</th>
											<th width="30%">Product</th>
											<th>Cycle Time</th>
											<th>Cavity Blocks</th>
											<th>Average Weight</th>
											<th >Done</th>
										</tr>
									</thead>
									<tbody class="input_fields_wrap">
									@foreach($result['data'] as $key)
										<tr>
											<td align="right">{!! ++$count !!}</td>
											<td aligh="left">{!! $key['machine'] !!}</td>
											<td aligh="left">{!! $key['product'] !!}</td>
											<td align="right">{!! $key['cycleTime'] !!}</td>
											<td align="right">{!! $key['cavityBlock'] !!}</td>
											<td align="right">{!! $key['averageWt'] !!}</td>
											<?php if($key['isCompleted'] == 'Y') {?>
											<td align="center">Yes</td>
											<?php } else {?>
											<td align="center">No</td>
											<?php }?>
										</tr>
									@endforeach	
									</tbody>
								</table>
								@endif
							</div>							
						</div>
					</div>	
					@else
					<div class="{!! $result['class'] !!}">{!! $result['data'] !!}</div>
					@endif
				</section><!-- section Form end -->
			</div>
		</div><!-- Form row end -->
	</div><!-- page content -->
</div><!-- Container end -->
<script type="text/javascript">
	 $(document).ready(function () {
    	//$("#side-menu").hide();
    	$("body").toggleClass("mini-navbar");
       // SmoothlyMenu();
    })
</script>
@stop 