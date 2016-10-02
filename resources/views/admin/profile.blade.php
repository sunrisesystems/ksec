@extends('layout.admin')
@section('content')
<div id="main-container" class="main-container">  
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">					
					<li>
						Settings
					</li>
					<li class="active">
						<strong>Update Profile</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	@if (Session::has('message'))
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="{!! Session::get('class') !!}">{!! Session::get('message') !!}</div>
			</div>
		</div>
	</div>
	@endif
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Update Profile</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::model($user, array('method' => 'POST', 'url' => 'admin/update-profile','name'=>'frm','onsubmit'=>' return validateUser()')) !!}

						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('firstname', 'First Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('first_name',null,array("placeholder"=>"First Name",'id'=>'firstname','class'=>'form-control','maxlength'=>15,'autocomplete'=>'off')) !!} 
										<div id="firstname_alert" class="error validationAlert validationError">{!!$errors->first('first_name')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('lastname', 'Last Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('last_name',null,array("placeholder"=>"Last Name",'id'=>'lastname','class'=>'form-control','maxlength'=>15,'autocomplete'=>'off')) !!} 
										<div id="lastname_alert" class="error validationAlert validationError">{!!$errors->first('last_name')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('email', 'Email')) !!}
										{!! Form::email('email',null, ["placeholder"=>"Email Address",'id'=>'email','class'=>'form-control']) !!}
										<div id="email_alert" class="error validationAlert validationError">{!!$errors->first('email')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('username', 'Username <small class="mandatory">*</small>')) !!}
										{!! Form::text('username',null,array("placeholder"=>"Username",'id'=>'username','class'=>'form-control','maxlength'=>15,'autocomplete'=>'off')) !!} 
										<div id="username_alert" class="error validationAlert validationError">{!!$errors->first('username')!!}</div>
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
    function validateUser()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

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

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

    function redirectUrl () {
    	doCancel("{!! URL::to('dashboard') !!}")
    }
</script>
@stop