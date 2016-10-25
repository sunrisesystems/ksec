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
	<div class="breadcrumb-wrapper">		
		<ol class="breadcrumb">					
			<li>
				<a href="{!! URL::to('employees') !!}">Manage Employees</a>
			</li>
			<li class="active">
				<strong>Add Employee</strong>
			</li>					
		</ol>			
	</div>
	<header class="page-header-wrapper">
		<div class="page-heading">
			<h2>Add Employee</h2>
		</div>
	</header>
	<div class="clearfix"></div>
    <div class="main-container-inner">			
		<section id="inputDetail" class="form-container">
			{!! Form::open(['route' => 'employees.store' , 'onSubmit' => 'return validateEmployee()']) !!}
				<div class="form-control-wrapper">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('empCode', 'Employee Code <small class="mandatory">*</small>')) !!}
								{!! Form::text('empCode','',array("placeholder"=>"Employee Code",'id'=>'empCode','class'=>'form-control','maxlength'=>10,'autocomplete'=>'off')) !!} 
								<div id="empCode_alert" class="error validationAlert validationError">{!!$errors->first('empCode')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('systemId', 'System ID <small class="mandatory">*</small>')) !!}
								{!! Form::text('systemId','',array("placeholder"=>"System ID",'id'=>'firstname','class'=>'form-control','autocomplete'=>'off')) !!} 
								<div id="systemId_alert" class="error validationAlert validationError">{!!$errors->first('systemId')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('empName', 'Employee Name <small class="mandatory">*</small>')) !!}
								{!! Form::text('empName','',array("placeholder"=>"Employee Name",'id'=>'empName','class'=>'form-control','maxlength'=>15,'autocomplete'=>'off')) !!} 
								<div id="empName_alert" class="error validationAlert validationError">{!!$errors->first('empName')!!}</div>
							</div>
						</div>
					</div>	
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('empType', 'Employee Type <small class="mandatory">*</small>')) !!}
								{!! Form::select('empType',$data['empType'], null, ['id'=>'systemType','class'=>'form-control']) !!}
								<div id="empType_alert" class="error validationAlert validationError">{!!$errors->first('empType')!!}</div>
							</div>	

							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('department', 'Department <small class="mandatory">*</small>')) !!}
				
								{!! Form::select('department',$data['department'], null, ['id'=>'department','class'=>'form-control']) !!}
								<div id="department_alert" class="error validationAlert validationError">{!!$errors->first('department')!!}</div>
							</div>	
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('teamleadId', 'Team Lead')) !!}
								{!! Form::select('teamleadId',$data['teamLead'], null, ['id'=>'teamleadId','class'=>'form-control']) !!}
								<div id="teamleadId_alert" class="error validationAlert validationError">{!!$errors->first('teamleadId')!!}</div>
							</div>
						
							
						</div>
					</div>	
					<div class="form-group">
						<div class="row">
							
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('managerId', 'Manager')) !!}
								{!! Form::select('managerId',$data['manager'], null, ['id'=>'managerId','class'=>'form-control']) !!}
								<div id="managerId_alert" class="error validationAlert validationError">{!!$errors->first('managerId')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('mobile', 'Employee Mobile <small class="mandatory">*</small>')) !!}
								{!! Form::text('mobile','',array("placeholder"=>"Employee Mobile",'id'=>'mobile','class'=>'form-control','maxlength'=>10,'autocomplete'=>'off')) !!} 
								<div id="mobile_alert" class="error validationAlert validationError">{!!$errors->first('mobile')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('email', 'Employee Email <small class="mandatory">*</small>')) !!}
								{!! Form::email('email','',array("placeholder"=>"Employee Email",'id'=>'email','class'=>'form-control','maxlength'=>100,'autocomplete'=>'off')) !!} 
								<div id="email_alert" class="error validationAlert validationError">{!!$errors->first('email')!!}</div>
							</div>
								
							
						</div>
					</div>	
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('profile', 'Profile <small class="mandatory">*</small>')) !!}
				
								{!! Form::select('profile',$data['profile'], null, ['id'=>'profile','class'=>'form-control']) !!}
								<div id="profile_alert" class="error validationAlert validationError">{!!$errors->first('profile')!!}</div>
							</div>	
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('status', 'City <small class="mandatory">*</small>')) !!}
								{!! Form::select('city',$data['city'],null, ['id'=>'city','class'=>'form-control']) !!}
								<div id="city_alert" class="error validationAlert validationError">{!!$errors->first('city')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
								{!! Form::select('status',$data['status'],'A', ['id'=>'status','class'=>'form-control']) !!}
								<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
							</div>
																
						</div>
					</div>

					<div class="form-group">
						<div class="row">
						<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('allowLogin', 'Allow Login <small class="mandatory">*</small>')) !!}
								{!! Form::select('allowLogin',$data['allowLogin'],null, ['id'=>'allowLogin','class'=>'form-control']) !!}
								<div id="allowLogin_alert" class="error validationAlert validationError">{!!$errors->first('allowLogin')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('password', 'Password <small class="mandatory">*</small>')) !!}
								{!! Form::password('password',array('placeholder'=>'Password','id'=>'password','class'=>'form-control','maxlength'=>20)) !!} 
								<div id="password_alert" class="error validationAlert validationError">{!!$errors->first('password')!!}</div>
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