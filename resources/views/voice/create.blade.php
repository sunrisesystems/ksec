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
            		<div id="inbondForm" class="panel panel-default">
            			<div class="panel-heading">
            				<h2>Form Heading</h2>
            			</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="col-lg-12">
            						<!-- Form 1 -->
            						<form>      
            							<div class="row">
            							<div class="col-lg-3">  							
	            							<div class="form-group">
	                                            <label for="transaction-id">Transaction ID</label>
	                                            <input class="form-control" type="text" id="transactionID" placeholder="Transaction ID">
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="date">Date</label>
	                                            <input class="form-control" type="text" id="date" placeholder="Date">
	                                        </div>
                                        </div>
                                        </div>
                                        <div class="form-wrapper row">
	                                        <div class="col-lg-3">
		                                        <div class="form-group">
		                                            <label>Process</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Agent</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Team Leader</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Manager</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
	                                        </div>
	                                        <div class="col-lg-3">
	                                        	<div class="form-group">
		                                            <label>Category</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="client-id">Client ID</label>
                                        			<input class="form-control" type="text" id="clientID" placeholder="Client ID">
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="call-id">Call ID</label>
                                        			<input class="form-control" type="text" id="callID" placeholder="Call ID">
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="duration">Duration</label>
                                        			<input class="form-control" type="text" id="duration" placeholder="Duration">
		                                        </div>
	                                        </div>
	                                        <div class="col-lg-3">
	                                        	<div class="form-group">
		                                            <label>Call Type</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Sub-Call Type</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
	                                        </div>
                                        </div>
            						</form>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div><!-- .inbond -->

            	<div id="inbondForm" class="panel panel-default">
            			<div class="panel-heading">
            				<h2>Form Heading</h2>
            			</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="col-lg-12">
            						<!-- Form 1 -->
            						<form>      
            							<div class="row">
            							<div class="col-lg-3">  							
	            							<div class="form-group">
	                                            <label for="transaction-id">Transaction ID</label>
	                                            <input class="form-control" type="text" id="transactionID" placeholder="Transaction ID">
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="date">Date</label>
	                                            <input class="form-control" type="text" id="date" placeholder="Date">
	                                        </div>
                                        </div>
                                        </div>
                                        <div class="form-wrapper row">
	                                        <div class="col-lg-3">
		                                        <div class="form-group">
		                                            <label>Process</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Agent</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Team Leader</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Manager</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
	                                        </div>
	                                        <div class="col-lg-3">
	                                        	<div class="form-group">
		                                            <label>Category</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="client-id">Client ID</label>
                                        			<input class="form-control" type="text" id="clientID" placeholder="Client ID">
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="call-id">Call ID</label>
                                        			<input class="form-control" type="text" id="callID" placeholder="Call ID">
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="duration">Duration</label>
                                        			<input class="form-control" type="text" id="duration" placeholder="Duration">
		                                        </div>
	                                        </div>
	                                        <div class="col-lg-3">
	                                        	<div class="form-group">
		                                            <label>Call Type</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Sub-Call Type</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
	                                        </div>
                                        </div>
            						</form>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div><!-- .panel -->
            </div>
        </div>
	</div>
</section>
@stop