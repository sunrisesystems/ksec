@extends('layout.admin')
@section('content')	
<section class="login-container">				
	{!! Form::open(array('action'=>'AdminController@postLogin','method'=>'POST', 'class'=>'form-signin','onsubmit' => 'return validateLoginForm()')) !!}				
		<header>
			<h2>Login</h2>
		</header>
		<fieldset>
			@if(Session::has('message'))
		    	<div id="msg" class="{!! Session::get('class') !!}">{!! Session::get('message') !!}</div>
		    @endif
			<section>											
				{!! HTML::decode( Form::label('systemId', 'System ID <small class="mandatory">*</small>')) !!}
				<label class="input">
					{!! Form::text('systemId', null, ['class'=>'form-control', 'id'=>'systemId']) !!}
					<i class="icon-append fa fa-user"></i>
				</label>
				<div class="validationAlert" id="systemId_alert"> {{$errors->first('systemId')}}</div>				
			</section>
			<section>			
				{!! HTML::decode( Form::label('password', 'Password <small class="mandatory">*</small>')) !!}
				<label class="input">
					{!! Form::password('password', ['class'=>'form-control','id'=>'password']) !!}
					<i class="icon-append fa fa-lock"></i>
				</label>
				<div class="validationAlert" id="password_alert"> {{$errors->first('password')}}</div>				
			</section>
		</fieldset>	
		<!-- <div class="form-group">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<input type="checkbox" name="remember">
						{-- Form::checkbox('remember','Y', null) --}
						<span class="check">Remember me </span>
					</div>
				</div>
			</div> -->
			<!-- <div class="form-group">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						{!! HTML::link('admin/forgotpassword', 'Forgot Password ?', array('class' => 'link has-black')) !!}
					</div>
				</div>
			</div> -->
		<footer>
			{!! Form::submit('Login', array('id' => 'submit','class' => 'btn btn-primary','name' => 'submit')) !!}
		</footer>
	{!! Form::close() !!}
</section>
<script type="text/javascript">
	function validateLoginForm() {
	  clearAlertMsg();
	  var arrElemId = Array();
	  var arrCode = Array();
	  var arrRefValue = Array();
	  var arrMsg = Array();
	  var i = 0 ;
	  
	  arrElemId[i] = 'unit';
	  arrCode[i] = 'IS_EMPTY'; 
	  arrRefValue[i] = null;
	  arrMsg[i] = "<?php echo Lang::get('messages.empty_unit');?>";
	  i++;


	  arrElemId[i] = 'username';
	  arrCode[i] = 'IS_EMPTY'; 
	  arrRefValue[i] = null;
	  arrMsg[i] = "<?php echo Lang::get('messages.empty_username');?>";
	  i++;

	/*    arrElemId[i] = 'username';
	  arrCode[i] = 'IS_EMPTY'; 
	  arrRefValue[i] = null;
	  arrMsg[i] = "<?php echo Lang::get('messages.invalid_username');?>";
	  i++;*/
	  
	  arrElemId[i] = 'password';
	  arrCode[i] = 'IS_EMPTY'; 
	  arrRefValue[i] = null;
	  arrMsg[i] = "<?php echo Lang::get('messages.empty_password');?>";
	  i++;
	  
	  
	  result = validate( document.forms[0] , arrElemId , arrCode , arrRefValue , arrMsg );
	  
	  return result;
	}
</script>
@stop