@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'moldName';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_mold_name")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;
	}
</script>
<!-- Container Start -->
<div id="main-container" class="main-container container">
	<div class="main-container-inner">
		<div class="row pageHeading">
			<div class="col-xs-12">
				<div class="page-title-wrapper">
					<h1 class="page-header">Manage Molds</h1>
					<div class="right-actions">
						<a data-toggle="tooltip" data-placement="bottom" title="Add Mold" class=" add-mold add-icons" href="{!! route('mold.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> 
						</a>
						<a data-toggle="tooltip" data-placement="bottom" title="Search Filter" class=" search-filter" href="javascript:void(0)">
							<i class="glyphicon glyphicon-filter"></i> 
						</a>
					</div>
				</div>
			</div>
		</div><!-- pageHeading end -->
		<div class="{!! Session::get('class') !!}" id="message">
			<div class="row pageHeading">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@if(count($molds))
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th align="right">#</th>
								<th align="left">Name</th>
								<th align="left">Status</th>
								<th align="center">Actions</th>
							</tr>
						</thead>
						<?php $count= ($molds->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
						  ?>
						  @foreach($molds as $key)						
						<tbody>
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td>{!! $key->mold_name !!}</td>
								<td>{!! $key->status !!}</td>
								<td align="center">
								
								<a href="{!! URL::to('mold/'.$key->id.'/edit') !!}" class="mold"> 
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								{!! Form::open(array('id'=>'destroyMold'.$key->id,'method' => 'DELETE', 'route' => array('mold.destroy', $key->id))) !!}
								<a class="confirmbox" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
									<i class="glyphicon glyphicon-trash"></i> 
								</a>
								{!! Form::close() !!}
								</td>							
							</tr>
						@endforeach
						</tbody>
					</table><!-- table end -->
					{!! $molds->appends(Request::except('page'))->render() !!}
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif
			</div>
		</div><!-- row end -->
	</div><!-- container-inner end -->
</div><!-- container end -->

  
<script>
    $("#message").fadeOut(5000);
</script>
<script>
function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this Mold?", '', function(r) {
        if (r) {
    		$('#destroyMold'+id).submit();
        }
    });
}
</script>
@stop