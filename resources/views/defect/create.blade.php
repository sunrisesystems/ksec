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
						<a href="{!! URL::to('defect') !!}">Manage Defect</a>
					</li>
					<li class="active">
						<strong>Add Defect</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Defect</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
	
    <div class="main-container-inner container-fluid">
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::open(array('route' => 'defect.store' , 'onSubmit' => 'return validateDefect()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('defectNature', 'Defect Nature <small class="mandatory">*</small>')) !!}						
										{!! Form::select('defect_nature_id', $data['defectNature'], null, ['id'=>'defect_nature_id','class'=>'form-control']) !!}
										<div id="defect_nature_id_alert" class="error validationAlert validationError">{!!$errors->first('defect_nature_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('rejectionReason', 'Defect Reason <small class="mandatory">*</small>')) !!}						
										{!! Form::select('defect_reason_id',$data['defectReason'], null, ['id'=>'defect_reason_id','class'=>'form-control']) !!}
										<div id="defect_reason_id_alert" class="error validationAlert validationError">{!!$errors->first('defect_reason_id')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('rejection', 'Defect <small class="mandatory">*</small>')) !!}
										{!! Form::text('defect',null,array("placeholder"=>"Defect",'id'=>'defect','class'=>'form-control')) !!}
										<div id="defect_alert" class="error validationAlert validationError">{!!$errors->first('defect')!!}</div>
									</div>								
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}						
										{!! Form::select('status', $data['status'], null, ['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>

									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('ccb', 'Cause Cavity Block <small class="mandatory">*</small>')) !!}						
										{!! Form::select('ccb', $data['ccb'], null, ['id'=>'ccb','class'=>'form-control']) !!}
										<div id="ccb_alert" class="error validationAlert validationError">{!!$errors->first('ccb')!!}</div>
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
    function validateDefect()
    {
    	return true;
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'color';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_color")?>';
        i++;

        arrElemId[i]    = 'status';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_status")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

    function redirectUrl(){
    	doCancel("{!! URL::to('defect') !!}")
    }
</script>
@stop