<?php
$productionDetails = $result['productionDetails'];
$downtimeDetails = $result['downtimeDetails'];
$productionDetailMTD = $result['productionDetailMTD'];
?>
<div class="pageHeading container-fluid">
	<div class="row ">			
		<div class="page-title-wrapper">			
			<div class="col-lg-8">
				<h2 class="page-header">Daily Management Reports</h2>					
			</div>
			<div class="col-lg-4">
				<div class="title-action">
					<span class="data-content">
						Unit: {!! $input['unitName']!!} Date: {!! $input['date'] !!} 
					</span>
					@if(!empty($result))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('report/management-report-pdf')!!}">
							<i class="fa fa-file-excel-o"></i> PDF
						</a>
					@endif
				</div>
			</div> 
		</div>				
	</div>			
</div><!-- pageHeading end -->	
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
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
	</div>
</div>
<div class="table-top">
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="table-responsive">
				<table id="manageProduction" class="manageProduction table table-hover table-bordered">
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
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="table-responsive">
				<table id="downtime" class="manageDowntime table table-hover table-bordered">
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
		</div>
		<div class="col-md-4 col-xs-12">
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
					</tbody>
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
		</div>
	</div><!--/.row -->
</div>
<div class="row">
		
		<div class="col-md-12 col-xs-12">
			<div class="table-responsive">
				<table id="manageMachines" class="manageMachines table table-hover table-bordered">
					<colgroup>
						<col width="18%" />
						<col width="18%" />
						<col width="64%" />
					</colgroup>
					<thead>
						<tr>
							<th>Low Efficiency Machines</th>
							<th>Issue (In sort Order)</th>								
							<th>Comments</th>								
						</tr>
					</thead>
					</tbody>
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
		</div>
	</div>
</div><!-- main-container-inner end -->