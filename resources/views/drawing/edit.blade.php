@extends('layout.admin')
@section('content')
<?php 
//echo "<pre>";
//print_r($errors);?>
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
						<a href="{!! route('drawings.index')!!}">Manage Drawings</a>
					</li>
					<li class="active">
						<strong>Edit Drawing</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Drawing</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <section id="drawingDetail" class="form-container">
			{!! Form::model($drawing,array('method' => 'PATCH','route' => array('drawings.update',$drawing->id) , 'onSubmit' => 'return validateCategory()','files'=>true)) !!}
				<div class="form-control-wrapper" >
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode( Form::label('drawing_no', 'Drawing No. <small class="mandatory">*</small>')) !!}
								{!! Form::text('drawing_no',null,array('class' => 'form-control','placeholder'=>'Drawing No.','id'=>'drawing_no')) !!}
								<div id="drawing_no_alert" class="error validationAlert validationError">{!!$errors->first('drawing_no')!!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode(Form::label('PreformConditioning', 'Preform Conditioning <small class="mandatory">*</small>'))!!}
								{!! Form::select('preform_condition_id',$data['preformCondition'],null,['id'=>'preform_condition_id','class' => 'form-control']) !!}
								<div id="preform_condition_id_alert" class="error validationAlert validationError">{!! $errors->first('preform_condition_id') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode(Form::label('BlowConditioning', 'Blow Conditioning <small class="mandatory">*</small>'))!!}
								{!! Form::select('blow_condition_id',$data['blowCondition'],null,['id'=>'blow_condition_id','class' => 'form-control']) !!}
								<div id="blow_condition_id_alert" class="error validationAlert validationError">{!!$errors->first('blow_condition_id')!!}</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode( Form::label('bottle_shape', 'Bottle Shape <small class="mandatory">*</small>')) !!}
								{!! Form::select('bottle_shape_id',$data['shape'],null,['id'=>'bottle_shape_id','class' => 'form-control']) !!}
								<div id="bottle_shape_id_alert" class="error validationAlert validationError">{!! $errors->first('bottle_shape_id') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('neck_type', 'Neck Type <small class="mandatory">*</small>')) !!}
								{!! Form::select('neck_type_id',$data['type'],null,['id'=>'neck_type_id','class' => 'form-control']) !!}
								<div id="neck_type_id_alert" class="error validationAlert validationError">{!! $errors->first('neck_type_id') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('neck_size', 'Neck Size (mm)<small class="mandatory">*</small>')) !!}
								{!! Form::select('neck_size_id',$data['neckSize'],null,['id'=>'neck_size_id','class' => 'form-control']) !!}
								<div id="neck_size_id_alert" class="error validationAlert validationError">{!! $errors->first('neck_size_id') !!}</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">	
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Standard Cycle Time (sec) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('sct_l',null,array('placeholder'=>'Low','id'=>'sct_l','class' => 'form-control')) !!}
											<div id="sct_l_alert" class="error validationAlert validationError">{!!$errors->first('sct_l')!!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('sct_c',null,array('placeholder'=>'Center','id'=>'sct_c','class' => 'form-control')) !!}
											<div id="sct_c_alert" class="error validationAlert validationError">{!! $errors->first('sct_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('sct_h',null,array('placeholder'=>'High','id'=>'sct_h','class' => 'form-control')) !!}
											<div id="sct_h_alert" class="error validationAlert validationError">{!!$errors->first('sct_h')!!}</div>
										</div>
									</div>
								</div> 	
							</div>
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">
									<div class="row">								
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Standard Weight (g) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('std_wt_l',null,array('placeholder'=>'Low','id'=>'std_wt_l','class' => 'form-control')) !!}
											<div id="std_wt_l_alert" class="error validationAlert validationError">{!! $errors->first('std_wt_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('std_wt_c',null,array('placeholder'=>'Center','id'=>'std_wt_c','class' => 'form-control')) !!}
											<div id="std_wt_c_alert" class="error validationAlert validationError">{!! $errors->first('std_wt_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('std_wt_h',null,array('placeholder'=>'High','id'=>'std_wt_h','class' => 'form-control')) !!}
											<div id="std_wt_h_alert" class="error validationAlert validationError">{!! $errors->first('std_wt_h') !!}</div>
										</div>	
									</div>
								</div> 	
							</div>
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Drawing Weight (g) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('drawing_wt_l',null,array('placeholder'=>'Low','id'=>'drawing_wt_l','class' => 'form-control')) !!}
											<div id="drawing_wt_l_alert" class="error validationAlert validationError">{!! $errors->first('drawing_wt_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('drawing_wt_c',null,array('placeholder'=>'Center','id'=>'drawing_wt_c','class' => 'form-control')) !!}
											<div id="drawing_wt_c_alert" class="error validationAlert validationError">{!! $errors->first('drawing_wt_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('drawing_wt_h',null,array('placeholder'=>'High','id'=>'drawing_wt_h','class' => 'form-control')) !!}
											<div id="drawing_wt_h_alert" class="error validationAlert validationError">{!! $errors->first('drawing_wt_h') !!}</div>
										</div>	
									</div>
								</div> 	
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">	
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Body Diameter (mm) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('body_diameter_l',null,array('placeholder'=>'Low','id'=>'body_diameter_l','class'=>'form-control')) !!}
											<div id="body_diameter_l_alert" class="error validationAlert validationError">{!! $errors->first('body_diameter_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('body_diameter_c',null,array('placeholder'=>'Center','id'=>'body_diameter_c','class'=>'form-control')) !!}
											<div id="body_diameter_c_alert" class="error validationAlert validationError">{!! $errors->first('body_diameter_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('body_diameter_h',null,array('placeholder'=>'High','id'=>'body_diameter_h','class'=>'form-control')) !!}
											<div id="body_diameter_h_alert" class="error validationAlert validationError">{!! $errors->first('body_diameter_h') !!}</div>
										</div>	
									</div>
								</div> 	
							</div>
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">	
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Product Height (mm) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('height_l',null,array('placeholder'=>'Low','id'=>'height_l','class'=>'form-control')) !!}
											<div id="height_l_alert" class="error validationAlert validationError">{!! $errors->first('height_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('height_c',null,array('placeholder'=>'Center','id'=>'height_c','class'=>'form-control')) !!}
											<div id="height_c_alert" class="error validationAlert validationError">{!! $errors->first('height_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('height_h',null,array('placeholder'=>'High','id'=>'height_h','class'=>'form-control')) !!}
											<div id="height_h_alert" class="error validationAlert validationError">{!! $errors->first('height_h') !!}</div>
										</div>
									</div>
								</div> 	
							</div>
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Overflow Capacity (ml) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('ofc_l',null,array('placeholder'=>'Low','id'=>'ofc_l','class'=>'form-control','maxlength'=>5)) !!}
											<div id="ofc_l_alert" class="error validationAlert validationError">{!! $errors->first('ofc_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('ofc_c',null,array('placeholder'=>'Center','id'=>'ofc_c','class'=>'form-control','maxlength'=>5)) !!}
											<div id="ofc_c_alert" class="error validationAlert validationError">{!! $errors->first('ofc_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('ofc_h',null,array('placeholder'=>'High','id'=>'ofc_h','class'=>'form-control','maxlength'=>5)) !!}
											<div id="ofc_h_alert" class="error validationAlert validationError">{!! $errors->first('ofc_h') !!}</div>
										</div>	
									</div>
								</div> 	
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">	
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Fill Point Capacity (ml) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('fpc_l',null,array('placeholder'=>'FPC-L','id'=>'fpc_l','class'=>'form-control','maxlength'=>5)) !!}
											<div id="fpc_l_alert" class="error validationAlert validationError">{!! $errors->first('fpc_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('fpc_c',null,array('placeholder'=>'FPC-C','id'=>'fpc_c','class'=>'form-control','maxlength'=>5)) !!}
											<div id="fpc_c_alert" class="error validationAlert validationError">{!! $errors->first('fpc_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('fpc_h',null,array('placeholder'=>'FPC-H','id'=>'fpc_h','class'=>'form-control','maxlength'=>5)) !!}
											<div id="fpc_h_alert" class="error validationAlert validationError">{!! $errors->first('fpc_h') !!}</div>
										</div>	
									</div>
								</div> 	
							</div>
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">	
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('ct_l', 'Neck Height (mm) <small class="mandatory">*</small>')) !!}
										</div>
										<div class="col-sm-4">						
											{!! Form::text('neck_height_l',null,array('placeholder'=>'Low','id'=>'neck_height_l','class'=>'form-control')) !!}
											<div id="neck_height_l_alert" class="error validationAlert validationError">{!! $errors->first('neck_height_l') !!}</div>
										</div>
										<div class="col-sm-4">					
											{!! Form::text('neck_height_c',null,array('placeholder'=>'Center','id'=>'neck_height_c','class'=>'form-control')) !!}
											<div id="neck_height_c_alert" class="error validationAlert validationError">{!! $errors->first('neck_height_c') !!}</div>
										</div>
										<div class="col-sm-4">						
											{!! Form::text('neck_height_h',null,array('placeholder'=>'High','id'=>'neck_height_h','class'=>'form-control')) !!}
											<div id="neck_height_h_alert" class="error validationAlert validationError">{!! $errors->first('neck_height_h') !!}</div>
										</div>
									</div>
								</div> 	
							</div>
							<div class="col-md-4 col-sm-4">					
								<div class="triple-gp-wraper">
									<div class="row">
										<div class="col-md-12 col-sm-12">
											{!! HTML::decode( Form::label('std_purging', 'Standard Purging <small class="mandatory">*</small>')) !!}
										</div>		
										<div class="col-md-12 col-sm-12">
											{!! Form::text('std_purging',null,array('placeholder'=>'Standard Purging - Center','id'=>'std_purging','class'=>'form-control')) !!}
											<div id="std_purging_alert" class="error validationAlert validationError">{!! $errors->first('std_purging') !!}</div>
										</div>
									</div>
								</div> 	
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode( Form::label('std_cavities', 'Standard Cavities (#) <small class="mandatory">*</small>')) !!}
								{!! Form::text('std_cavities',null,array('placeholder'=>'STD Cavities','id'=>'std_cavities','class'=>'form-control')) !!}
								<div id="std_cavities_alert" class="error validationAlert validationError">{!! $errors->first('std_cavities') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('std_cavitiy_blocks', 'Standard Cavity Blocks (#) <small class="mandatory">*</small>')) !!}
								{!! Form::text('std_cavitiy_blocks','0',array('placeholder'=>'Standard Cavity Blocks','id'=>'std_cavitiy_blocks','class'=>'form-control','readonly'=>true)) !!}
								<div id="std_cavitiy_blocks_alert" class="error validationAlert validationError">{!!$errors->first('std_cavitiy_blocks')!!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('min_wall_thickness', 'Min Wall Thickness (mm) <small class="mandatory">*</small>')) !!}
								{!! Form::text('min_wall_thickness',null,array('placeholder'=>'Min Wall Thickness','id'=>'min_wall_thickness','class'=>'form-control')) !!}
								<div id="min_wall_thickness_alert" class="error validationAlert validationError">{!! $errors->first('min_wall_thickness') !!}</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode( Form::label('avg_wall_thickness', 'Avg Wall Thickness (mm) <small class="mandatory">*</small>')) !!}
								{!! Form::text('avg_wall_thickness',null,array('placeholder'=>'Avg Wall Thickness','id'=>'avg_wall_thickness','class'=>'form-control')) !!}
								<div id="avg_wall_thickness_alert" class="error validationAlert validationError">{!! $errors->first('avg_wall_thickness') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('num_of_thread_turns', 'No.Of Thread Turns <small class="mandatory">*</small>')) !!}
								{!! Form::text('num_of_thread_turns',null,array('placeholder'=>'No.Of Thread Turns','id'=>'num_of_thread_turns','class'=>'form-control')) !!}
								<div id="num_of_thread_turns_alert" class="error validationAlert validationError">{!! $errors->first('num_of_thread_turns') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('std_rejection', 'Standard Rejection<small class="mandatory">*</small>')) !!}
								{!! Form::text('std_rejection',null,array('placeholder'=>'Standard Rejection - Center','id'=>'std_rejection','class'=>'form-control')) !!}
								<div id="std_rejection_alert" class="error validationAlert validationError">{!! $errors->first('std_rejection') !!}</div>
							</div>
						</div>
					</div>
					

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode( Form::label('complete_mold_changeover', 'Complete Mold Changeover (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('complete_mold_changeover',null,array('placeholder'=>'Complete Mold Changeover','id'=>'complete_mold_changeover','class'=>'form-control')) !!}
								<div id="complete_mold_changeover_alert" class="error validationAlert validationError">{!! $errors->first('complete_mold_changeover') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('partial_mold_changeover', 'Partial Mold Changeover (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('partial_mold_changeover',null,array('placeholder'=>'Partial Mold Changeover','id'=>'partial_mold_changeover','class'=>'form-control')) !!}
								<div id="partial_mold_changeover_alert" class="error validationAlert validationError">{!! $errors->first('partial_mold_changeover') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('blow_mold_changeover', 'Blow Mold Changeover (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('blow_mold_changeover',null,array('placeholder'=>'Blow Mold Changeover','id'=>'blow_mold_changeover','class'=>'form-control')) !!}
								<div id="blow_mold_changeover_alert" class="error validationAlert validationError">{!! $errors->first('blow_mold_changeover') !!}</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! HTML::decode( Form::label('injection_mold_changeover', 'Injection Mold Changeover (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('injection_mold_changeover',null,array('placeholder'=>'Injection Mold Changeover','id'=>'injection_mold_changeover','class'=>'form-control')) !!}
								<div id="injection_mold_changeover_alert" class="error validationAlert validationError">{!! $errors->first('injection_mold_changeover') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('base_mold_changeover', 'Base Mold Changeover (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('base_mold_changeover',null,array('placeholder'=>'Base Mold Changeover','id'=>'base_mold_changeover','class'=>'form-control')) !!}
								<div id="base_mold_changeover_alert" class="error validationAlert validationError">{!! $errors->first('base_mold_changeover') !!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('partial_mold_changeover_a', 'Partial Mold Changeover (A) (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('partial_mold_changeover_a',null,array('placeholder'=>'Partial Mold Changeover (A)','id'=>'partial_mold_changeover_a','class'=>'form-control')) !!}
								<div id="partial_mold_changeover_a_alert" class="error validationAlert validationError">{!! $errors->first('partial_mold_changeover_a') !!}</div>
							</div>
						</div>
					</div>


					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('partial_mold_changeover_b', 'Partial Mold Changeover (A) (hrs)<small class="mandatory">*</small>')) !!}
								{!! Form::text('partial_mold_changeover_b',null,array('placeholder'=>'Partial Mold Changeover (B)','id'=>'partial_mold_changeover_b','class'=>'form-control')) !!}
								<div id="partial_mold_changeover_b_alert" class="error validationAlert validationError">{!! $errors->first('partial_mold_changeover_b') !!}</div>
							</div>

							<div class="col-sm-4"> 
								{!! HTML::decode(Form::label('Manufacturer', 'Manufacturer <small class="mandatory">*</small>'))!!}
								{!! Form::select('manufacturer_id',$data['units'],null,['id'=>'manufacturer_id','class' => 'form-control']) !!}
								<div id="manufacturer_id_alert" class="error validationAlert validationError">{!!$errors->first('manufacturer_id')!!}</div>
							</div>
							<div class="col-sm-4"> 						
								{!! HTML::decode(Form::label('Status', 'Status <small class="mandatory">*</small>'))!!}
								{!! Form::select('status',$data['status'],null,['id'=>'status','class' => 'form-control']) !!}
								<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 
								{!! HTML::decode( Form::label('Drawing File', 'Drawing File <small class="mandatory">*</small>')) !!}
								{!! Form::file('drawing_file',['id'=>'drawing_file','class'=>'form-control']) !!}
								<div id="drawing_file_alert" class="error validationAlert validationError">{!!$errors->first('drawing_file')!!}</div>
							</div>
							

							<div class="col-sm-4"> 
								{!! Form::label('Attachments', 'Attachments')!!}
								{!! Form::file('attachments[]',['id'=>'attachments','class'=>'form-control','multiple'=>true]) !!}
								<div id="attachments_alert" class="error validationAlert validationError">{!! $errors->first('attachments') !!}</div>
								@if(count($drawingAttachments))
								@foreach($drawingAttachments as $attachment)
								<span id="attachment_{!! $attachment->id !!}">
									<a data-toggle="tooltip" data-placement="bottom" title="Download Drawing" href="{!! URL::to('admin/download-attachment/'.$attachment->drawing_id.'/'.$attachment->id) !!}" class="download">{!! "Download ".$attachment->file_name !!}
									</a>
									<a data-toggle="tooltip" data-placement="bottom" title="Download Drawing" href="javascript:void(0)" class="download" onclick="deleteAttachment('{!! $attachment->id !!}')"><i class="glyphicon glyphicon-trash"></i> 
									</a>
								</span><br>
								@endforeach
								@endif
							</div>
							<div class="col-sm-4"> 						

							</div>
							<div class="col-sm-4"> 
								
							</div>
							
						</div>
					</div>
					<!-- action wrapper -->
					<div class="form-group action">
						<div class="col-lg-12 pull-center buttons"> 
							{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
							{!! Form::button('Cancel', ['class' => 'btn btn-black','onclick'=>'redirectUrl()']) !!} 
						</div>
					</div>
				</div>
			{!! Form::close() !!} 
			</section><!-- drawingDetail end -->
          </div>
        </div>
    </div><!--- main-container inner end -->
</div><!--- main-container end -->
<script type="text/javascript">
	function deleteAttachment (id) {
		$.ajax({
            url : base_url+"/admin/delete-attachment/"+id,
            method : "get",
            cache : false,
            beforeSend : function(){
                $("#preloader").show();
            },
            success:function(data){
                //$("#loading").hide();
                if(data.success == 1){
                	$("#attachment_"+id).remove();	
                }else{
                	jAlert(data.data,"Error!");
                }
            },
            done : function (data){
                $("#loading").hide();
                
            },
            fail :function () {
                $("#loading").hide();
                alert("error")
            }
        });
	}
/*    function validateCategory()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'cname';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.cat_req")?>';
        i++;



        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }*/

    function redirectUrl () {
    	doCancel("{!! URL::to('drawings') !!}")
    }

    $("#std_rejection,#std_purging,#sct_h,#sct_c,#sct_l,#std_cavities,#std_cavitiy_blocks,#std_wt_h,#std_wt_c,#std_wt_l,#drawing_wt_h,#drawing_wt_c,#drawing_wt_l,#min_wall_thickness,#avg_wall_thickness,#body_diameter_h,#body_diameter_c,#body_diameter_l,#height_h,#height_c,#height_l,#ofc_h,#ofc_c,#ofc_l,#fpc_h,#fpc_c,#fpc_l,#neck_height_h,#neck_height_c,#neck_height_l").ForceNumericOnly();

   	$('#ofc_l,#ofc_c,#ofc_h,#fpc_h,#fpc_c,#fpc_l').blur(function(){
    	if($(this).val() != ''){
    		var num = parseFloat($(this).val());
	    	var cleanNum = num.toFixed(1);
	    	$(this).val(cleanNum);
    	}
    });
</script>
@stop 