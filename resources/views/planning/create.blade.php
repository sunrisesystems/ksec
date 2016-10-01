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
						Transactions
					</li>
					<li>
						<a href="{!!URL::to('planning')!!}">Manage Production Planning</a>
					</li>
					<li class="active">
						<strong>Add Production Planning</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Production Planning</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
	
    <div class="main-container-inner container-fluid selectDropdownDdl">
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::open(array('url'=>'planning/add-planning','method'=>'POST','onsubmit' => 'return validatePlanning()','id'=>'addPlan')) !!}				

						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4 ddl"> 						
										{!! HTML::decode( Form::label('machine', 'Machine <small class="mandatory">*</small>')) !!}
										{!! Form::select('machine_id',$data['machine'],null,['id'=>'machine_id','class'=>'form-control selectpicker','onchange'=>'getPlanning(this.value)','data-live-search'=>true,'data-size'=>"15"]) !!}
										<div id="loading" class="" style="display:none">Loading....</div>
										<div id="machine_id_alert" class="error validationAlert validationError">{!!$errors->first('machine_id')!!}</div>
									</div>
									<div class="col-sm-4 ddl"> 						
										{!! HTML::decode( Form::label('mold', 'Mold <small class="mandatory">*</small>')) !!}
										{!! Form::select('mold_id',$data['mold'],null,['id'=>'mold_id','class'=>'form-control selectpicker','onchange'=>'getProducts(this.value)','data-live-search'=>true,'data-size'=>"15"]) !!}
										<div id="loading1" class="" style="display:none">Loading....</div>
										<div id="mold_id_alert" class="error validationAlert validationError">{!!$errors->first('mold_id')!!}</div>
									</div>
									<div class="col-sm-4 ddl">											
										{!! HTML::decode(Form::label('product', 'Product <small class="mandatory">*</small>')) !!}
										{!! Form::select('product_id',$data['product'],null,['id'=>'product_id','class'=>'form-control']) !!}
										<div id="product_id_alert" class="error validationAlert validationError">{!!$errors->first('product_id')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group" id="planning" style="display:none">
								
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('start_date', 'Start Date Time <small class="mandatory">*</small>')) !!}
                                        {!! Form::text('start_date_time',null,array('placeholder'=>'Start Date Time','id'=>'start_date_time','class'=>'form-control','readonly'=>true,'onblur'=>'validatePlanningDatetime(this.value)')) !!}

										<div id="start_date_time_alert" class="error validationAlert validationError">{!!$errors->first('start_date_time')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('end_date', 'End Date Time <small class="mandatory">*</small>')) !!}
                                        {!! Form::text('end_date_time',null,array('placeholder'=>'End Date Time','id'=>'end_date_time','class'=>'form-control','readonly'=>true)) !!}
										<div id="end_date_time_alert" class="error validationAlert validationError">{!!$errors->first('end_date_time')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('pending_quantity', 'Pending Quatity <small class="mandatory">*</small>')) !!}
										{!! Form::text('pending_quantity',0,array('placeholder'=>'Pending Quatity','id'=>'pending_quantity','class'=>'form-control','readonly'=>true)) !!}
										<div id="pending_quantity_alert" class="error validationAlert validationError">{!!$errors->first('pending_quantity')!!}</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('planning_quantity', 'Planning Quatity <small class="mandatory">*</small>')) !!}
										{!! Form::text('planning_quantity',null,array('placeholder'=>'Planning Quatity','id'=>'planning_quantity','class'=>'form-control','maxlength'=> 11)) !!}
										<div id="planning_quantity_alert" class="error validationAlert validationError">{!!$errors->first('planning_quantity')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],'P',['id'=>'status','class'=>'form-control','disabled'=>true]) !!}
										<div id="status_quantity_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
								</div>
							</div>	
							<section class="parameter-wrapper">
								<fieldset>
									<legend>Parameter Entry:</legend>									
									<div class="row secondary-label">
										<div class="col-md-2 col-sm-2"><span><strong>Parameter</strong></span></div>
										<div class="col-md-3 col-sm-3"><span><strong>Standard Value</strong></span></div>
										<div class="col-md-3 col-sm-3"><span><strong>Change Value</strong></span></div>
										<div class="col-md-4 col-sm-4"><span><strong>Reason</strong></span></div>
									</div>
									
										
									<div class="form-group">
										<div class="row">
											<div class="col-md-2 col-sm-2"> 						
												{!! HTML::decode( Form::label('cycle_time', 'Cycle Time: <small class="mandatory">*</small>')) !!}
											</div>
											<div class="col-md-3">
												{!! Form::text('cycle_time_standard',null,array('placeholder'=>'Standard Value','id'=>'cycle_time_standard','class'=>'form-control','readonly'=>true)) !!}
												<div id="cycle_time_standard_alert" class="error validationAlert validationError">{!!$errors->first('cycle_time_standard')!!}</div>
											</div>
											<div class="col-md-3">
												{!! Form::text('cycle_time',null,array('placeholder'=>'Change Value','id'=>'cycle_time','class'=>'form-control','maxlength'=>6)) !!}
												<div id="cycle_time_alert" class="error validationAlert validationError">{!!$errors->first('cycle_time')!!}</div>
											</div>
											<div class="col-md-4">
												{!! Form::text('cycle_time_reason',null,array('placeholder'=>'Reason','id'=>'cycle_time_reason','class'=>'form-control')) !!}
												<div id="cycle_time_reason_alert" class="error validationAlert validationError">{!!$errors->first('cycle_time_reason')!!}</div>
											</div>
										</div>
									</div>	
									<div class="form-group">
										<div class="row">
											<div class="col-md-2 col-sm-2"> 						
												{!! HTML::decode( Form::label('cavity_block', 'Cavity Block: <small class="mandatory">*</small>')) !!}
												<span class="second-label"># of cavities : <span id="no_of_cavities"></span></span>
											</div>
											<div class="col-md-3">
												{!! Form::text('cavity_block_standard',null,array('placeholder'=>'Standard Value','id'=>'cavity_block_standard','class'=>'form-control','readonly'=>true)) !!}
												<div id="cavity_block_standard_alert" class="error validationAlert validationError">{!!$errors->first('cavity_block_standard')!!}</div>
											</div>
											<div class="col-md-3">
												{!! Form::text('cavity_blocks',null,array('placeholder'=>'Change Value','id'=>'cavity_blocks','class'=>'form-control','maxlength'=>2)) !!}
												<div id="cavity_blocks_alert" class="error validationAlert validationError">{!!$errors->first('cavity_blocks')!!}</div>
											</div>
											<div class="col-md-4">
												{!! Form::text('cavity_block_reason',null,array('placeholder'=>'Reason','id'=>'cavity_block_reason','class'=>'form-control')) !!}
												<div id="cavity_block_reason_alert" class="error validationAlert validationError">{!!$errors->first('cavity_block_reason')!!}</div>
											</div>
										</div>
									</div>	
									<div class="form-group">
										<div class="row">
											<div class="col-md-2 col-sm-2"> 						
												{!! HTML::decode( Form::label('not_available_time', 'Not Available Time: <small class="mandatory">*</small>')) !!}
											</div>
											<div class="col-md-3">
												{!! Form::text('not_available_standard',0,array('placeholder'=>'Standard Value','id'=>'not_available_standard','class'=>'form-control','readonly'=>true)) !!}
												<div id="not_available_standard_alert" class="error validationAlert validationError">{!!$errors->first('not_available_standard')!!}</div>
											</div>
											<div class="col-md-3">
												<div class="row">
												<div class="col-md-6"> 						 						
												{!! Form::text('not_available_time_hrs',null,array('placeholder'=>'Hrs','id'=>'not_available_time_hrs','class'=>'form-control','maxlength'=>2)) !!}
												<div id="not_available_time_hrs_alert" class="error validationAlert validationError">{!!$errors->first('not_available_time_hrs')!!}</div>
												</div>
												<div class="col-md-6"> 						 						
												{!! Form::text('not_available_time_min',null,array('placeholder'=>'Mins','id'=>'not_available_time_min','class'=>'form-control','maxlength'=>2)) !!}
												<div id="not_available_time_min_alert" class="error validationAlert validationError">{!!$errors->first('not_available_time_min')!!}</div>
												</div>
												</div>
											</div>
											<div class="col-md-4">
												{!! Form::text('not_available_time_reason',null,array('placeholder'=>'Reason','id'=>'not_available_time_reason','class'=>'form-control')) !!}
												<div id="not_available_time_reason_alert" class="error validationAlert validationError">{!!$errors->first('not_available_time_reason')!!}</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-md-2 col-sm-2"> 						
												{!! HTML::decode( Form::label('change_over_time', 'Change Over Time:')) !!}
											</div>
											<div class="col-md-3">												
												{!! Form::select('change_over_time_id', $data['changeOverTime'], null, ['class' => 'form-control']) !!}
												<div id="change_over_time_id_alert" class="error validationAlert validationError">{!!$errors->first('change_over_time_id')!!}</div>
											</div>
											<div class="col-md-3">
												<div class="row">
												<div class="col-md-6"> 						 						
												 						
												{!! Form::text('change_over_time_hrs',null,array('placeholder'=>'Hrs','id'=>'change_over_time_hrs','class'=>'form-control','maxlength'=>2)) !!}
												<div id="change_over_time_hrs_alert" class="error validationAlert validationError">{!!$errors->first('change_over_time_hrs')!!}</div>
												</div>
												<div class="col-md-6"> 						 						
												 						
												{!! Form::text('change_over_time_min',null,array('placeholder'=>'Mins','id'=>'change_over_time_min','class'=>'form-control','maxlength'=>2)) !!}
												<div id="change_over_time_min_alert" class="error validationAlert validationError">{!!$errors->first('change_over_time_min')!!}</div>
												</div>
												</div>
											</div>
											<div class="col-md-4">
												{!! Form::text('change_over_time_reason',null,array('placeholder'=>'Reason','id'=>'change_over_time_reason','class'=>'form-control')) !!}
												<div id="change_over_time_reason_alert" class="error validationAlert validationError">{!!$errors->first('change_over_time_reason')!!}</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-md-2 col-sm-2"> 						
												{!! HTML::decode( Form::label('comment', 'Comment:')) !!}
											</div>
											<div class="col-md-10">												
												{!! Form::textarea('comment', null, ['size' => '30x2','class'=>'form-control']) !!}
												<div id="comment_standard_alert" class="error validationAlert validationError">{!!$errors->first('comment')!!}</div>
											</div>
											
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-5"> 	
												{!! HTML::decode( Form::label('time_required', 'Time Required <small class="mandatory">*</small>')) !!}
												<div class="input-group">
													{!! Form::text('time_required',null,array('placeholder'=>'Time Required','id'=>'time_required','class'=>'form-control','readonly'=>true)) !!}
													<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="calculateTime()">Calculate Time</a>
													<div id="loading2" class="" style="display:none">Loading....</div>
												</div>
												<div id="time_required_alert" class="error validationAlert validationError">{!!$errors->first('time_required')!!}</div>
											</div>
											<div class="col-md-4 col-sm-4">					
												<div class="triple-gp-wraper">
													<div class="row">														
														<div class="col-sm-4">	
															
															{!! HTML::decode( Form::label('days', 'Day(s) <small class="mandatory">*</small>')) !!}
														
															{!! Form::text('time_required_days',null,array('placeholder'=>'Days','id'=>'time_required_days','class' => 'form-control','readonly'=>true)) !!}
															<div id="time_required_days_alert" class="error validationAlert validationError">{!! $errors->first('time_required_days') !!}</div>
														</div>
														<div class="col-sm-4">	
															{!! HTML::decode( Form::label('hours', 'Hour(s) <small class="mandatory">*</small>')) !!}
															{!! Form::text('time_required_hrs',null,array('placeholder'=>'Hours','id'=>'time_required_hrs','class' => 'form-control','readonly'=>true)) !!}
															<div id="time_required_hrs_alert" class="error validationAlert validationError">{!! $errors->first('time_required_hrs') !!}</div>
														</div>
														<div class="col-sm-4">	
															{!! HTML::decode( Form::label('mins', 'Min(s) <small class="mandatory">*</small>')) !!}														
															{!! Form::text('time_required_mins',null,array('placeholder'=>'Mins','id'=>'time_required_mins','class' => 'form-control','readonly'=>true)) !!}
															<div id="time_required_mins_alert" class="error validationAlert validationError">{!! $errors->first('time_required_mins') !!}</div>
														</div>	
													</div>
												</div> 	
											</div>
										</div>
									</div>
								</fieldset>
							</section>
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
									{!! Form::button('Cancel', ['class' => 'btn btn-black','onclick'=>'redirectUrl()']) !!} 
								</div>									
							</div><!-- action end -->
						</div><!-- Form control wrapper end -->					
					{!! Form::close() !!}
				</section><!-- section Form end -->
			</div>
		</div><!-- Form row end -->
	</div><!-- main-container-inner -->
