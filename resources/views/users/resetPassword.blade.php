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
						<a href="{!! URL::to('users') !!}">Manage Users</a>
					</li>
					<li class="active">
						<strong>Reset Password</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h4 class="page-header">Reset Password For {!! $user->first_name." ".$user->last_name !!}</h4>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::open(['url' => 'users/update-password' , 'onSubmit' => 'return validateUser()']) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									{!! Form::hidden('userId',$id) !!} 
										
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('password', 'New Password <small class="mandatory">*</small>')) !!}
										{!! Form::password('password',array('placeholder'=>'New Password','id'=>'password','class'=>'form-control','maxlength'=>15)) !!} 
										<div id="password_alert" class="error validationAlert validationError">{!!$errors->first('password')!!}</div>
									</div>	
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('password', 'Confirm Password <small class="mandatory">*</small>')) !!}
										{!! Form::password('confirmPassword',array('placeholder'=>'Password','id'=>'confirm_password','class'=>'form-control','maxlength'=>15)) !!} 
										<div id="confirm_password_alert" class="error validationAlert validationError">{!!$errors->first('confirmPassword')!!}</div>
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

        arrElemId[i]    = 'confirm_password';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_confirm_password");?>';
        i++;

        arrElemId[i]    = 'confirm_password';
        arrCode[i]      = 'EQUAL';
        arrRefValue[i]  = $("#password").val();
        arrMsg[i]       = '<?php echo Lang::get("messages.password_equal")?>';
        i++;

        arrElemId[i]    = 'confirm_password';
        arrCode[i]      = 'LENGTH_GREATER_EQUAL';
        arrRefValue[i]  = '<?php echo Config::get("global_vars.password_min_length")?>';
        arrMsg[i]       = '<?php echo Lang::get("messages.password_length")?>';
        i++;

      
        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

    function redirectUrl () {
    	doCancel("{!! URL::to('users') !!}")
    }
</script>
@stop