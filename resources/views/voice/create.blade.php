@extends('layout.admin')
@section('content')
<section class="inner-form-wrapper">
	<div id="inner-wrapper">
		<div class="container-fluid">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-lg-12">
            		<div class="panel-group" id="accordion">
	            		@include('voice.templates.inbondprocess')

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