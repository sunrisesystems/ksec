<!DOCTYPE HTML>
<html lang="en-US">
<?php
set_time_limit(0);
ini_set("memory_limit",'1024M');
ini_set('max_execution_time', 0);
?>
<head>
	<meta charset="UTF-8">
	<title>Production Report</title>
	<style>
		*{
			margin:0;
			padding:0;
		}
		body {
			color: #000;
			font-family: "Verdana",Arial,sans-serif;
			font-size: 13px;
		}
		p {
			font-family: 'Verdana', Arial, sans-serif;
		}
		h1,h2,h3,h4,h5 {
			font-family: 'Verdana', Arial, sans-serif;
		}
		
		.data-header {
			text-align: center;
			margin-top: 30px;
			margin-bottom: 30px;
			padding-bottom: 25px;
			border-bottom: 1px solid #e9e9e9;
		}
		.data-header .table {
			margin-bottom: 0;
		}
		.data-header .table > tbody > tr > td {
			border: 0;
		}
		.data-header h1 {
			font-weight: 500;
			line-height: normal;
			margin: 0;
		}
		.data-header .data-shift-date {
			font-size: 16px;
			font-family: 'Verdana', Arial, sans-serif;
		}
		.table-responsive {
			padding:0 15px;
		}
		.right {
			text-align: right;
		}
		.left {
			text-align: left;
		}
		.center {
			text-align: center;
		}
		table {
			width: 100%;
		}
		table > tr > th {
			vertical-align: bottom;
		}
		table tr th, table tr td {
			border: 1px solid #ccc;
		}
	.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
		border: 1px solid #ddd;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		border-top: 1px solid #ddd;
		line-height: 1.42857;
		padding: 8px;
		vertical-align: top;
	}
	tr th, tr td {
		font-size: 13px;
	}
	#productionReports.table > thead > tr > th .table > thead > tr > th {
		vertical-align: bottom;
		border: 0;
		
	}
	#productionReports.table > thead > tr > th.nopadding div{
		padding:8px;
	}
	#productionReports.table > thead > tr > th.nopadding {
		padding:0;
	}
	#productionReports.table > tfoot > tr > td {
		font-weight:bold;
	}
	#productionReports .table.sub-table {
		margin-bottom:0;
		background-color: transparent;
	}
	</style>
