@extends('layout.admin')
@section('content')

<div class="smallbox"> 
	<div class="container">
		<div class="form-container">
				<div class="innerContainer">
					<div class="login-logo">
						<h1>Kotak Securities</h1>
					</div>
					{!! Form::open(array('action'=>'AdminController@postLogin','method'=>'POST', 'class'=>'form-signin','onsubmit' => 'return validateLoginForm()')) !!}				
					<div class="form-heading">
						<h2 class="title">Login</h2>
					</div>
					@if(Session::has('message'))
                    <div id="msg" class="{!! Session::get('class') !!}">{!! Session::get('message') !!}</div>
                    @endif
					<div class="form-control-wrapper">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12 col-sm-12">											
									{!! HTML::decode( Form::label('systemId', 'System ID <small class="mandatory">*</small>')) !!}
									{!! Form::text('systemId', null, ['class'=>'form-control', 'placeholder'=>'system ID','id'=>'systemId']) !!}
									<div class="validationAlert" id="systemId_alert"> {{$errors->first('systemId')}}</div>
								</div>							
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12 col-sm-12"> 
									{!! HTML::decode( Form::label('password', 'Password <small class="mandatory">*</small>')) !!}
									{!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password','id'=>'password']) !!}
									<div class="validationAlert" id="password_alert"> {{$errors->first('password')}}</div>									
								</div>								
							</div>
						</div>
					</div>
					
				<!-- 	<div class="form-group">
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
					<div class="form-group action">
						<div class="col-lg-12 pull-center buttons"> 
							{!! Form::submit('Login', array('id' => 'submit','class' => 'btn btn-red','name' => 'submit')) !!}
						</div>
					</div>
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

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