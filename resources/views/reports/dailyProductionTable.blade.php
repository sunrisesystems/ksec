<div class="pageHeading container-fluid">
	<div class="row ">			
		<div class="page-title-wrapper">			
			<div class="col-lg-8">
				<h2 class="page-header">Daily Production Reports</h2>					
			</div>
			<div class="col-lg-4">
				<div class="title-action">
					 <div class="title-action">
					 	@if(!empty($result))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('report/daily-production-pdf')!!}">
							<i class="fa fa-file-excel-o"></i> PDF
						</a>
						@endif
					<!-- <a title="Search Filter" class="btn btn-white search-filter" href="javascript:void(0)">
						<i class="glyphicon glyphicon-filter"></i> Search
					</a> -->
					</div>
				</div> 
			</div>				
		</div>			
	</div><!-- pageHeading end -->	
</div>

<div class="main-container-inner container-fluid" id="">
	<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">

					@if(!empty($result))
					<table id="productionReports" class="category table table-hover table-bordered">
						<!-- table head -->
						<thead>
							<tr>
								<th class="right" rowspan="1">#</th>
								<th class="left">Machine <br /> Name</th>
								<th class="left">Product</th>  
							<!-- 	<th class="right">Shot <br /> Counter</th>  -->
								<!-- <th class="right">Available <br /> Hour</th> -->
								<th class="right">Avail. <br/> Hours</th>
								<th class="right">Std. Cycle <br /> Time</th>
								<th class="center">Avg. Cavity <br /> Block</th>
								<th class="center">Std. <br /> Production</th>
								<th class="center nopadding" colspan="2"><span>Net Production</span>
									<table class="table sub-table">
										<thead>
										 <tr>
										   <th>pcs.</th>
										   <th>kgs</th>
										 
										 </tr>
										</thead>  
									  </table> 
								</th>
								<th class="center nopadding" colspan="3"><span>Rejection</span>
									<table class="table sub-table">
										<thead>
										 <tr>
											<th>pcs.</th>
											<th>kgs</th>
											<th>%</th>
										 </tr>
										</thead>  
									</table> 
								</th>
								<th class="center nopadding" colspan="2"><span>Purging</span>
									<table class="table sub-table">
										<thead>
										 <tr>
											<th>kgs</th>
											<th>%</th>
										 </tr>
										</thead>  
									</table> 
								</th>
								<th class="center nopadding"><span>Downtime</span>
									<table class="table sub-table">
										<thead>
										 <tr>
											<th>Hrs</th>
										 </tr>
										</thead>  
									</table>
								</th>
								<th class="center nopadding"><span>Electricity</span>
									<table class="table sub-table">
										<thead>
										 <tr>
											<th>kWH</th>
										 </tr>
										</thead>  
									</table>
								</th>
								<th class="center nopadding"><span>Labour</span>
									<table class="table sub-table">
										<thead>
										 <tr>
											<th>No.</th>
										 </tr>
										</thead>  
									</table>
								</th>
								<th class="center nopadding"><span>C.U.</span>
									<table class="table sub-table">
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
			<!-- 				<tr>
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
			                if(!empty($value->std_prod)){
			                	if(!empty($value->Net_Prod)){
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
								<!-- <td align="right">-</td> -->
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
					@else
					<div class="alert alert-info">No Record Found</div>
					@endif
				</div><!-- table responsive end -->								
			</div>
		</div>
</div>