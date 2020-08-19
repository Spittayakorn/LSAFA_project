<?php
	session_start();
	
		if(!(isset($_SESSION['memCode']) && isset($_SESSION['memName'])&& isset($_SESSION['facCode'])&& isset($_SESSION['facName'])&& isset($_SESSION['depCode']) && isset($_SESSION['depName'])))
		{
			echo "<script>
					alert('กรุณาเข้าสู่ระบบใหม่อีกครั้ง');
					window.open('login.php','_self');
			</script>";
	
		}else{
			
			$memCode = $_SESSION['memCode'];
			
			//-----
			require('connectDB.php');
			$sqlSearchSessionMember = "select * from member where memCode='$memCode';";
			$resultSearchSessionMember = mysqli_query($con,$sqlSearchSessionMember);
			
			if($resultSearchSessionMember == null)
			{
				echo "คำสั่งผิด";
			}

			$recnumSearchSessionMember = mysqli_fetch_array($resultSearchSessionMember);
			
			$memName = $recnumSearchSessionMember[4];
			
			//---

			$facCode = $_SESSION['facCode'];
			$facName = $_SESSION['facName'];
			$depCode = $_SESSION['depCode'];
			$depName = $_SESSION['depName'];
		}	
	?>
<html>
	<head>
		<title>ระบบขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์ - ภาควิชาสัตวศาสตร์ คณะทรัพยากรธรรมชาติ </title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<style>
			body {
			font-family: sarabun;
			font-size: 100%;	
			line-height: 1.5;
			height:90%
			}
			img {
			height:40%;
			width:100%;
			}
			table,#fixTB{
			border:1px solid black;
			border-collapse: collapse;
			}
			#tbLog {
			border-left: none;
			border-right:none;
			border-top:none;
			border-bottom:none;
			}
			#signOut{
			background-color: #4CAF50;
			border: none;
			color: white;
			padding:10px 10px;
			text-align:center;
			text-decoration:none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			}
			
			#btYes{
			background-color: green;
			border: none;
			color: white;
			padding:10px 10px;
			text-align:center;
			text-decoration:none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			}

			#btNo{
			background-color: red;
			border: none;
			color: white;
			padding:10px 10px;
			text-align:center;
			text-decoration:none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			}

			#myTables {
			border: 1px solid black;
			border-collapse: separate;
			border-radius: 5px;
			padding:10px;
			}
			#myTable{
			border:none;
			
			}
			#tb {
			font-weight: bold;
			}
			#scoptTb {
			padding: 5px;
			}
			#tbSim {
			border-collapse: collapse;
			width:70%;
			}
			#no,#volume,#sumSim {
			text-align:center;
			}
			select{
			width: 300px;
			padding: 0.4em;
			border-radius: 0.2em;
			border: 1px solid #ccc;
			outline: none;
		}
		</style>
		<script>
			$(document).ready(function(){
				
				$('#signOut').click(function(){
					window.open('logout.php','_self');
				});
				
			});
			
		</script>
	</head>
	<body>
		<center>
			<img src='img/hrm_3.jpg'>
		</center>
		<table id='tbLog' cellpadding='5' width='100%'>
			<tr align='right'>
				<td width='90%'>
					<?php echo "$memName $facName วิทยาเขตหาดใหญ่";  ?>
				</td>
				<td align='center'>
					<button id='signOut'>ออกจากระบบ</button>
				</td>
			</tr>
		</table>
		<table id='myTables' width='100%' cellspacing='10' cellpadding='5'>
			
			<tr>
				<td colspan='3'><a href='Smain.php'> ระบบขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์ > นักศึกษา</a> > <a href='SManageLab.php'>รายการแบบฟอร์มขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์ </a> > ตรวจสอบสถานะ</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					
					<table border='0' width='100%' cellpadding='10'>
						
						<?php
							$labCode = $_GET['labCode'];		
							require('connectDB.php');

							$sqlSearchLab = "select * from lab where labCode='$labCode';";
							$resultSearchLab = mysqli_query($con,$sqlSearchLab);
									
							if($resultSearchLab== null)
							{
								echo "คำสั่งผิด";
							}
									
							$recnumSearchLab = mysqli_fetch_array($resultSearchLab);
									
							if($recnumSearchLab == 0)
							{
								echo "ไม่พบข้อมูล";
							}
						?>

						<tr>
							<th align='left' colspan='2'><u>สถานะขอใช้ห้องปฏิบัติการ</u> 
							</th>
						</tr>	
						<?php
								
							if($recnumSearchLab[25]=='0')
							{
								echo "<tr><td width='35%'>สถานะส่งเอกสาร : </td><td><u style='color:red;'>เอกสารยังไม่ถูกส่ง</u></td></tr>";
							}
							if($recnumSearchLab[25]=='1')
							{
								echo "<tr><td width='35%'>สถานะส่งเอกสาร : </td><td><u style='color:green;'>ส่งเอกสารเรียบร้อย</u></td></tr>";
								
								if($recnumSearchLab[14]=='0')
								{
									echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากอาจารย์ : </td><td><u style='color:red;'>รออนุมัติ</u></td></tr>";
								
								}else
								{
									if($recnumSearchLab[14]=='2')
									{
										echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากอาจารย์ : </td><td><u style='color:red;'>ไม่อนุมัติ</u></td></tr>";
										
										if($recnumSearchLab[21] == '1')
										{
												echo "<tr><td>สถานะเอกสาร : </td><td><u style='color:red;'>สิ้นสุดการทำงาน</u></td></tr>";
												
										}
									
									}else
									{
										if($recnumSearchLab[14]=='1')
										{
											echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากอาจารย์ : </td><td><u style='color:green;'>อนุมัติ</u></td></tr>";
											
											if($recnumSearchLab[15]=='0')
								{
									echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากเจ้าหน้าที่ห้องปฏิบัติการ : </td><td><u style='color:red;'>รออนุมัติ</u></td></tr>";
								
								}else
								{
									if($recnumSearchLab[15]=='2')
									{
										echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากเจ้าหน้าที่ห้องปฏิบัติการ : </td><td><u style='color:red;'>ไม่อนุมัติ</u></td></tr>";
										
										if($recnumSearchLab[21] == '1')
										{
												echo "<tr><td>สถานะเอกสาร : </td><td><u style='color:red;'>สิ้นสุดการทำงาน</u></td></tr>";

										}
									
									}else
									{
										if($recnumSearchLab[15]=='1')
										{
											echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากเจ้าหน้าที่ห้องปฏิบัติการ : </td><td><u style='color:green;'>อนุมัติ</u></td></tr>";


											if($recnumSearchLab[16]=='0')
								{
									echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากผู้บริหาร : </td><td><u style='color:red;'>รออนุมัติ</u></td></tr>";
								}
								else
								{
									if($recnumSearchLab[16]=='2')
									{
										echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากผู้บริหาร : </td><td><u style='color:red;'>ไม่อนุมัติ</u></td></tr>";

										if($recnumSearchLab[21] == '1')
										{
											echo "<tr><td>สถานะเอกสาร : </td><td><u style='color:red;'>สิ้นสุดการทำงาน</u></td></tr>";

										}
									}else
									{
										if($recnumSearchLab[16]=='1')
										{
											echo "<tr><td>สถานะขอใช้ห้องปฏิบัติการจากผู้บริหาร : </td><td><u style='color:green;'>อนุมัติ</u></td></tr>";

											if($recnumSearchLab[17] == '1')
											{
												echo "<tr><td>สถานะการทำซ้ำ : </td><td><u style='color:green;'>ทำซ้ำ</u></td></tr>";

											}

											if($recnumSearchLab[21] == '1')
											{
												echo "<tr><td>สถานะเอกสาร : </td><td><u style='color:green;'>สิ้นสุดการทำงาน</u></td></tr>";

											}


										}
	
									}

								}
										}
									}
								}
										}
									}
								}

							}
						?>

							
						
					</table>
			
				</td>
			</tr>
			
			<tr>
				<td>
					<!--  -->
					<table id='myTable' width='100%'>
						<tr>
							<td>
								<!--- -->
								<?php
									
									
									$sqlSearchLab = "select * from lab where labCode='$labCode';";
									$resultSearchLab = mysqli_query($con,$sqlSearchLab);
									
									if($resultSearchLab== null)
									{
										echo "คำสั่งผิด";
									}
									
									$recnumSearchLab = mysqli_fetch_array($resultSearchLab);
									
									if($recnumSearchLab == 0)
									{
										echo "ไม่พบข้อมูล";
									}
									//--------------------สร้างฟังก์ชัน-----------------
									function getDateTxt($DateTime)
									{
										//รับวันที่ และเวลา
										$dateTime = explode(' ',$DateTime);
										$date = $dateTime[0];
										$time = $dateTime[1];
									
										$dayMonthYear = explode('-',$date);
										//วัน  เดือน ปี
										$day =	$dayMonthYear[2];
										$month = $dayMonthYear[1];
										$year = $dayMonthYear[0]+543;
									
										$monthTxt = '';
										switch($month)
										{
											case '1' : $monthTxt = 'มกราคม';		break;
											case '2' : $monthTxt = 'กุมภาพันธ์';	break;
											case '3' : $monthTxt = 'มีนาคม';		break;
											case '4' : $monthTxt = 'เมษายน';		break;
											case '5' : $monthTxt = 'พฤษภาคม';	break;
											case '6' : $monthTxt = 'มิถุนายน';		break;
											case '7' : $monthTxt = 'กรกฏาคม';		break;
											case '8' : $monthTxt = 'สิงหาคม';		break;
											case '9' : $monthTxt = 'กันยายน';		break;
											case '10' : $monthTxt = 'ตุลาคม';		break;
											case '11' : $monthTxt = 'พฤศจิกายน';	break;
											case '12' :	$monthTxt = 'ธันวาคม';		break;
										}
									
										return array($day,$monthTxt,$year,$time);
									}
									
									//--------------------------จบฟัง
									
									list($day,$monthTxt,$year,$time) = getDateTxt($recnumSearchLab[4]);
									
									echo "
									<table cellpadding='5' width='100%' cellspacing='5' border='0'>
									<tr><td colspan='2'>&nbsp;</td></tr>
									";
									
									if($recnumSearchLab[2] != '')
									{

										echo "<tr>
												<td colspan='2'>
													<div align='right'>เลขที่&nbsp;".(int)$recnumSearchLab[2].".$recnumSearchLab[3]</div>
												</td>
											</tr>";
									}
									
									echo "<tr><td colspan='2'>
									<div id='date' align='right'>วันที่&nbsp;".(int)$day."&nbsp;เดือน&nbsp;$monthTxt&nbsp;พ.ศ.&nbsp;$year</div></td></tr>";
									
									?>
								<tr><td align='center' colspan='2'><div id='header' ><b>
									แบบฟอร์มขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์<br>
									ภาควิชาสัตวศาสตร์ คณะทรัพยากรธรรมชาติ</b>
								</div></td></tr>
									<tr><td colspan='2'>&nbsp;</td></tr>
									<tr>
										<td id='tb' width='30%'>ชื่อผู้ขอใช้ห้องปฏิบัติการ</td>
										<?php
											echo "<td>&nbsp;&nbsp;$recnumSearchLab[5]</td>";				
											?>
									</tr>
									<tr>
										<td id='tb'>ประเภท</td>
										<?php
											$sqlSearchCat = "select * from categorys where catCode='$recnumSearchLab[6]';";
											$resultSearchCat = mysqli_query($con,$sqlSearchCat);
											
											if($resultSearchCat == null)
											{
												echo "คำสั่งผิด";
											}
											
											$resultSearchCat = mysqli_fetch_array($resultSearchCat);
											
											if($resultSearchCat == 0)
											{
												echo "ไม่พบข้อมูล";
											}
											
											echo "<td>&nbsp;&nbsp;$resultSearchCat[1]</td>";
											
											?>
									</tr>
									<tr>
										<td id='tb'>โทรศัพท์</td>
										<?php
											echo "<td>&nbsp;&nbsp;$recnumSearchLab[7]</td>";
											?>
									</tr>
									<tr>
										<td id='tb' colspan='2'>วัตถุประสงค์ของการขอใช้ห้องปฏิบัติการ</td>
									</tr>
									<?php 
										$sqlSearchObj = "select * from objective where objCode='$recnumSearchLab[8]';";
										$resultSearchObj = mysqli_query($con,$sqlSearchObj);
										
										if($resultSearchObj == null)
										{
											echo "คำสั่งผิด";
										}
										
										$recnumSearchObj = mysqli_fetch_array($resultSearchObj);
										
										echo "<tr>
												<td id='tb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$recnumSearchObj[1]</td>
												<td>&nbsp;&nbsp;$recnumSearchLab[9]</td>
											</tr>";
										
										?>
									<tr>
										<td id='tb' colspan='2'>
											ชนิดตัวอย่างที่ต้องการวิเคราะห์
										</td>
									</tr>
									<tr>
										<td colspan='2'>
											<table id='tbSim' border='1' width='100%' cellpadding='5' align='left'>
												<tr>
													<th width='20%'>ลำดับที่</th>
													<th width='60%'>ชนิดตัวอย่าง</th>
													<th width='20%'>ปริมาณ(ตัวอย่าง)</th>
												</tr>
												<?php
													$sqlSearchSim = "select * from simplelist;";
													$resultSearchSim = mysqli_query($con,$sqlSearchSim);
													
													if($resultSearchSim == null)
													{
														echo "คำสั่งผิด";
													}
													
													function getVolume($labCode,$simCode)
													{
														require('connectDB.php');
													
														$volume = 0;
													
														$sqlSearchVal = "select da.daCode,da.volume,da.repeats,da.labCode,da.scCode,sc.scCode,sc.catCode,sc.anaCode,sc.simCode,sc.price from dataanalysis as da,servicechargelist as sc where da.scCode=sc.scCode and da.labCode='$labCode' and simCode='$simCode' limit 1;";
													
														$resultSearchVal = mysqli_query($con,$sqlSearchVal);
													
														if($resultSearchVal == null)
														{
															echo "คำสั่งผิด";
														}
													
														$numRowSearchVal = mysqli_num_rows($resultSearchVal);
													
														if($numRowSearchVal!=0)
														{
													
															$recnumSearchVal = mysqli_fetch_array($resultSearchVal);
															$volume = $recnumSearchVal[1];
													
														}
													
														return $volume;
													}
													
													$i = 0;
													$sumValume = 0;
													
													while($recnumSearchSim = mysqli_fetch_array($resultSearchSim))
													{
													
														$volumeSim = getVolume($labCode,$recnumSearchSim[0]);
														if($volumeSim != 0)
														{
															$i++;
															echo "<tr>
																	<td id='no'>$i</td>
																	<td>&nbsp;&nbsp;$recnumSearchSim[1]</td>
																	<td id='volume'>".number_format($volumeSim)."</td>
																</tr>";
													
															$sumValume +=$volumeSim;
														}
													}
													
													echo "<tr>
															<td colspan='2' id='sumSim'><b>รวม</b></td>
															<td id='volume'>".number_format($sumValume)."</td>
														</tr>";
													?>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan='2'>
											<b>ตัวอย่างละ</b>&nbsp;&nbsp;<?php echo $recnumSearchLab[10]; ?>&nbsp;ซ้ำ
										</td>
									</tr>
									<tr>
										<td colspan='2'>
											<table id='tbSim' border='1' width='100%' cellpadding='5'>
												<tr>
													<th width='10%'>ลำดับที่</th>
													<th width='40%'>ค่าที่ต้องการวิเคราะห์</th>
													<th width='30%'>ชนิดตัวอย่าง</th>
													<th width='20%'>จำนวนตัวอย่าง (ซ้ำ)</th>
												</tr>
												<?php
													$sqlSearchAna = "select * from analysislist;";
													$resultSearchAna = mysqli_query($con,$sqlSearchAna);
													
													if($resultSearchAna == null)
													{
														echo "คำสั่งผิด";
													}
													
													function getSimName($labCode,$anaCode)
													{
														require('connectDB.php');
														
														$simName= '';
														$sumSim = 0;
														$repeat = 0;

														$sqlSearchAna = "select da.daCode,da.volume,da.repeats,da.labCode,da.scCode,sc.scCode,sc.catCode,sc.anaCode,sc.simCode,sc.price,sl.simCode,sl.simName from dataanalysis as da,servicechargelist as sc,simplelist as sl where da.scCode=sc.scCode and sc.simCode=sl.simCode and da.labCode='$labCode' and anaCode='$anaCode';";
													
														$resultSearchAna = mysqli_query($con,$sqlSearchAna);

														if($resultSearchAna== null)
														{
															echo "คำสั่งผิด";
														}
														
														$numRowSearchAna = mysqli_num_rows($resultSearchAna);
													
														if($numRowSearchAna!=0)
														{	
															
															$count = 1;
															while($recnumSearchAna = mysqli_fetch_array($resultSearchAna))
															{
																$simName .= $recnumSearchAna[11];
																$sumSim += $recnumSearchAna[1];
																$repeat = $recnumSearchAna[2];

																if($count != $numRowSearchAna)
																{
																	$simName .= " ,";
																}
																$count++;
															}
														}
														
														return array($simName,$sumSim,$repeat);
													}
													
													
													function getCharge($anaCode,$catCode)
													{
														require('connectDB.php');
													
														$price = 0;
													
														$sqlSearchCharge = "select * from servicechargelist where anaCode='$anaCode' and catCode='$catCode' limit 1;";
														
														$resultSearchCharge = mysqli_query($con,$sqlSearchCharge);
													
														if($resultSearchCharge == null)
														{
															echo "คำสั่งผิด";
														}
														
														$numRowSearchCharge = mysqli_num_rows($resultSearchCharge);
													
														if($numRowSearchCharge !=0)
														{
															$recnumSearchCharge = mysqli_fetch_array($resultSearchCharge);
															$price = $recnumSearchCharge[4];
														}
													
														return $price;
													}
													
													$j = 0;
													$sumTotalAnaBefore = 0;
													while($recnumSearchAna = mysqli_fetch_array($resultSearchAna))
													{
														
														list($getSimName,$getSumSim,$getRepeat) = getSimName($labCode,$recnumSearchAna[0]);
														
														//คำนวณในแต่ละค่าวิเคราะห์
														$anaVal = 0;
														
														if($getSimName!='')
														{
															$j++;
															$anaVal = $getSumSim*$recnumSearchLab[10]*getCharge($recnumSearchAna[0],$resultSearchCat[0]);
															$sumTotalAnaBefore += $anaVal;
													
															echo "<tr>
																	<td id='no'>$j</td>
																	<td>&nbsp;&nbsp;$recnumSearchAna[1]</td>
																	<td>&nbsp;".$getSimName."</td>
																	<td id='volume'>".number_format($anaVal)."</td>
																</tr>";
														}
													
													}
													?>
												<tr>
													<td colspan='3' id='sumSim'><b>รวม</b></td>
													<td id='volume'><?php echo number_format($sumTotalAnaBefore);  ?></td>
												</tr>
											</table>
											<!--  -->
										</td>
									</tr>
