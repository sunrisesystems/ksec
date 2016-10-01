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
						Miscellaneous
					</li>
					<li>
						<a href="{!! URL::to('shapes') !!}">Manage Shapes</a>
					</li>
					<li class="active">
						<strong>Add Shape</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Shape</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::open(array('route' => 'shapes.store' , 'onSubmit' => 'return validateShape()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('shape_name', 'Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('shape_name',Request::old('shape_name'),array('placeholder'=>'Shape Name','id'=>'shape_name','class'=>'form-control')) !!}
										<div id="shape_name_alert" class="error validationAlert validationError">{!!$errors->first('shape_name')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('shape_code', 'Code <small class="mandatory">*</small>')) !!}
										{!! Form::text('shape_code',Request::old('shape_code'),array('placeholder'=>'Shape Code','id'=>'shape_code','class'=>'form-control')) !!}
										<div id="shape_code_alert" class="error validationAlert validationError">{!!$errors->first('shape_code')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$status,null,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 
										{!! Form::label('Description', 'Description')!!}
										{!! Form::textarea('shape_short_desc',Request::old('shape_short_desc'),['placeholder'=>'Shape Description','id'=>'shape_short_desc','size' => '30x5','class'=>'form-control']) !!}
										<div id="shape_short_desc_alert" class="error validationAlert validationError">{!! $errors->first('shape_short_desc') !!}</div>
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
    function validateShape()
    {
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

    function redirectUrl () {
    	doCancel("{!! URL::to('shapes') !!}")
    }
</script>
@stop