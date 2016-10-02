@extends('layout.admin')
@section('content')
<?php
//Lib::pr($employee);
?>
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
						<a href="{!! URL::to('employees') !!}">Manage Employees</a>
					</li>
					<li class="active">
						<strong>Edit Employee</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Employee</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::model($employee, array('method' => 'PATCH', 'route' => array('employees.update', $employee->id),'name'=>'frm','onsubmit'=>' return validateEmployee()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('empCode', 'Employee Code <small class="mandatory">*</small>')) !!}
										{!! Form::text('empCode',$employee->emp_code,array("placeholder"=>"Employee Code",'id'=>'empCode','class'=>'form-control','maxlength'=>10,'autocomplete'=>'off')) !!} 
										<div id="empCode_alert" class="error validationAlert validationError">{!!$errors->first('empCode')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('systemId', 'System ID <small class="mandatory">*</small>')) !!}
										{!! Form::text('systemId',$employee->system_id,array("placeholder"=>"System ID",'id'=>'firstname','class'=>'form-control','autocomplete'=>'off')) !!} 
										<div id="systemId_alert" class="error validationAlert validationError">{!!$errors->first('systemId')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('empName', 'Employee Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('empName',$employee->emp_name,array("placeholder"=>"Employee Name",'id'=>'empName','class'=>'form-control','maxlength'=>15,'autocomplete'=>'off')) !!} 
										<div id="empName_alert" class="error validationAlert validationError">{!!$errors->first('empName')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('empType', 'Employee Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('empType',$data['empType'], $employee->emp_type_id, ['id'=>'systemType','class'=>'form-control']) !!}
										<div id="empType_alert" class="error validationAlert validationError">{!!$errors->first('empType')!!}</div>
									</div>	

									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('department', 'Department <small class="mandatory">*</small>')) !!}
						
										{!! Form::select('department',$data['department'], $employee->department_id, ['id'=>'department','class'=>'form-control']) !!}
										<div id="department_alert" class="error validationAlert validationError">{!!$errors->first('department')!!}</div>
									</div>	
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('teamleadId', 'Team Lead')) !!}
										{!! Form::select('teamleadId',$data['teamLead'], $employee->tl_id, ['id'=>'teamleadId','class'=>'form-control']) !!}
										<div id="teamleadId_alert" class="error validationAlert validationError">{!!$errors->first('teamleadId')!!}</div>
									</div>
								
									
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('managerId', 'Manager')) !!}
										{!! Form::select('managerId',$data['manager'], $employee->manager_id, ['id'=>'managerId','class'=>'form-control']) !!}
										<div id="managerId_alert" class="error validationAlert validationError">{!!$errors->first('managerId')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('mobile', 'Employee Mobile <small class="mandatory">*</small>')) !!}
										{!! Form::text('mobile',$employee->mobile,array("placeholder"=>"Employee Mobile",'id'=>'mobile','class'=>'form-control','maxlength'=>10,'autocomplete'=>'off')) !!} 
										<div id="mobile_alert" class="error validationAlert validationError">{!!$errors->first('mobile')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('email', 'Employee Email <small class="mandatory">*</small>')) !!}
										{!! Form::email('email',$employee->email,array("placeholder"=>"Employee Email",'id'=>'email','class'=>'form-control','maxlength'=>100,'autocomplete'=>'off')) !!} 
										<div id="email_alert" class="error validationAlert validationError">{!!$errors->first('email')!!}</div>
									</div>
										
									
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('profile', 'Profile <small class="mandatory">*</small>')) !!}
						
										{!! Form::select('profile',$data['profile'], $employee->userRole->role_id, ['id'=>'profile','class'=>'form-control']) !!}
										<div id="profile_alert" class="error validationAlert validationError">{!!$errors->first('profile')!!}</div>
									</div>	
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],$employee->status, ['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('allowLogin', 'Allow Login <small class="mandatory">*</small>')) !!}
										{!! Form::select('allowLogin',$data['allowLogin'],$employee->allow_login, ['id'=>'allowLogin','class'=>'form-control']) !!}
										<div id="allowLogin_alert" class="error validationAlert validationError">{!!$errors->first('allowLogin')!!}</div>
									</div>									
								</div>
							</div>
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
    function validateEmployee()
    {
    	return true;
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'unit';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_unit")?>';
        i++;

        arrElemId[i]    = 'firstname';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_firstname")?>';
        i++; 

        arrElemId[i]    = 'firstname';
        arrCode[i]      = 'ALPHA_S';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.invalid_firstname")?>';
        i++;

        arrElemId[i]    = 'lastname';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_lastname")?>';
        i++; 

        arrElemId[i]    = 'lastname';
        arrCode[i]      = 'ALPHA_S';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.invalid_lastname")?>';
        i++;

        arrElemId[i]    = 'email';
        arrCode[i]      = 'EMAIL';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.invalid_email")?>';
        i++;

        arrElemId[i]    = 'username';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_username")?>';
        i++;

        arrElemId[i]    = 'username';
        arrCode[i]      = 'ALPHANUM';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.invalid_username")?>';
        i++;

        arrElemId[i]    = 'username';
        arrCode[i]      = 'LENGTH_GREATER_EQUAL';
        arrRefValue[i]  = '<?php echo Config::get("global_vars.username_min_length")?>';
        arrMsg[i]       = '<?php echo Lang::get("messages.username_length")?>';
        i++;

        arrElemId[i]    = 'password';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_password")?>';
        i++;

        arrElemId[i]    = 'password';
        arrCode[i]      = 'LENGTH_GREATER_EQUAL';
        arrRefValue[i]  = '<?php echo Config::get("global_vars.password_min_length")?>';
        arrMsg[i]       = '<?php echo Lang::get("messages.password_length")?>';
        i++;

        arrElemId[i]    = 'role';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_role")?>';
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
    	doCancel("{!! URL::to('employees') !!}")
    }
</script>
@stop