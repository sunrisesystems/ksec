<!DOCTYPE HTML>
<?php
$productionDetails = $result['productionDetails'];
$downtimeDetails = $result['downtimeDetails'];
$productionDetailMTD = $result['productionDetailMTD'];
?>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Management Reports</title>
	<style type="text/css">
		* {
			padding:0;
			margin:0;
		}
		body {
			width: 29.7cm;
			margin: 0 auto !important;
			font-family: 'Verdana', Arial, sans-serif;
		}
		p {
			font-family: 'Verdana', Arial, sans-serif;
		}
		h1,h2,h3,h4,h5 {
			font-family: 'Verdana', Arial, sans-serif;
		}
		.pageWrapper {
			display: block;
			overflow: hidden;
		}
		.data-header {
			text-align: center;
			margin-top: 0;
			margin-bottom: 30px;
			padding-bottom: 25px;
			border-bottom: 1px solid #e9e9e9;
		}
		.data-header .table {
			margin-bottom: 0;
		}
		.data-header h1 {
			font-weight: 500;
			line-height: normal;
			margin: 0;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		.table {
			margin-bottom: 30px;
			max-width: 100%;
			width: 100%;
		}
		.table .table {
			margin-bottom: 0;
		}
		.table.table-bordered > tbody > tr > td,
		.table.table-bordered > tbody > tr > th, 
		.table.table-bordered > tfoot > tr > td,
		.table.table-bordered > tfoot > tr > th, 
		.table.table-bordered > thead > tr > td, 
		.table.table-bordered > thead > tr > th {
			border: 1px solid #e9e9e9;
		}
		.table > thead > tr > th {
			border-bottom: 0;
			vertical-align: bottom;
		}
		.table > tbody > tr > td, 
		.table > tbody > tr > th, 
		.table > tfoot > tr > td, 
		.table > tfoot > tr > th,
		.table > thead > tr > td, 
		.table > thead > tr > th {
			border-top: 0;
			line-height: 1.42857;
			padding: 8px;
			vertical-align: top;
		}
		th {
			text-align: left;
		}
		td, th {
			padding: 0;
		}
		.center {
			text-align: center;
		}
		.left {
			text-align: left;
		}
		.right {
			text-align: right;
		}
	</style>
</head>
<body>
	<div class="pageWrapper">
		<div class="data-header">
			<table class="table" >			
				<tbody>
					<tr>
						<td align="center"><h1>Management Reports</h1></td>
					</tr>
					<tr>
						<td align="right"><div class="data-unit-date">Unit: {!! $input['unitName'] !!} Date: {!! $input['date']!!}</div></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="data-table">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td><strong>C.U(%)</strong></td>
							<td><strong>Today</strong></td>
							<td>{!! round($productionDetails[0]->CU,0)!!}%</td>
							<td><strong>MTD</strong></td>
							<td>{!! round($productionDetailMTD[0]->CU,0)!!}%</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- Table top -->
			<table class="table">			
				<tbody>
					<tr>
						<td style="padding:0 15px 0 0;">
							<!-- Downtime -->
								<div class="downtimeContainer">
									<div class="table-responsive">
										<table id="downtime" class="manageDowntime table table-bordered">
											<colgroup>
												<col width="50%" />
												<col width="50%" />
											</colgroup>
											<thead>
												<tr>
													<th class="center" colspan="2">Downtime</th>
												</tr>
												<tr>
													<th>Downtime Reasons</th>
													<th>Hrs.</th>								
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Production</td>
													<td>{!! $downtimeDetails['production'][0]->DT !!}</td>
												</tr>
												<tr>
													<td>Mold Changeover</td>
													<td>{!! $downtimeDetails['moldChangeOver'][0]->DT !!}</td>
												</tr>
												<tr>
													<td>Power Breakdown</td>
													<td>{!! $downtimeDetails['powerBreakDown'][0]->DT !!}</td>
												</tr>
												<tr>
													<td>Others</td>
													<td>{!! $downtimeDetails['others'][0]->DT !!}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div><!-- /.downtime -->
						</td>
						<td style="padding:0 0 0 15px;">
							<!-- Costing -->
								<div class="costingContainer">
									<div class="table-responsive">
										<table id="costing" class="manageCosting table table-hover table-bordered">
											<colgroup>
												<col width="33.33%" />
												<col width="33.33%" />
												<col width="33.33%" />
											</colgroup>
											<thead>
												<tr>
													<th class="center" colspan="3">Costing</th>
												</tr>
												<tr>
													<th>Cost Heads</th>
													<th>Unit</th>								
													<th>Amt.</th>								
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Rejection</td>
													<td>Total Rs.</td>
													<td>-</td>
												</tr>
												<tr>
													<td>Purging</td>
													<td>Total Rs.</td>
													<td>-</td>
												</tr>
												<tr>
													<td>Electricity</td>
													<td>Rs./kg</td>
													<td>-</td>
												</tr>
												<tr>
													<td>Labour</td>
													<td>Rs./kg</td>
													<td>-</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div><!-- /..Costing -->
						</td>
					</tr>					
				</tbody>
			</table><!-- Table top -->
			
			<!-- table bottom -->
			<table class="table">
				<tr>
					<td style="padding:0 15px 0 0">
						<div class="table-responsive">
							<table id="manageProduction" class="manageProduction table table-bordered">
								<colgroup>
									<col width="33.33%" />
									<col width="33.33%" />
									<col width="33.33%" />
								</colgroup>
								<thead>
									
									<tr>
										<th>Particular</th>
										<th>Today</th>								
										<th>Month Till Date</th>								
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Standard Production (pcs.)</td>
										<td>{!! round($productionDetails[0]->std_prod,0) !!}</td>
										<td>{!! round($productionDetailMTD[0]->std_prod,0) !!}</td>
									</tr>
									<tr>
										<td>Production (pcs.)</td>
										<td>{!! round($productionDetails[0]->Net_Prod,0) !!}</td>
										<td>{!! round($productionDetailMTD[0]->Net_Prod,0) !!}</td>
									</tr>
									<tr>
										<td>Production (kgs.)</td>
										<td>{!! round($productionDetails[0]->Net_Prod_KGS,1,PHP_ROUND_HALF_UP) !!}</td>
										<td>{!! round($productionDetailMTD[0]->Net_Prod_KGS,1,PHP_ROUND_HALF_UP) !!}</td>
									</tr>
									<tr>
										<td>Rejection (kgs.)</td>
										<td>{!! round($productionDetails[0]->Rej_KGS,1,PHP_ROUND_HALF_UP) !!}</td>
										<td>{!! round($productionDetailMTD[0]->Rej_KGS,1,PHP_ROUND_HALF_UP) !!}</td>
									</tr>
									<tr>
										<td>Rejection (%)</td>
										@if($productionDetails[0]->Net_Prod_KGS)
										<td>{!! round($productionDetails[0]->Rej_KGS / $productionDetails[0]->Net_Prod_KGS * 100,1,PHP_ROUND_HALF_UP) !!}%</td>
										@else
										<td>{!! 0 !!}%</td>
										@endif
										@if($productionDetailMTD[0]->Net_Prod_KGS)
										<td>{!! round($productionDetailMTD[0]->Rej_KGS / $productionDetailMTD[0]->Net_Prod_KGS * 100,1,PHP_ROUND_HALF_UP) !!}%</td>
										@else
										<td>{!! 0 !!}%</td>
										@endif
									</tr>
									<tr>
										<td>Purging (kgs.)</td>
										<td>{!! round($productionDetails[0]->Purging_KGS,1,PHP_ROUND_HALF_UP) !!}</td>
										<td>{!! round($productionDetailMTD[0]->Purging_KGS,1,PHP_ROUND_HALF_UP) !!}</td>
									</tr>
									<tr>
										<td>Purging (%)</td>
										@if($productionDetails[0]->Net_Prod_KGS)
										<td>{!! round($productionDetails[0]->Purging_KGS / $productionDetails[0]->Net_Prod_KGS * 100,2,PHP_ROUND_HALF_UP) !!}%</td>
										@else
										<td>{!! 0 !!}%</td>
										@endif
										@if($productionDetailMTD[0]->Net_Prod_KGS)
										<td>{!! round($productionDetailMTD[0]->Purging_KGS / $productionDetailMTD[0]->Net_Prod_KGS * 100,2,PHP_ROUND_HALF_UP) !!}%</td>
										@else
										<td>{!! 0 !!}%</td>
										
										@endif
									</tr>
									<tr>
										<td>ERM</td>
										<td>--</td>
										<td>--</td>
									</tr>
								</tbody>
							</table>
						</div><!-- table responsive end -->	
					</td>
					<td style="padding:0 0 0 15px">
						<div class="table-responsive">
							<table id="manageMachines" class="manageMachines table table-hover table-bordered">
								<colgroup>
									<col width="33.33%" />
									<col width="33.33%" />
									<col width="33.33%" />
								</colgroup>
								<thead>
									<tr>
										<th>Low Efficiency Machines</th>
										<th>Issue (In sort Order)</th>								
										<th>Comments</th>								
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Machine A</td>
										<td>Low Production</td>
										<td>1200</td>
									</tr>
									<tr>
										<td>Machine B</td>
										<td>Low Production</td>
										<td>1200</td>
									</tr>
									<tr>
										<td>Machine C</td>
										<td>High Rejection</td>
										<td>1200</td>
									</tr>
									<tr>
										<td>Machine D</td>
										<td>High Purging</td>
										<td>1200</td>
									</tr>
									<tr>
										<td>Machine E, F, G</td>
										<td>No Planning</td>
										<td>Not Applicable</td>
									</tr>
								</tbody>
							</table>
						</div><!-- table responsive end -->
					</td>
				</tr>
			</table>
			<!-- /.table bottom -->
		</div>
	</div>
</body>
</html>