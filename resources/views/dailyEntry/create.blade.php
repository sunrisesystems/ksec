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
						Manage Daily Entry
					</li>
					<li class="active">
						<strong>Add/Edit Daily Entry</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add/Edit Daily Entry</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="dailyEntry" class="form-container">
					{!! Form::open() !!}
						<div class="form-control-wrapper" >
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('date', 'Date <small class="mandatory">*</small>')) !!}
										{!! Form::text('date',null,array('class' => 'form-control','placeholder'=>'Date','id'=>'date')) !!}
										<div id="date_alert" class="error validationAlert validationError">{!!$errors->first('date_no')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('shift', 'Shift <small class="mandatory">*</small>')) !!}
										{!! Form::select('shift', ['shift 1', 'shift 2', 'shift 3'], null, ['id'=>'shift','class' => 'form-control']) !!}
										<div id="shift_alert" class="error validationAlert validationError">{!!$errors->first('shift')!!}</div>
									</div>
								</div>
							</div>
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
									{!! Form::button('Load all machines', ['class' => 'btn btn-red','onclick'=>'loadAllMachines()']) !!} 
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</section><!-- section Form end -->
				
				
				
				<section id="machineDetails" class="form-container">
					<div class="pageTableHeading">
						<div class="row ">			
							<div class="page-title">			
								<div class="col-lg-12">
									<h3 class="page-header">Machine/Product Wise Details</h3>					
								</div>							
							</div>			
						</div>
					</div><!-- pageTableHeading end -->
					{!! Form::open() !!}
						<div class="row">
						<div class="form-control-wrapper col-md-12" >
							<div class="form-group table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th width="20%">Machine</th>
											<th width="20%">Product</th>
											<th>Short Counter</th>
											<th>Short Counter timer</th>
											<th>Purging</th>
											<th>Plan Id</th>
											<th>Production Quantity</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
											{!! Form::text('machine',null,array('class' => 'form-control','placeholder'=>'Machine','id'=>'machine')) !!}
											<div id="machine_alert" class="error validationAlert validationError">{!!$errors->first('machine')!!}</div>
											</td>
											<td>
											{!! Form::text('product',null,array('class' => 'form-control','placeholder'=>'Product','id'=>'product')) !!}
											<div id="product_alert" class="error validationAlert validationError">{!!$errors->first('product')!!}</div>
											</td>
											<td>
											{!! Form::text('shortCounter',null,array('class' => 'form-control','placeholder'=>'Short Counter','id'=>'shortCounter')) !!}
											<div id="shortCounter_alert" class="error validationAlert validationError">{!!$errors->first('shortCounter')!!}</div>
											</td>
											<td>
											{!! Form::text('shortCounterTimer',null,array('class' => 'form-control','placeholder'=>'Short Counter timer','id'=>'shortCounterTimer')) !!}
											<div id="shortCounterTimer_alert" class="error validationAlert validationError">{!!$errors->first('shortCounterTimer')!!}</div>
											</td>
											<td>
											{!! Form::text('purging',null,array('class' => 'form-control','placeholder'=>'Purging','id'=>'purging')) !!}
											<div id="purging_alert" class="error validationAlert validationError">{!!$errors->first('purging')!!}</div></td>
											<td>
											{!! Form::text('planId',null,array('class' => 'form-control','placeholder'=>'Plan Id','id'=>'planId')) !!}
											<div id="planId_alert" class="error validationAlert validationError">{!!$errors->first('planId')!!}</div>
											</td>
											<td>
											{!! Form::text('productionQuantity',null,array('class' => 'form-control','placeholder'=>'Production Quantity','id'=>'productionQuantity')) !!}
											<div id="productionQuantity_alert" class="error validationAlert validationError">{!!$errors->first('productionQuantity')!!}</div>
											</td>
											<td align="center" class="action-icon action-buttons">
												<button title="Rejection" type="button" class="rejection" data-toggle="modal" data-target="#addRejection">
													<i class="glyphicon glyphicon-thumbs-down"></i>
												</button>
												<button title="Downtime" type="button" class="downtime" data-toggle="modal" data-target="#addDowntime">
													<i class="glyphicon glyphicon-warning-sign"></i>
												</button>
												<!-- Button trigger modal -->
											</td>
										</tr>
										
										
									</tbody>
								</table>
							</div>							
						</div>
						<!-- action wrapper -->
						<div class="form-group action">
							<div class="col-lg-12 pull-center buttons"> 
								{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
							</div>
						</div>
						</div>
						</div>
					{!! Form::close() !!}
				</section><!-- section Form end -->
			</div>
		</div><!-- Form row end -->
	</div><!-- page content -->
</div><!-- Container end -->

<!-- Add Rejection Modal -->
<div class="modal custom-modal-form fade" id="addRejection" tabindex="-1" role="dialog" aria-labelledby="addRejectionLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="addRejectionLabel">Add Rejection</h3>
			</div>
			<div class="modal-body">
				<section id="addRejectionForm" class="form-container modal-form">
					{!! Form::open() !!}
						<div class="row" >
							<div class="form-control-wrapper col-md-12" >
								<div class="form-group table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr class="row">
												<th class="col-md-4">Rejection</th>
												<th class="col-md-2" >Qty</th>
												<th class="col-md-5">Commment</th>
												<th class="col-md-1">Add</th>					
											</tr>
										</thead>
										<tbody class="input_fields_wrap">
											<tr class="row">
												<td class="col-md-4">
												{!! Form::select('rejection', ['rejection 1', 'rejection 2', 'rejection 3'], null, ['id'=>'rejection','class' => 'form-control']) !!}
												</td>
												<td class="col-md-2">
												{!! Form::text('qty',null,array('class' => 'form-control','placeholder'=>'qty','id'=>'qty')) !!}
												</td>
												<td class="col-md-5">
												{!! Form::text('comment',null,array('class' => 'form-control','placeholder'=>'Comment','id'=>'comment')) !!}
												</td>
												<td class="col-md-1	add-more-btn">
												<a href="javascript:void(0)" class="add_field_button btn btn-default"><i class="glyphicon glyphicon-plus"></i></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</section><!-- section Form end -->
			</div>			
		</div>
	</div>
</div>


<!-- Add Downtime Modal -->
<div class="modal custom-modal-form fade" id="addDowntime" tabindex="-1" role="dialog" aria-labelledby="addDowntimeLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="addDowntimeLabel">Add Downtime</h3>
			</div>
			<div class="modal-body">
				<section id="addDowntimeForm" class="form-container modal-form">
					{!! Form::open() !!}
						<div class="row" >
							<div class="form-control-wrapper col-md-12" >
								<div class="form-group table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr class="row">
												<th class="col-md-2">Subreason</th>
												<th class="col-md-2" >Start time</th>
												<th class="col-md-2">End time</th>
												<th class="col-md-3">Comment</th>
												<th class="col-md-2">Add</th>					
											</tr>
										</thead>
										<tbody class="input_fields_wrapDT">
											<tr class="row">
												<td class="col-md-2">
												{!! Form::select('subreason', ['subreason 1', 'subreason 2', 'subreason 3'], null, ['id'=>'subreason','class' => 'form-control']) !!}
												<div id="subreason_alert" class="error validationAlert validationError">{!!$errors->first('subreason')!!}</div>
												</td>
												<td class="col-md-2">
												{!! Form::text('start_time',null,array('class' => 'form-control pickTime','placeholder'=>'Start Time','id'=>'start_time')) !!}
												<div id="start_time_alert" class="error validationAlert validationError">{!!$errors->first('start_time')!!}</div>
												</td>
												<td class="col-md-2">
												{!! Form::text('end_time',null,array('class' => 'form-control pickTime','placeholder'=>'End Time','id'=>'end_time')) !!}
												<div id="end_time_alert" class="error validationAlert validationError">{!!$errors->first('end_time')!!}</div>
												</td>
												<td class="col-md-3">
												{!! Form::text('comment',null,array('class' => 'form-control','placeholder'=>'Comment','id'=>'comment')) !!}
												<div id="comment_alert" class="error validationAlert validationError">{!!$errors->first('comment')!!}</div>
												</td>
												<td class="col-md-2	add-more-btn">
													<a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-plus"></i></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</section><!-- section Form end -->
			</div>			
		</div>
	</div>
</div>



<script type="text/javascript">
	var moldTradeName = '';
    function validateMold()
    {
        return true;
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'neck_size';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_neck_size")?>';
        i++;

        arrElemId[i]    = 'status';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_status")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

 	function redirectUrl () {
    	doCancel("{!! URL::to('dailyEntry') !!}")
    }
</script>
<script type="text/javascript">
	$(document).ready(function(){
		
		// Add Rejection multiple
		var max_fields      = 10; //maximum input boxes allowed
		var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ 
		//alert('hello');
		//on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				//$(wrapper).append('<div class="form-group"><div class="col-md-4"><label for="rule_value">Offer Value</label><input class="form-control empty margin_bottom" id="rule_value" placeholder="Offer Value" tabindex="8" name="rule_value" type="text"> <div id="rule_value_alert" class="validationAlert"></div> </div><div class="col-md-4"><label for="max value">Min Amount </label><input type="text" class="form-control empty margin_bottom" value="" name="max" id="max" placeholder="Max Cashback" tabindex="9"></div><div class="col-md-3"><label for="max value">Max Amount </label><input type="text" class="form-control empty margin_bottom" value="" name="max" id="max" placeholder="Max Cashback" tabindex="9"></div><a href="#" class="remove_field"><i class="glyphicon glyphicon-minus"> </i></a></div>'); //add input box
				$(wrapper).append('<tr class="row extraRow"><td class="col-md-4"><select name="rejection" class="form-control" id="rejection"><option value="0">rejection 1</option><option value="1">rejection 2</option><option value="2">rejection 3</option></select></td><td class="col-md-2"><input type="text" name="qty" id="qty" placeholder="qty" class="form-control"></td><td class="col-md-5"><input type="text" name="comment" id="comment" placeholder="Comment" class="form-control"></td><td class="col-md-1 add-more-btn"><a class="remove_field btn btn-default" href="javascript:void(0)"><i class="glyphicon glyphicon-minus"></i></a></td></tr>') 
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ 
		//user click on remove text
		e.preventDefault(); $(this).closest('tr').remove(); x--;
		});
		
		//Add Downtime multiple
		var wrapperDT         = $(".input_fields_wrapDT"); //Fields wrapper
		var add_buttonDT     = $(".add_field_buttonDT"); //Add button ID
		
		var x = 1; //initlal text box count
		$(add_buttonDT).click(function(e){ 
		//alert('hello');
		//on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				//$(wrapper).append('<div class="form-group"><div class="col-md-4"><label for="rule_value">Offer Value</label><input class="form-control empty margin_bottom" id="rule_value" placeholder="Offer Value" tabindex="8" name="rule_value" type="text"> <div id="rule_value_alert" class="validationAlert"></div> </div><div class="col-md-4"><label for="max value">Min Amount </label><input type="text" class="form-control empty margin_bottom" value="" name="max" id="max" placeholder="Max Cashback" tabindex="9"></div><div class="col-md-3"><label for="max value">Max Amount </label><input type="text" class="form-control empty margin_bottom" value="" name="max" id="max" placeholder="Max Cashback" tabindex="9"></div><a href="#" class="remove_field"><i class="glyphicon glyphicon-minus"> </i></a></div>'); //add input box
				$(wrapperDT).append('<tr class="row"><td class="col-md-4"><select name="subreason" class="form-control" id="subreason"><option value="0">subreason 1</option><option value="1">subreason 2</option><option value="2">subreason 3</option></select><div class="error validationAlert validationError" id="subreason_alert"></div></td><td class="col-md-2"><input type="text" name="start_time" id="start_time" placeholder="Start Time" class="form-control pickTime"><div class="error validationAlert validationError" id="start_time_alert"></div></td><td class="col-md-2"><input type="text" name="end_time" id="end_time" placeholder="End Time" class="form-control pickTime"><div class="error validationAlert validationError" id="end_time_alert"></div></td><td class="col-md-5"><input type="text" name="comment" id="comment" placeholder="Comment" class="form-control"><div class="error validationAlert validationError" id="comment_alert"></div></td><td class="col-md-1 add-more-btn"><a href="javascript:void(0)" class="btn btn-default remove_fieldDT"><i class="glyphicon glyphicon-minus"></i></a></td></tr>') 
			}
		});
		
		$(wrapperDT).on("click",".remove_fieldDT", function(e){ 
		//user click on remove text
		e.preventDefault(); $(this).closest('tr').remove(); x--;
		});
		$('.pickTime').datetimepicker({
			datepicker:false,
			format:'H:i',
			step:5
		});		
	})
</script>
@stop 