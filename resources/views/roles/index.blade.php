@extends('layout.admin')
@section('content')

<!-- Container Start -->
<div id="main-container" class="main-container ">
	<div class="breadcrumb-wrapper">		
		<ol class="breadcrumb">
			<li>
				Product
			</li>
			<li class="active">
				<strong>Manage Roles</strong>
			</li>				
		</ol>			
		<!-- <div class="col-lg-2 col-md-2 align-right">
			<a title="Close Filter" class="btn btn-white close-filter" style="display:none;" href="javascript:void(0)">
				<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> Close</span>
			</a>
		</div> -->		
	</div>
	<header class="page-header-wrapper">
		<div class="page-heading">
			<h2>Manage Roles</h2>
		</div>
	</header>
	<div class="clearfix"></div>
	
	<div class="main-container-inner container-fluid">
		@if(Session::has('message'))
		<div class="{!! Session::get('class') !!}" id="">
			<div class="row pageHeading">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-xs-12">
				@if(count($roles))
				<?php $count = 1; ?>
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>								
								<th class="right">#</th>
								<th class="left">Name</th>
								<th class="center">Actions</th>
							</tr>
						</thead>
						@foreach($roles as $key)						
						<tbody>
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td align="left">{!! $key->name !!}</td>
								<td align="center" class="action-icon">	
								@if($key->id != 1)
								<!-- <a href="{!! URL::to('roles/'.$key->id.'/edit') !!}" class="space"> 
									<i class="glyphicon glyphicon-pencil"></i>
								</a> -->
								@endif
								</td>							
							</tr>
						@endforeach
						</tbody>
					</table><!-- table end -->
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif
			</div>
		</div><!-- row end -->
	</div><!-- container-inner end -->
</div><!-- container end -->
@stop