<!-- -->
									<?php
										$sumTotalAnaAfter = 0;
										if($recnumSearchLab[17]=='1')
										{
									?>
									<tr>
										<td colspan='2'><b>ค่าที่ต้องการวิเคราะห์ (Repeat)</b></td>
									</tr>
									<tr>
										<td colspan='2'>
											<table id='tbSim' border='1' width='100%' cellpadding='5'>
												<tr>
													<th width='10%'>ลำดับที่</th>
													<th width='30%'>ค่าที่ต้องการวิเคราะห์</th>
													<th width='30%'>ชนิดตัวอย่าง</th>
													<th width='10%'>จำนวน Repeat</th>
													<th width='20%'>จำนวนตัวอย่าง (ซ้ำ)</th>
												</tr>
												<?php
													$sqlSearchAna = "select * from analysislist;";
													$resultSearchAna = mysqli_query($con,$sqlSearchAna);
													
													if($resultSearchAna == null)
													{
														echo "คำสั่งผิด";
													}
													
													function getSimNameRepeat($labCode,$anaCode)
													{
														require('connectDB.php');
														
														$simName= '';
														$sumSim = 0;
														$repeat = 0;

														$sqlSearchAna = "select da.daCode,da.volume,da.repeats,da.labCode,da.scCode,sc.scCode,sc.catCode,sc.anaCode,sc.simCode,sc.price,sl.simCode,sl.simName from dataanalysis as da,servicechargelist as sc,simplelist as sl where da.scCode=sc.scCode and sc.simCode=sl.simCode and da.labCode='$labCode' and anaCode='$anaCode';";
													
														$resultSearchAna = mysqli_query($con,$sqlSearchAna);

														if($resultSearchAna== null)
														{
															echo "คำสั่งผิด";
														}
														
														$numRowSearchAna = mysqli_num_rows($resultSearchAna);
													
														if($numRowSearchAna!=0)
														{	
															
															$count = 1;
															while($recnumSearchAna = mysqli_fetch_array($resultSearchAna))
															{
																$simName .= $recnumSearchAna[11];
																$sumSim += $recnumSearchAna[1];
																$repeat = $recnumSearchAna[2];

																if($count != $numRowSearchAna)
																{
																	$simName .= " ,";
																}
																$count++;
															}
														}
														
														return array($simName,$sumSim,$repeat);
													}
													
													
													function getChargeRepeat($anaCode,$catCode)
													{
														require('connectDB.php');
													
														$price = 0;
													
														$sqlSearchCharge = "select * from servicechargelist where anaCode='$anaCode' and catCode='$catCode' limit 1;";
														
														$resultSearchCharge = mysqli_query($con,$sqlSearchCharge);
													
														if($resultSearchCharge == null)
														{
															echo "คำสั่งผิด";
														}
														
														$numRowSearchCharge = mysqli_num_rows($resultSearchCharge);
													
														if($numRowSearchCharge !=0)
														{
															$recnumSearchCharge = mysqli_fetch_array($resultSearchCharge);
															$price = $recnumSearchCharge[4];
														}
													
														return $price;
													}
													
													$j = 0;
													
													while($recnumSearchAna = mysqli_fetch_array($resultSearchAna))
													{
														
														list($getSimName,$getSumSim,$getRepeat) = getSimNameRepeat($labCode,$recnumSearchAna[0]);
														
														//คำนวณในแต่ละค่าวิเคราะห์
														$anaVal = 0;
														
														if($getSimName!='' && $getRepeat!= '0')
														{
															$j++;
															$anaVal = $getSumSim*$recnumSearchLab[10]*getChargeRepeat($recnumSearchAna[0],$resultSearchCat[0])*$getRepeat;
															$sumTotalAnaAfter += $anaVal;
													
															echo "<tr>
																	<td id='no'>$j</td>
																	<td>&nbsp;&nbsp;$recnumSearchAna[1]</td>
																	<td>&nbsp;".$getSimName."</td>
																	<td align='center'>".number_format($getRepeat)."</td>
																	<td id='volume'>".number_format($anaVal)."</td>
																</tr>";
														}
													
													}
													?>
												<tr>
													<td colspan='4' id='sumSim'><b>รวม</b></td>
													<td id='volume'><?php echo number_format($sumTotalAnaAfter);  ?></td>
												</tr>
											</table>
											<!--  -->
										</td>
									</tr>
			
									<?php
										}
									
									$totoalBeforeAndAfter = $sumTotalAnaBefore+$sumTotalAnaAfter;
									
										echo "<tr><td colspan='2'><b>ค่าใช้จ่ายรวมที่คิดเป็นเงินทั้งสิ้น&nbsp;&nbsp;<u>".number_format($totoalBeforeAndAfter)."</u>&nbsp;&nbsp;บาท</b></tr></td>";
									?>
									


									
									<!-- -->
								
								
									<tr>
										<td colspan='2'>
											<table border='0' width='100%' cellpadding='5' style='table-layout:fixed;' id='myTable'>
												<tr>
													<?php
														list($sDay,$sMonthTxt,$sYear,$stime) = getDateTxt($recnumSearchLab[11]);
														list($eDay,$eMonthTxt,$eYear,$etime) = getDateTxt($recnumSearchLab[12]);
														
														echo "<td  colspan='6'>
																โดยมีกำหนดการตั้งแต่วันที่&nbsp;".(int)$sDay."&nbsp;เดือน&nbsp;$sMonthTxt&nbsp;พ.ศ.&nbsp;$sYear&nbsp;ถึง&nbsp;วันที่&nbsp;".(int)$eDay."&nbsp;เดือน&nbsp;$eMonthTxt&nbsp;พ.ศ.&nbsp;$eYear
															</td>";
														?>
												</tr>
												<tr>
													<td colspan='6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ทั้งนี้หากเกิดการชำรุดหรือเสียหาย&nbsp;ข้าพเจ้ายินดีรับผิดชอบและชดใช้คืนไม่ว่ากรณีใด ๆ</u></td>
												</tr>
												<tr>
													<td colspan='6'>จึงเรียนมาเพื่อโปรดพิจารณา</td>
												</tr>
												<?php 
													function searchNameMem($memCode)
													{
														require('connectDB.php');
													
														$memName ='';
														$sqlSearchMemName = "select * from member where memCode='$memCode';";
														$resultSearchMemName = mysqli_query($con,$sqlSearchMemName);
													
														if($resultSearchMemName == null)
														{
															echo "คำสั่งผิด";
														}
														
														$numRowSearchMemName = mysqli_num_rows($resultSearchMemName);
														
														if($numRowSearchMemName != 0)
														{
															$recnumSearchMemName = mysqli_fetch_array($resultSearchMemName);
															$memName = $recnumSearchMemName[4];
														}
														
														return $memName;
													}
													
													
													$memberLab = searchNameMem($recnumSearchLab[22]);		
													
													echo "<tr>
																<td width='50%' colspan='4'></td>
																<td colspan='2'>ลงชื่อ&nbsp;&nbsp;".$memberLab."&nbsp;&nbsp;ผู้ขอใช้</td>
															</tr>";
													
													
													
													function getStatusAndComment($status,$comment,$memCode)
													{
														$name='';
														$memComment = '';
														$memStatus = '';
													
														if( $status == '1' || $status == '2')
														{
															$name = searchNameMem($memCode);
															$memComment = $comment;
															if($status == '1')
															{
																$memStatus = 'อนุมัติ';
															}
															
															if($status == '2')
															{
																$memStatus = 'ไม่อนุมัติ';
															}
														}
														
														return array($name,$memComment,$memStatus);
													}
													
													
													if($recnumSearchLab[14] !='0')
													{
														list($teaName,$teaComment,$teaStatus) = getStatusAndComment($recnumSearchLab[14],$recnumSearchLab[18],$recnumSearchLab[13]);
														
														echo "<tr>
																<td colspan='6'>ความเห็นอาจารย์ที่ปรึกษา&nbsp;&nbsp;&nbsp;".$teaStatus."<br>
																	<!--<textarea rows='5' cols='50'>".$teaComment."</textarea>-->
																</td>
															</tr>
															<tr>
																<td width='50%' colspan='4'></td>
																
																<td colspan='2'>ลงชื่อ&nbsp;&nbsp;".$teaName."&nbsp;&nbsp;อาจารย์ที่ปรึกษา</td>
															</tr>";
														
													}
													

														if($recnumSearchLab[15] !='0' && $recnumSearchLab[14] !='0')
														{
															list($staffName,$staffComment,$staffStatus) = getStatusAndComment($recnumSearchLab[15],$recnumSearchLab[19],$recnumSearchLab[23]);
															
															echo "<tr>
																	<td colspan='6'>ความเห็นเจ้าหน้าที่ห้องปฏิบัติการ&nbsp;&nbsp;&nbsp;".$staffStatus."<br>
																		<!--<textarea rows='5' cols='50'>".$staffComment."</textarea>-->
																	</td>
																</tr>
																<tr>
																	<td width='50%' colspan='4'></td>
																	
																	<td colspan='2'>ลงชื่อ&nbsp;&nbsp;".$staffName."&nbsp;&nbsp;เจ้าหน้าที่ห้องปฏิบัติการ</td>
																</tr>";		
															
														}

															if($recnumSearchLab[16] !='0')
															{
																list($boName,$boComment,$boStatus) = getStatusAndComment($recnumSearchLab[16],$recnumSearchLab[20],$recnumSearchLab[24]);
															
																echo "
																		<tr>
																			<td colspan='6'>ความเห็นผู้ดูแลและพัฒนาห้องปฏิบัติการอาหารสัตว์&nbsp;&nbsp;&nbsp;".$boStatus."<br>
																				<!--<textarea rows='5' cols='50'>".$boComment."</textarea>-->
																			</td>
														
																		</tr>
																		<tr>
																			<td width='50%' colspan='4'></td>
																			
																			<td colspan='2'>ลงชื่อ&nbsp;&nbsp;".$boName."&nbsp;&nbsp;ผู้ดูแลและพัฒนาฯ</td>
																		</tr>";
															}
													
													?>
											</table>
										</td>
										<tr><td colspan='2'>&nbsp;</td></tr>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
				
								<?php 
				if($recnumSearchLab[14] !='0')
				{
				?>				

				<tr>
					<td colspan='2'>ความคิดเห็นอาจารย์ &nbsp;:&nbsp;<?php echo "$teaName"; ?></td>
				<tr>	
					<td colspan='2'>
					<?php 
						echo "<textarea rows='10' cols='177' disabled>".$recnumSearchLab[18]."</textarea>";
					?>
					</td>
				</tr>
				
				<?php
				}
				?>
								
				<!---  -->
				<?php 
				if($recnumSearchLab[15] !='0' && $recnumSearchLab[14] !='0')
				{
				?>
				
				<tr>
					<td colspan='2'>ความคิดเห็นเจ้าหน้าที่ห้องปฏิบัติการ &nbsp;:&nbsp;<?php echo "$staffName"; ?></td>
				<tr>	
					<td colspan='2'>
					<?php 
						echo "<textarea rows='10' cols='177' name='offCM' disabled>".$recnumSearchLab[19]."</textarea>";
					?>
					</td>
				</tr>
				<?php
				}

				if($recnumSearchLab[16] !='0')
				{
				?>
				<tr>
					<td colspan='2'>ความคิดเห็นผู้บริหาร &nbsp;:&nbsp;<?php echo "$boName"; ?></td>
				<tr>	
					<td colspan='2'>
					<?php 
						echo "<textarea rows='10' cols='177' name='boCM' disabled>".$recnumSearchLab[20]."</textarea>";
					?>
					</td>
				</tr>
				<?php
				}
				?>

		</table>
		<br><br>
	</body>
</html>