@extends('layout.admin')
@section('content')
<section class="inner-form-wrapper">
	<div id="inner-wrapper">
        <div class="breadcrumb-wrapper container-fluid white-bg">
            <div class="row">
                <div class="col-lg-10 col-md-10">
                    <ol class="breadcrumb">
                        <li>
                            Voice
                        </li>
                        <li class="active">
                            <strong>Create Voice</strong>
                        </li>               
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-lg-12">
            		@include('voice.templates.inbondprocess')
                    <div class="panel-group" id="accordion">
	            		@include('voice.templates.fatal')
				
						@include('voice.templates.adherence')

	            		@include('voice.templates.quality')
            		</div>
            	</div>
            </div>
        </div>

  
	</div>
</section>
@stop