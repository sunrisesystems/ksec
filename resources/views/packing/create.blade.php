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
						Inventory
					</li>
					<li>
						Matrix
					</li>
					<li>
						<a href="{!! URL::to('packing') !!}">Manage Packing</a>
					</li>
					<li class="active">
						<strong>Add Packing</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Packing</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::open(array('route' => 'packing.store' , 'onSubmit' => 'return validatePacking()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('product', 'Product <small class="mandatory">*</small>')) !!}
										{!! Form::select('product_id',$data['product'],null,['id'=>'product_id','class'=>'form-control']) !!}
										<div id="product_id_alert" class="error validationAlert validationError">{!!$errors->first('product_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('item', 'Box Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('box_type',$data['boxType'],null,['id'=>'box_type','class'=>'form-control']) !!}
										<div id="box_type_alert" class="error validationAlert validationError">{!!$errors->first('box_type')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('type_of_packing', 'Type Of Packing <small class="mandatory">*</small>')) !!}
										{!! Form::select('type_of_packing',$data['typeOfPacking'],null,['id'=>'type_of_packing','class'=>'form-control']) !!}
										<div id="type_of_packing_alert" class="error validationAlert validationError">{!!$errors->first('type_of_packing')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('qty_per_box', 'Quantity Per Box <small class="mandatory">*</small>')) !!}
										{!! Form::text('qty_per_box',null,array('placeholder'=>'Quantity Per Box','id'=>'qty_per_box','class'=>'form-control','maxlength'=>5)) !!}
										<div id="qty_per_box_alert" class="error validationAlert validationError">{!!$errors->first('qty_per_box')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],'A',['id'=>'status','class'=>'form-control']) !!}
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
    function validateItem()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'product_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_product")?>';
        i++;

        arrElemId[i]    = 'box_type';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.select_box_type")?>';
        i++;

        arrElemId[i]    = 'type_of_packing';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.select_type_of_packing")?>';
        i++;

        arrElemId[i]    = 'qty_per_box';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_qty_per_box")?>';
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
    	doCancel("{!! URL::to('packing') !!}")
    }

    $("#qty_per_box").ForceNumericOnly();
</script>
@stop