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
                    <form>
            		@include('voice.templates.inbondprocess')
                    <div class="panel-group" id="accordion">
                		@include('voice.templates.fatal')
    			
    					@include('voice.templates.adherence')

                		@include('voice.templates.quality')
            		</div>
                    <div class="form-action text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                    </form>
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