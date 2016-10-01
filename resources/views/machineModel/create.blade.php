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
                        <a href="{!! URL::to('machineModel') !!}">Manage Machine Models</a>
					</li>
					<li class="active">
						<strong>Add Machine Model</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Machine Model</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    
	<div class="main-container-inner container-fluid">	
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="groupDetail" class="form-container">
						{!! Form::open(array('route' => 'machineModel.store' , 'onSubmit' => 'return validateMachineModel()','files'=>true)) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 		
										{!! HTML::decode( Form::label('machine_model', 'Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('machine_model',null,array('placeholder'=>'Machine Model','id'=>'machine_model','class'=>'form-control')) !!}
										<div id="machine_model_alert" class="error validationAlert validationError">{!!$errors->first('machine_model')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('type', 'Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('type_id',$data['type'],null,['id'=>'type_id','class'=>'form-control']) !!}
										<div id="type_id_alert" class="error validationAlert validationError">{!!$errors->first('type_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('store', 'Class/Store Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('store_id',$data['store'],null,['id'=>'store_id','class'=>'form-control']) !!}
										<div id="store_id_alert" class="error validationAlert validationError">{!!$errors->first('store_id')!!}</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('group', 'Screw L/ D Ratio (:) <small class="mandatory">*</small>')) !!}
										{!! Form::select('screw_l_d_ratio',$data['screwRatio'],null,['id'=>'screw_l_d_ratio','class'=>'form-control']) !!}
										<div id="screw_l_d_ratio_alert" class="error validationAlert validationError">{!!$errors->first('screw_l_d_ratio')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('store', 'Screw Diameter (mm)<small class="mandatory">*</small>')) !!}
										{!! Form::text('screw_diameter',null,array('placeholder'=>'Screw Diameter','id'=>'screw_diameter','class'=>'form-control')) !!}
										<div id="screw_diameter_alert" class="error validationAlert validationError">{!!$errors->first('screw_diameter')!!}</div>
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('shot_weight_capacity', 'Shot Weight Capacity (cm<sup>3</sup>)<small class="mandatory">*</small>')) !!}
										{!! Form::text('shot_wt_capacity',null,array('placeholder'=>'Shot Weight Capacity','id'=>'shot_wt_capacity','class'=>'form-control')) !!}
										<div id="shot_wt_capacity_alert" class="error validationAlert validationError">{!!$errors->first('shot_wt_capacity')!!}</div>
									</div>
								</div>
							</div>	
							
							<div class="form-group">
								<div class="row">
									
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('plasticizing_capacity', 'Plasticizing Capacity (cm<sup>3</sup>)<small class="mandatory">*</small>')) !!}
										{!! Form::text('plasticizing_capacity',null,array('placeholder'=>'Plasticizing Capacity','id'=>'plasticizing_capacity','class'=>'form-control')) !!}
										<div id="plasticizing_capacity_alert" class="error validationAlert validationError">{!!$errors->first('plasticizing_capacity')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('screw_speed', 'Screw Speed (rpm)<small class="mandatory">*</small>')) !!}
										{!! Form::text('screw_speed',null,array('placeholder'=>'Screw Speed','id'=>'screw_speed','class'=>'form-control')) !!}
										<div id="screw_speed_alert" class="error validationAlert validationError">{!!$errors->first('screw_speed')!!}</div>
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('plasticizing_capacity', 'Injection Speed Max. (cm<sup>3</sup>/s)<small class="mandatory">*</small>')) !!}
										{!! Form::text('injection_speed_max',null,array('placeholder'=>'Injection Speed Max','id'=>'injection_speed_max','class'=>'form-control')) !!}
										<div id="injection_speed_max_alert" class="error validationAlert validationError">{!!$errors->first('injection_speed_max')!!}</div>
									</div>
								</div>
							</div>	
							
							<div class="form-group">
								<div class="row">
									
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('injection_pressure_max', 'Injection Pressure Max. (MPa)<small class="mandatory">*</small>')) !!}
										{!! Form::text('injection_pressure_max',null,array('placeholder'=>'Injection Pressure Max.','id'=>'injection_pressure_max','class'=>'form-control')) !!}
										<div id="injection_pressure_max_alert" class="error validationAlert validationError">{!!$errors->first('injection_pressure_max')!!}</div>
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('hold_pressure', 'Hold Pressure (MPa)<small class="mandatory">*</small>')) !!}
										{!! Form::text('hold_pressure',null,array('placeholder'=>'Hold Pressure','id'=>'hold_pressure','class'=>'form-control')) !!}
										<div id="hold_pressure_alert" class="error validationAlert validationError">{!!$errors->first('hold_pressure')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('clamp_force', 'Clamp Force (kN)<small class="mandatory">*</small>')) !!}
										{!! Form::text('clamp_force',null,array('placeholder'=>'Clamp Force','id'=>'clamp_force','class'=>'form-control')) !!}
										<div id="clamp_force_alert" class="error validationAlert validationError">{!!$errors->first('clamp_force')!!}</div>
									</div>
								</div>
							</div>	

							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('clamp_stroke', 'Clamp Stroke (mm)<small class="mandatory">*</small>')) !!}
										{!! Form::text('clamp_stroke',null,array('placeholder'=>'Clamp Stroke','id'=>'clamp_stroke','class'=>'form-control')) !!}
										<div id="clamp_stroke_alert" class="error validationAlert validationError">{!!$errors->first('clamp_stroke')!!}</div>
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('installed_heating_capacity', 'Installed Heating Capacity (kW)<small class="mandatory">*</small>')) !!}
										{!! Form::text('installed_heating_capacity',null,array('placeholder'=>'Installed Heating Capacity','id'=>'installed_heating_capacity','class'=>'form-control')) !!}
										<div id="installed_heating_capacity_alert" class="error validationAlert validationError">{!!$errors->first('installed_heating_capacity')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('dry_cycle_time', 'Dry Cycle-Time (s)<small class="mandatory">*</small>')) !!}
										{!! Form::text('dry_cycle_time',null,array('placeholder'=>'Dry Cycle-Time','id'=>'dry_cycle_time','class'=>'form-control')) !!}
										<div id="dry_cycle_time_alert" class="error validationAlert validationError">{!!$errors->first('dry_cycle_time')!!}</div>
									</div>
								</div>
							</div>	

							<div class="form-group">
								<div class="row">
									
									
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('hydraulic_system_pressure', 'Hydraulic System Pressure (MPa)<small class="mandatory">*</small>')) !!}
										{!! Form::text('hydraulic_system_pressure',null,array('placeholder'=>'Hydraulic System Pressure','id'=>'hydraulic_system_pressure','class'=>'form-control')) !!}
										<div id="hydraulic_system_pressure_alert" class="error validationAlert validationError">{!!$errors->first('hydraulic_system_pressure')!!}</div>
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('oil_capacity', 'Oil Capacity (L)<small class="mandatory">*</small>')) !!}
										{!! Form::text('oil_capacity',null,array('placeholder'=>'Oil Capacity','id'=>'oil_capacity','class'=>'form-control')) !!}
										<div id="oil_capacity_alert" class="error validationAlert validationError">{!!$errors->first('oil_capacity')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('net_weight', 'Net Weight (t)<small class="mandatory">*</small>')) !!}
										{!! Form::text('net_weight',null,array('placeholder'=>'Net Weight','id'=>'net_weight','class'=>'form-control')) !!}
										<div id="hydraulic_system_pressure_alert" class="error validationAlert validationError">{!!$errors->first('net_weight')!!}</div>
									</div>
								</div>
							</div>	

							<div class="form-group">
								<div class="row">
									
									
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('manufacturer_id', 'Manufacturer <small class="mandatory">*</small>')) !!}
										{!! Form::select('manufacturer_id',$data['manufacturer'],null,['id'=>'manufacturer_id','class'=>'form-control']) !!}
										<div id="manufacturer_id_alert" class="error validationAlert validationError">{!!$errors->first('manufacturer_id')!!}</div>
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('actuation_id', 'Actuation <small class="mandatory">*</small>')) !!}
										{!! Form::select('actuation_id',$data['actuation'],null,['id'=>'actuation_id','class'=>'form-control']) !!}
										<div id="actuation_id_alert" class="error validationAlert validationError">{!!$errors->first('actuation_id')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('actuator1', 'Connected Actuator 1 <small class="mandatory">*</small>')) !!}
										{!! Form::select('connected_actuators_1',$data['actuator1'],null,['id'=>'connected_actuators_1','class'=>'form-control']) !!}
										<div id="connected_actuators_1_alert" class="error validationAlert validationError">{!!$errors->first('connected_actuators_1')!!}</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									
									
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('actuator2', 'Connected Actuator 2')) !!}
										{!! Form::select('connected_actuators_2',$data['actuator2'],null,['id'=>'connected_actuators_2','class'=>'form-control']) !!}
										<div id="connected_actuators_2_alert" class="error validationAlert validationError">{!!$errors->first('connected_actuators_2')!!}</div>    
									</div>
									<div class="col-sm-4"> 		
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! Form::label('Attachments', 'Attachments')!!}
										{!! Form::file('attachments[]',['id'=>'attachments','multiple'=>true,'class'=>'form-control']) !!}
										<div id="attachments_alert" class="error validationAlert validationError">{!! $errors->first('attachments') !!}</div>
									</div>
								</div>
							</div>

							<!-- <div class="form-group">
								<div class="row">
									
								</div>
							</div> -->
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
									<button type="button"  class="btn btn-black" onClick="doCancel('{!! URL::to('machineModel') !!}')">Cancel</button>										
								</div>									
							</div><!-- action end -->
						</div><!-- Form control wrapper end -->	
					{!! Form::close() !!}
				</section><!-- section Form end -->
			</div>
		</div><!-- Form row end -->
		
	</div><!--main-container-inner -->
</div><!-- Container end -->

<script type="text/javascript">
    function validateMachineModel()
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

    $("#screw_speed,#screw_diameter,#shot_weight_capacity,#plasticizing_capacity,#injection_speed_max,#injection_pressure_max,#hold_pressure,#clamp_stroke,#clamp_force,#installed_heating_capacity,#dry_cycle_time,#hydraulic_system_pressure,#oil_capacity,#net_weight").ForceNumericOnly();
</script>
@stop 