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
<div id="main-container" class="main-container"> 
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li>
						Productions
					</li>
					<li>
                        <a href="{!! URL::to('machine') !!}">Manage Machines</a>
					</li>
					<li class="active">
						<strong>Add Machine</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Machine</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
	
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::open(array('route' => 'machine.store' , 'onSubmit' => 'return validateMachine()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 	
										{!! HTML::decode( Form::label('molding_machine_name', 'Molding Machine Name <small class="mandatory">*</small>')) !!}
										<div class="input-group">
											{!! Form::text('molding_machine_name',null,array('placeholder'=>'Molding Machine Name','id'=>'molding_machine_name','class'=>'form-control')) !!}
											<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="generateMoldingMachineName()"><span class="glyphicon glyphicon-refresh"></span></a>
										</div>
										<div id="loading" class="" style="display:none">Loading....</div>
										<div id="molding_machine_name_alert" class="error validationAlert validationError">{!!$errors->first('molding_machine_name')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('Inhouse Serial #', 'Inhouse Serial (#)<small class="mandatory">*</small>'))!!}
										{!! Form::text('inhouse_serial_no',null,array('placeholder'=>'Inhouse Serial #','id'=>'inhouse_serial_no','class'=>'form-control')) !!}
										<div id="inhouse_serial_no_alert" class="error validationAlert validationError">{!! $errors->first('inhouse_serial_no') !!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode( Form::label('manufacturer_serial_no', 'Manufacturer\'s Serial (#)<small class="mandatory">*</small>')) !!}
										{!! Form::text('manufacturer_serial_no',null,array('placeholder'=>'Molding Machine Name','id'=>'manufacturer_serial_no','class'=>'form-control')) !!}
										<div id="manufacturer_serial_no_alert" class="error validationAlert validationError">{!!$errors->first('manufacturer_serial_no')!!}</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('manufacturing_date', 'Manufacturing Date (mm-yy)<small class="mandatory">*</small>'))!!}
										{!! Form::text('manufacturing_date',null,array('placeholder'=>'Manufacturing Date','id'=>'manufacturing_date','class'=>'form-control datePicker','readonly'=>true)) !!}
										<div id="manufacturing_date_alert" class="error validationAlert validationError">{!! $errors->first('manufacturing_date') !!}</div>
									</div>
									<div class="col-sm-4">										
										{!! HTML::decode( Form::label('molding_machine_inhouse_name', 'Molding Machine Inhouse Name <small class="mandatory">*</small>')) !!}
										<div class="input-group">
										{!! Form::text('molding_machine_inhouse_name',null,array('placeholder'=>'Molding Machine Inhouse Name','id'=>'molding_machine_inhouse_name','class'=>'form-control')) !!}
										<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="generateMoldingMachineInhouseName()"><span class="glyphicon glyphicon-refresh"></span></a>
										</div>
										<div id="loading1" class="" style="display:none">Loading....</div>
										<div id="molding_machine_inhouse_name_alert" class="error validationAlert validationError">{!!$errors->first('molding_machine_inhouse_name')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('downtime_allowance', 'Downtime Allowance <small class="mandatory">*</small>'))!!}
										{!! Form::text('downtime_allowance',null,array('placeholder'=>'Downtime Allowance','id'=>'downtime_allowance','class'=>'form-control')) !!}
										<div id="downtime_allowance_alert" class="error validationAlert validationError">{!! $errors->first('downtime_allowance') !!}</div>
									</div>	
								</div>
							</div>	
									<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('cleanup_downtime_allowance', 'Cleanup Downtime Allowance <small class="mandatory">*</small>'))!!}
										{!! Form::text('cleanup_downtime_allowance',null,array('placeholder'=>'Cleanup Downtime Allowance','id'=>'cleanup_downtime_allowance','class'=>'form-control')) !!}
										<div id="cleanup_downtime_allowance_alert" class="error validationAlert validationError">{!! $errors->first('cleanup_downtime_allowance') !!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode( Form::label('maintenance_downtime_allowance', 'Preventive Main. Downtime Allowance<small class="mandatory">*</small>')) !!}
										{!! Form::text('maintenance_downtime_allowance',null,array('placeholder'=>'Preventive Main. Downtime Allowance','id'=>'maintenance_downtime_allowance','class'=>'form-control')) !!}
										<div id="maintenance_downtime_allowance_alert" class="error validationAlert validationError">{!!$errors->first('maintenance_downtime_allowance')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('downtime_frequency', 'Frequency (#)<small class="mandatory">*</small>'))!!}
										{!! Form::text('downtime_frequency',null,array('placeholder'=>'Frequency','id'=>'downtime_frequency','class'=>'form-control')) !!}
										<div id="downtime_frequency_alert" class="error validationAlert validationError">{!! $errors->first('downtime_frequency') !!}</div>
									</div>	
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('machine_model_id', 'Machine Model <small class="mandatory">*</small>')) !!}
										{!! Form::select('machine_model_id',$data['machineModel'],null,['id'=>'machine_model_id','class'=>'form-control']) !!}
										<div id="machine_model_id_alert" class="error validationAlert validationError">{!!$errors->first('machine_model_id')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('manufacturing_unit', 'Manufacturing Unit <small class="mandatory">*</small>')) !!}
										{!! Form::select('manufacturing_unit',$data['manufacturingUnit'],null,['id'=>'manufacturing_unit','class'=>'form-control']) !!}
										<div id="manufacturing_unit_alert" class="error validationAlert validationError">{!!$errors->first('manufacturing_unit')!!}</div>
									</div>
								</div>
							</div>				
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
									<button type="button"  class="btn btn-black" onClick="doCancel('{!! URL::to('machine') !!}')">Cancel</button>
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
    function validateMachine()
    {
        return true;
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'shape_name';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_shape")?>';
        i++;

        arrElemId[i]    = 'shape_code';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_shape_code")?>';
        i++;

        arrElemId[i]    = 'status';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_status")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

    function generateMoldingMachineName () {
    	//Autogenerated using Machine Model, Manufacturer's Serial # and Unit
    	var machineModel = $("#machine_model_id").val();
    	var serialNo = $("#manufacturer_serial_no").val();
    	var unit = $("#manufacturing_unit").val();
    	var unit1 = '';

    	if(machineModel == ''){
    		alert("Please select machine model");
    		return false;
    	}

    	if(serialNo == ''){
    		alert("Please enter Manufacturer's Serial number");
    		return false;
    	}

    	if(unit == ''){
    		alert("Please select Manufacturer Unit");
    		return false;
    	}
    	$.ajax({
                url : base_url+"/admin/get-unit",
                method : "POST",
                data : { 'unitId' : unit },
                cache : false,
                beforeSend : function(){
                    $("#loading").show();
                },
                success:function(data){
                    console.log(data);
                    if(data.success == 1){
                        unit1 = data.data.short_code;
                        var machineModel1 = $("#machine_model_id option:selected").text();
    					//	var unit1 = $("#manufacturing_unit option:selected").text();

    					var name = machineModel1+"_"+serialNo+"_"+unit1;

    					$("#molding_machine_name").val(name);
                    }else{
                        alert(data.data)
                    }
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
    function generateMoldingMachineInhouseName () {
    	//Autogenerated using Machine Model, Inhouse Serial # and Unit
    	var machineModel = $("#machine_model_id").val();
    	var serialNo = $("#inhouse_serial_no").val();
    	var unit = $("#manufacturing_unit").val();
    	var unit1 = '';

    	if(machineModel == ''){
    		alert("Please select machine model");
    		return false;
    	}

    	if(serialNo == ''){
    		alert("Please enter Inhouse Serial number");
    		return false;
    	}

    	if(unit == ''){
    		alert("Please select Manufacturer Unit");
    		return false;
    	}
    	$.ajax({
                url : base_url+"/admin/get-unit",
                method : "POST",
                data : { 'unitId' : unit },
                cache : false,
                beforeSend : function(){
                    $("#loading1").show();
                },
                success:function(data){
                    console.log(data);
                    if(data.success == 1){
                        unit1 = data.data.short_code;
                        var machineModel1 = $("#machine_model_id option:selected").text();
    					//	var unit1 = $("#manufacturing_unit option:selected").text();

    					var name = machineModel1+"_"+serialNo+"_"+unit1;

    					$("#molding_machine_inhouse_name").val(name);
                    }else{
                        alert(data.data)
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
    $("#downtime_frequency,#downtime_allowance,#maintenance_downtime_allowance,#cleanup_downtime_allowance").ForceNumericOnly();
</script>
@stop 