</head>
<body>
	<div class="table-responsive">
		<div class="data-header">
			<table class="table" >			
				<tbody>
					<tr>
						<td align="center"><h1 class="table-title">Daily Production Report</h1></td>
					</tr>
					<tr>
						<td align="right"><div class="data-shift-date"><strong>From</strong>: {!! $input['fromDate'] !!} <strong>To</strong>: {!! $input['toDate'] !!} <strong>Shift</strong>: {!! implode(",",$input['shiftName'])!!}</div></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" id="productionReports" class="category table table-hover table-bordered">
			<!-- table head -->
			<thead>
				<tr>
					<th class="right" rowdiv="1">#</th>
					<th class="left">Machine <br /> Name</th>
					<th class="left">Product</th>  
				<!-- 	<th class="right">Shot <br /> Counter</th>  -->
					<th class="right">Avail<br /> Hours</th>
					<th class="right">Std. Cycle <br /> Time</th>
					<th class="center">Avg. Cavity <br /> Block</th>
					<th class="center">Std. <br /> Production</th>
					<th class="center nopadding" colspan="2"><div>Net Production</div>
						<table  cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
							   <th>pcs.</th>
							   <th>kgs</th>
							 
							 </tr>
							</thead>  
						  </table> 
					</th>
					<th class="center nopadding" colspan="3"><div>Rejection</div>
						<table cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
								<th>pcs.</th>
								<th>kgs</th>
								<th>%</th>
							 </tr>
							</thead>  
						</table> 
					</th>
					<th class="center nopadding" colspan="2"><div>Purging</div>
						<table cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
								<th>kgs</th>
								<th>%</th>
							 </tr>
							</thead>  
						</table> 
					</th>
					<th class="center nopadding"><div>Downtime</div>
						<table cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
								<th>Hrs</th>
							 </tr>
							</thead>  
						</table>
					</th>
					<th class="center nopadding"><div>Electricity</div>
						<table cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
								<th>kWH</th>
							 </tr>
							</thead>  
						</table>
					</th>
					<th class="center nopadding"><div>Labour</div>
						<table cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
								<th>No.</th>
							 </tr>
							</thead>  
						</table>
					</th>
					<th class="center nopadding"><div>C.U.</div>
						<table cellpadding="0" cellspacing="0" border="0" class="table sub-table">
							<thead>
							 <tr>
								<th>%</th>
							 </tr>
							</thead>  
						</table>
					</th>
					
				</tr>
			</thead>
		
			<!-- table body -->
			<tbody>
			
			<!-- Abbr. -->	
				<!-- <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">(#)</td>
					<td align="right">(SD)</td>
					<td align="right">(SD)</td>
					<td align="right">(SD)</td>
					<td align="right">(#)</td>
					<td align="right">(#)</td>							
					<td align="right">(SD)</td>
					<td align="right">(#)</td>
					<td align="right">(SD)</td>
					<td align="right">(SD)</td>
					<td align="right">(SD)</td>
					<td align="right">(TD)</td>
					<td align="right">(SD)</td>
					<td align="right">(#)</td>
					<td align="right">(#)</td>
					<td align="right">(SD)</td>								
				</tr> -->
			<!-- /abbr. -->
					<?php $count = 1; 
			                	$totalAvgCycleTime = 0.0;
			                	$totalAvgCavityBlocks = 0.0;
			                	$totalCU = 0;
			                	$totalPurging = 0;
			                	$totalRejectionsKgs = 0;
			                	$totalRejections = 0;
			                	$totalProductionKgs = 0;
			                	$totalProduction = 0;
			                	$stdProductions = 0;
			                	$dt = explode(":",$totalDowntime[0]->DT);

			                	if(!empty($dt) && isset($dt[0]) && !empty($dt[0])){
			                		$totalDownTime1 = $dt[0].":".$dt[1];
			                	}else{
			                		$totalDownTime1 = 0;
			                	}

							?>
							@foreach($result as $value)
							<?php $downtime = '-';
							$t = explode(":", $value->DT);
							if(!empty($t[0])){
			                    $downtime = $t[0].":".$t[1];
			                }
			                $hrs = '00:00';
			                $h = explode(":", $value->Act_AH);
							if(!empty($h[0])){
			                    $hrs = $h[0].":".$h[1];
			                }
			                $totalAvgCycleTime += $value->sct_c;
			                $totalAvgCavityBlocks += $value->std_cavities;
			                if($value->std_prod){
			                	if($value->Net_Prod){
			                		$cu = ($value->Net_Prod * 100) /  $value->std_prod;
			                	}else{
			                		$cu = 0;
			                	}
			                }else{
			                	$cu = 0;
			                }
			                $totalPurging += $value->Purging_KGS;
			                $totalRejectionsKgs += $value->Rej_KGS;
			                $totalRejections += $value->Rej;
			                $totalProductionKgs += $value->Net_Prod_KGS;
			                $totalProduction += $value->Net_Prod;
			                $stdProductions += $value->std_prod;
			                if($stdProductions){
			                	$totalCU = ($totalProduction * 100) / $stdProductions; 
			                }else{
			                	$totalCU = 0;
			                }
						?>
				<tr>
					<td align="center">{!! $count++ !!}</td>
					<td>{!! $machineList[$value->machine_id]!!}</td>
					<td>{!! $productList[$value->product_id]!!}</td>
					<!-- <td align="right">-</td> -->
					<td align="center">{!! $hrs !!}</td>
					<td align="center">{!! $value->sct_c !!}</td>
					<td align="center">-</td>
					<td align="center">{!! round($value->std_prod,0,PHP_ROUND_HALF_UP)!!}</td>
					<td align="center">{!! $value->Net_Prod !!}</td>							
					<td align="center">{!! round($value->Net_Prod_KGS,2,PHP_ROUND_HALF_UP)!!}</td>
					<td align="center">{!! $value->Rej !!}</td>
					<td align="center">{!! round($value->Rej_KGS,2,PHP_ROUND_HALF_UP) !!}</td>
					@if($value->Net_Prod <= 0)
					<td align="center">0</td>
					@else
					<td align="center">{!! round((($value->Rej * 100) / $value->Net_Prod),1,PHP_ROUND_HALF_UP)!!}</td>
					@endif
					<td align="center">{!! $value->Purging_KGS !!}</td>
					@if($value->Net_Prod_KGS <= 0)
					<td align="center">0</td>
					@else
					<td align="center">{!! round((($value->Purging_KGS * 100) / $value->Net_Prod_KGS),1,PHP_ROUND_HALF_UP)!!}</td>
					@endif
					<td align="center">{!! $downtime !!}</td>
					<td align="center">-</td>
					<td align="center">-</td>
					<td align="center">{!! round($cu,1,PHP_ROUND_HALF_UP)!!}</td>								
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td align="center" colspan="3">Total</td>
					<!-- <td align="center">-</td> -->
					<td align="center">-</td>
					<td align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center">{!! round($stdProductions,0,PHP_ROUND_HALF_UP) !!}</td>
					<td align="center">{!! round($totalProduction,2,PHP_ROUND_HALF_UP) !!}</td>
					<td align="center">{!! round($totalProductionKgs,2,PHP_ROUND_HALF_UP) !!}</td>							
					<td align="center">{!! round($totalRejections,2,PHP_ROUND_HALF_UP) !!}</td>
					<td align="center">{!! round($totalRejectionsKgs,2,PHP_ROUND_HALF_UP) !!}</td>
					<td align="center">{!! round(($totalRejections * 100 / $totalProduction),2,PHP_ROUND_HALF_UP)!!}</td>
					<td align="center">{!! $totalPurging !!}</td>
					<td align="center">{!! round(($totalPurging * 100 / $totalProductionKgs),2,PHP_ROUND_HALF_UP)!!}</td>
					<td align="center">{!! $totalDownTime1 !!}</td>
					<td align="center">-</td>
					<td align="center">-</td>
					<td align="center">{!! round($totalCU,1,PHP_ROUND_HALF_UP)!!}</td>
				</tr>
			</tfoot>
		</table><!-- table end -->
	</div><!-- table responsive end -->
</body>
</html>