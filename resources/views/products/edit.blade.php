@extends('layout.admin')
@section('content')
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

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
						Product
					</li>
					<li>
						<a href="{!! URL::to('products') !!}">Manage Products</a>
					</li>
					<li class="active">
						<strong>Edit Product</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Product</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::model($product, array('method' => 'PATCH', 'route' => array('products.update', $product->id),'name'=>'frm','onsubmit'=>' return validateProduct()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3"> 						
										{!! HTML::decode( Form::label('productName', 'Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('productName',$product->name,array('placeholder'=>'Product Name','id'=>'productName','class'=>'form-control')) !!}
										<div id="productName_alert" class="error validationAlert validationError">{!!$errors->first('productName')!!}</div>
									</div>
									
									<div class="col-sm-3">											
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],$product->status,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
									<div class="col-sm-3"> 
										@if(count($product->productDepartment))
										<?php $selectedDepatment = [];?>
										@foreach($product->productDepartment as $value)
										<?php $selectedDepatment[]  = $value->department_id; ?>
										@endforeach
										@endif
										{!! HTML::decode(Form::label('departments', 'Department <small class="mandatory">*</small>')) !!}
										{!! Form::select('department[]',$data['department'],$selectedDepatment,['id'=>'department','class'=>'form-control','multiple'=>'multiple','size'=>5]) !!}
										<div id="department_alert" class="error validationAlert validationError">{!!$errors->first('department')!!}</div>
									</div>

									<div class="col-sm-3"> 
										<?php $selectedEmployee = [];?>
										@if(count($product->productExpert))
										@foreach($product->productExpert as $value)
										<?php $selectedEmployee[]  = $value->employee_id; ?>
										@endforeach
										@endif

										{!! HTML::decode(Form::label('employees', 'Experts <small class="mandatory">*</small>')) !!}
										{!! Form::select('employee[]',$data['employee'],$selectedEmployee,['id'=>'employee','class'=>'form-control','multiple'=>'multiple','size'=>5]) !!}
										<div id="employee_alert" class="error validationAlert validationError">{!!$errors->first('employee')!!}</div>
									</div>

									
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12"> 
										{!! HTML::decode(Form::label('Description', 'Description <small class="mandatory">*</small>'))!!}
										{!! Form::textarea('description',$product->description,['placeholder'=>'Description','id'=>'description','size' => '30x5','class'=>'form-control']) !!}
										<div id="description_alert" class="error validationAlert validationError">{!! $errors->first('description') !!}</div>
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
        CKEDITOR.replace( 'description' );

    function validateProduct()
    {
    	return true;
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
    	doCancel("{!! URL::to('products') !!}")
    }
</script>
@stop