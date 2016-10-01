@extends('layout.admin')
@section('content')
<script>
function doCancel() {
    window.location.href = "{{URL::to('roles')}}";
}
</script>
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
						<a href="{!! route('roles.index')!!}">Manage Roles</a>
					</li>
					<li class="active">
						<strong>Edit Role</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Role</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->	
<div class="main-container-inner container-fluid">	
	<!-- Form row start -->
	<div class="row">
		<div class="col-md-12">
    <div class="widget">
      <!--<div class="widget-header">
		<div class="title"> <span class="fs1" data-icon="" aria-hidden="true"></span> Edit Role </div>
      </div>-->
<section id="inputDetail" class="form-container">
{!! Form::model($roleDTO->getSearchRoleDTO(), array('method' => 'PATCH', 'route' => array('roles.update', $roleDTO->getSearchRoleDTO()->id))) !!}


<div class="widget-body boxAlign noBorder roleAccess" id="allAccess">
	<div class="form-control-wrapper">
		<div class="form-group">
			<div class="row">
				<div class="col-md-4 col-xs-12">
				
				  {!! HTML::decode(Form::label('name', 'Roles<small class="mandatory">*</small>', array('class' => 'control-label'))) !!}
				  {!! Form::text('name',$roleDTO->getSearchRoleDTO()->name,array('class'=> 'form-control','placeholder' => 'Name')) !!}
				  @if($errors->has('name'))<div class="validationAlert" style="display:block">{{ $errors->first('name') }}</div>@endif
				
				</div>
			</div>
		</div>
	</div>
	<div class="gap"></div>
	<div class="permission-title">
		{!! HTML::decode(Form::label('','Permissions')) !!}
	</div>
	<div class="row">
		<ul class="col-md-3 col-xs-6">
			<?php
				$no=0;
				$defaultPermissionArr   = $roleDTO->getSearchRoleDTO()->getDefaultPermission();
				$totalCount=count($defaultPermissionArr);
			  
				$division=ceil($totalCount/4);
				
				$userPermission_ori         = $roleDTO->getSearchRoleDTO()->getPermission();
				$userPermission=array();
				foreach($userPermission_ori as $key=>$value)
				{

					foreach($value as $k=>$v)
					{
						$arr=explode('_', $v);
						$final=implode(" ", $arr);
						$final=ucfirst($final);
					 
						$userPermission[$key][$final]=$final;
					}
				}

				if(!empty($defaultPermissionArr)) 
				{


				//foreach($roleDTO->getSearchRoleDTO()->permissions as $keyPr => $valuePr) 
				foreach($defaultPermissionArr as $keyPr => $valuePr)     
				{
					$no++;
					$arr=explode('_', $keyPr);
					$string=implode(" ", $arr);
					$string=ucfirst($string);
						?>
						
					   <li><label> {!! $string !!}</label>
						 <ul class="col-lg-12 submenuBorder">
						<?php
						foreach ($valuePr as $key => $value) {

							$arr=explode('_', $value);
					$action=implode(" ", $arr);
					$action=ucfirst($action);
							 ?>
							 <li>
								<?php

							 if(!empty($userPermission[$keyPr][$action]))
							{
								  
								?>
							{!! Form::checkbox("permissions[$keyPr][$key]", $value , true) !!}  {!! $action !!}</li>
				   <?php
						}
						else
						{
							?>
							 {!! Form::checkbox("permissions[$keyPr][$key]", $value , false) !!}  {!! $action !!}</li>
					   <?php
						}
						?>

							 <?php
						}

			?>
			</ul>
			</li>
                   
				<?php 
				   
					if($no == $division)
					{
						 $no=0;
					?>
					</ul>
					<ul class="col-md-3 col-xs-6">
						<?php
					}
					?>
					
					<?php
				}
					} 
				?>
                   </div>

			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons">
					{!! Form::submit('Update', array('class' => 'btn btn-red','onClick'=>'clearMsg();')) !!}
					{!! Form::button('Cancel', array('class' => 'btn btn-black', 'onClick'=>'doCancel()')) !!}
				</div>
			</div>
        </div>
	</div>
{!! Form::close() !!}
</section>
</div>
</div>
</div>
</div>
@stop
