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
            		<article id="inbondForm" class="panel panel-default">
            			<h2>Form Heading</h2>
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
            		</article><!-- #inbond -->

            		<article id="fatal" class="panel panel-default">            			
        				<h2>Fatal</h2>            			
            			<div class="panel-body">
            				<div class="row">
            					<div class="col-lg-12">
            						<!-- Form 1 -->
            						<form>      
                                        <div class="form-wrapper row">
	                                        <div class="col-lg-4">
		                                        <div class="form-group">
		                                            <label>Reason 1</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Reason 2</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
	                                        </div>
	                                        <div class="col-lg-8">
	                                        	<div class="form-group">
													<label>Comments</label>
													<textarea class="form-control" rows="3"></textarea>
												</div>
	                                        </div>
	                                        
	                                        
                                        </div>
            						</form>
            					</div>
            				</div>
            			</div>
            		</article><!-- #fatal -->
			
					<article id="adherence" class="panel panel-default">
        				<h2>Adherence</h2>
            			<div class="panel-body">
            				<div class="row">
            					<div class="col-lg-12">
            						<!-- Form 1 -->
            						<form>      
                                        <div class="form-wrapper row">
	                                        <div class="col-lg-4">
		                                        <div class="form-group">
		                                            <label>Accuracy of Information/Knowledge</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Security Verfication</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Call Back Severity</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
		                                        <div class="form-group">
		                                            <label>Other</label>
		                                            <select class="form-control">
		                                                <option>1</option>
		                                                <option>2</option>
		                                            </select>
		                                        </div>
	                                        </div>
	                                        <div class="col-lg-8">
	                                        	<div class="form-group">
													<label>Comments</label>
													<textarea class="form-control" rows="3"></textarea>
												</div>
	                                        </div>                                 
                                        </div>
            						</form>
            					</div>
            				</div>
            			</div>
            		</article><!-- #adherence -->

            		<article id="quality" class="panel panel-default">
        				<h2>Quality</h2>
            			<div class="panel-body">
            				<div class="row">
            					<div class="col-lg-12">
            						<!-- Form 1 -->
            						<form>      
                                        <div class="form-wrapper row">
	                                        <div class="col-lg-6">
												<div class="row">
													<div class="col-lg-12">
														<div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>Tone & Manner</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                        <div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>Communication</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                        <div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>Correct Hold</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>
				                                        
				                                       	<div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>PAO</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                        <div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>Delighters Used</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                       	<div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>System Usage</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                        <div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>Tone and Manner</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                        <div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>Correct CT/SCT</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>

				                                        <div class="row">
															<div class="col-lg-6">
						                                        <div class="form-group">
						                                            <label>OCR</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="max">Max</label>
				                                        			<input class="form-control" value="Max" type="text">
						                                        </div>
					                                        </div>
					                                        <div class="col-lg-3">
					                                        	<div class="form-group">
						                                            <label for="duration">Achieve</label>
				                                        			<input class="form-control" type="text" id="ach" placeholder="Ach">
						                                        </div>
					                                        </div>
				                                        </div>
				                                        <div class="row">
				                                        	<div class="col-lg-6">
				                                        	 	<div class="form-group">
						                                            <label>PG</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
						                                        <div class="form-group">
						                                            <label>OSAT</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
						                                        <div class="form-group">
						                                            <label>RSAT</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
						                                        <div class="form-group">
						                                            <label>Appreciation</label>
						                                            <select class="form-control">
						                                                <option>1</option>
						                                                <option>2</option>
						                                            </select>
						                                        </div>
					                                        </div>
				                                        </div>
		                                        	</div><!-- .item -->
												</div><!-- .row -->

		                                       
		                                        
	                                        </div>
	                                        <div class="col-lg-8">
	                                        	<div class="form-group">
													<label>Comments</label>
													<textarea class="form-control" rows="3"></textarea>
												</div>
	                                        </div>                                 
                                        </div>
            						</form>
            					</div>
            				</div>
            			</div>
            		</article><!-- #quality -->

            	</div>
            </div>
        </div>
	</div>
</section>
@stop