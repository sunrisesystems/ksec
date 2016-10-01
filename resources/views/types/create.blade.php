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
						Miscellaneous
					</li>
					<li>
						<a href="{!! route('types.index')!!}">Manage Types</a>
					</li>
					<li class="active">
						<strong>Add Type</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Type</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
	<div class="main-container-inner container-fluid">
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="typeDetail" class="form-container">
						{!! Form::open(array('route' => 'types.store' , 'onSubmit' => 'return validateType()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('status', 'Group <small class="mandatory">*</small>')) !!}
										{!! Form::select('group_id',$data['group'],null,['id'=>'group_id','class'=>'form-control','onchange'=>'checkGroup(this.value)']) !!}
										<div id="group_id_alert" class="error validationAlert validationError">{!!$errors->first('group_id')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('type', 'Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('type',null,array('placeholder'=>'Type Name','id'=>'type','class'=>'form-control')) !!}
										<div id="type_alert" class="error validationAlert validationError">{!!$errors->first('type')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
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
    function validateType()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        /*arrElemId[i]    = 'group_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.select_group")?>';
        i++;*/

        arrElemId[i]    = 'type';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_type")?>';
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
    	doCancel("{!! URL::to('types') !!}")
    }

    function checkGroup (val) {
    	if(val == 3){
		    $('#type').keyup(function() {
		        $(this).val($(this).val().toUpperCase());
		    });
    	}else{
    		$( "#type").unbind( "keyup" );
    	}
    	
    }
</script>
@stop 