</div><!-- Container end -->



<script type="text/javascript">
    function validatePlanning()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'machine_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_machine")?>';
        i++;

        arrElemId[i]    = 'mold_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_mold")?>';
        i++;

        arrElemId[i]    = 'product_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_product")?>';
        i++;

        arrElemId[i]    = 'start_date_time';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_start_date_time")?>';
        i++;

        arrElemId[i]    = 'end_date_time';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_end_date_time")?>';
        i++;

        arrElemId[i]    = 'pending_quantity';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_pending_quantity")?>';
        i++;

        arrElemId[i]    = 'planning_quantity';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_planning_quantity")?>';
        i++;

       /* arrElemId[i]    = 'status';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_status")?>';
        i++;*/

        arrElemId[i]    = 'cycle_time';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_cycle_time")?>';
        i++;

        if($("#cycle_time_standard").val() != $("#cycle_time").val()){
        	arrElemId[i]    = 'cycle_time_reason';
	        arrCode[i]      = 'IS_EMPTY';
	        arrRefValue[i]  = null;
	        arrMsg[i]       = '<?php echo Lang::get("messages.empty_cycle_time_reason")?>';
	        i++;
        }

        if($("#cavity_block_standard").val() != $("#cavity_blocks").val()){
        	arrElemId[i]    = 'cavity_block_reason';
	        arrCode[i]      = 'IS_EMPTY';
	        arrRefValue[i]  = null;
	        arrMsg[i]       = '<?php echo Lang::get("messages.empty_cavity_block_reason")?>';
	        i++;
        }

        if($("#not_available_time_hrs").val() != ''){
        	arrElemId[i]    = 'not_available_time_reason';
	        arrCode[i]      = 'IS_EMPTY';
	        arrRefValue[i]  = null;
	        arrMsg[i]       = '<?php echo Lang::get("messages.empty_not_available_time_reason")?>';
	        i++;
        }

        if($("#change_over_time_hrs").val() != ''){
        	arrElemId[i]    = 'change_over_time_reason';
	        arrCode[i]      = 'IS_EMPTY';
	        arrRefValue[i]  = null;
	        arrMsg[i]       = '<?php echo Lang::get("messages.empty_change_over_time_reason")?>';
	        i++;
        }

        arrElemId[i]    = 'time_required';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_time_required")?>';
        i++;

        arrElemId[i]    = 'time_required_days';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_time_required_days")?>';
        i++;

        arrElemId[i]    = 'time_required_hrs';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_time_required_hrs")?>';
        i++;

        arrElemId[i]    = 'time_required_mins';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_time_required_mins")?>';
        i++;


        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        if(result){
        	$("#status").prop('disabled', false);
        }
        return result;

    }
    function redirectUrl () {
    	doCancel("{!! URL::to('planning/index') !!}")
    }

    function getPlanning(machineId){
    	if(machineId != ''){
    		$.ajax({
                url : base_url+"/planning/get-planning-for-machine",
                method : "POST",
                data : { 'machineId' : machineId },
                cache : false,
                beforeSend : function(){
                    $("#loading").show();
                },
                success:function(data){
                    $("#planning").html(data).show();
                    $("#loading").hide();
                },
                done : function (data){
                    $("#loading").hide();
                    
                },
                fail :function () {
                    $("#loading").hide();
                    alert("error")
                }
            });
    	}
    }
    function getMolds(productId){
    	if(productId != ''){
    		// ajax call to load molds 
    		$.ajax({
                url : base_url+"/planning/get-molds",
                method : "POST",
                data : { 'productId' : productId },
                cache : false,
                beforeSend : function(){
                    $("#loading").show();
                },
                success:function(data){
                    $("#mold_id").html(data);
                    $("#loading").hide();
                },
                done : function (data){
                    $("#loading").hide();
                    
                },
                fail :function () {
                    $("#loading").hide();
                    alert("error")
                }
            });
    	}
    }

    function getProducts(moldId){
    	if(moldId != ''){
    		// ajax call to load products 
    		$.ajax({
                url : base_url+"/planning/get-products",
                method : "POST",
                data : { 'moldId' : moldId },
                cache : false,
                beforeSend : function(){
                    $("#loading1").show();
                },
                success:function(data){
                    //$("#product_id").html(data);
                    var output = [];
                   	if(data.success == 1){
                    	if(Object.keys(data.data).length > 0){
                    		$("#product_id").html('');
                    		$('#product_id').append($('<option/>', { 
						        value: '',
						        text : 'Select' 
						    }));
                    		$.each(data.data, function (index, value) {
							    $('#product_id').append($('<option/>', { 
							        value: value.id,
							        text : value.trade_name 
							    }));
							});
							$("#cycle_time_standard").val(data.drawing.sct_c);
							$("#cycle_time").val(data.drawing.sct_c);
							$("#cavity_block_standard").val(data.drawing.std_cavitiy_blocks);
							$("#cavity_blocks").val(data.drawing.std_cavitiy_blocks);
							$("#no_of_cavities").html(data.drawing.std_cavities);
                    	}else{
                    		$("#product_id").html('');
                    		$('#product_id').append($('<option/>', { 
						        value: '',
						        text : 'Select' 
						    }));
							$("#cycle_time_standard").val('');
							$("#cycle_time").val('');
							$("#cavity_block_standard").val('');
							$("#cavity_blocks").val('');
							$("#no_of_cavities").html('');
                    	}
                    	$('#product_id').selectpicker('destroy');

                    	$('#product_id').selectpicker({
							//  style: 'btn-info',
							  size: 10,
							  liveSearch : true
						});
                    }else{
                    	alert(data.data);
                    }
                    $("#loading1").hide();
                },
                done : function (data){
                    $("#loading1").hide();
                    
                },
                fail :function () {
                    $("#loading1").hide();
                    alert("error")
                }
            });
    	}
    }

    $('#start_date_time').datetimepicker({
    	format:'d-m-Y H:i',
  		formatTime:'H:i',
  		formatDate:'d-m-Y',
  		step : 15,
  		mask: true,
  		minDate : '-02-01-1970',
  	/*	theme:'dark',*/
  		/*onChangeDateTime:function(dp,$input){
  			$input.blur();
  			$("#planning_quantity").focus();
  		}, */
  		onSelectTime : function(dp,$input){
  			$("#start_date_time").datetimepicker('hide');
  			$input.blur();
  			$("#planning_quantity").focus();
  		}
    });	
    function validatePlanningDatetime(datetime){	
  		$("#planning_quantity").focus();
    	if(validateDatetime(datetime)){
    		if(validateYesterdaysDate(datetime)){
    			// ajax call to check date for planning
    			var machineId = $("#machine_id").val();
    			if(machineId == ''){
    				alert("Please select machine");
    				return false;
    			}
    			$.ajax({
	                url : base_url+"/planning/check-plan-date",
	                method : "POST",
	                data : { 'date' : datetime, 'machineId' : machineId },
	                cache : false,
	                beforeSend : function(){
	                    //$("#loading").show();
	                },
	                success:function(data){
	                    console.log(data);
	                    if(data.success == 0){
	                    	alert(data.data);
	                    }
	                    //$("#loading").hide();
	                },
	                done : function (data){
	                   // $("#loading").hide();
	                    
	                },
	                fail :function () {
	                    //$("#loading").hide();
	                    alert("error")
	                }
	            });
    		}else{
    			alert("Please enter date greater than yesterday's date.");
    		}
    	}else{
    		alert("Invalid date time");
    	}
    }

    $("#planning_quantity,#change_over_time_min,#change_over_time_hrs,#not_available_time_hrs,#not_available_time_min,#cavity_blocks,#cycle_time").ForceNumericOnly();

    function calculateTime () {
    	$.ajax({
            url : base_url+"/planning/calculate-time",
            method : "POST",
            data : $("#addPlan").serialize(),
            cache : false,
            beforeSend : function(){
                $("#loading2").show();
            },
            success:function(data){
                console.log(data);
                if(data.success == 0){
                	alert(data.data);
                }else{
                	$("#end_date_time").val(data.data.end_date_time);
                	$("#time_required").val(data.data.totalHrs);
                	$("#time_required_days").val(data.data.days);
                	$("#time_required_hrs").val(data.data.hrs);
                	$("#time_required_mins").val(data.data.min);
                	//$("#end_date_time").val(data.data.end_date_time);
                }
                $("#loading2").hide();
            },
            done : function (data){
               $("#loading2").hide();
                
            },
            fail :function () {
                $("#loading2").hide();
                alert("error")
            }
        });
    }
</script>
@stop