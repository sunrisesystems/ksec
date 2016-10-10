@extends('layout.admin')
@section('content')
<section class="inner-form-wrapper">
	<div id="inner-wrapper">
        <div class="breadcrumb-wrapper white-bg">
            <ol class="breadcrumb">
                <li>
                    Voice
                </li>
                <li class="active">
                    <strong>Create Voice</strong>
                </li>               
            </ol>               
        </div>
        
        <article>
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
        </article>

  
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        //$("#side-menu").hide();
        $("body").toggleClass("mini-navbar");
       // SmoothlyMenu();
    })
</script>
@stop