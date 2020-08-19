<?php
	header('Content-type: application/json; charset=UTF-8');

	//รับรหัสประเภทนักวิจัย
	$catCode = $_GET['catCode'];
	
	require('connectDB.php');
	
	//ไปดูว่ามี ค่าวิเคราะห์อะไรบ้าง
	$sqlSearchAna = "select * from analysislist;";
	$resultSearchAna = mysqli_query($con,$sqlSearchAna);

	//เมื่อคำสั่งผิด
	if($resultSearchAna == null)
	{
		echo "คำสั่งผิด";
	}
	
	//อินเด็กเริ่มต้นที่ 0 
	$i=0;
	//สำหรับใส่แต่ละค่าวิเคราะห์ลงไปนะ
	$result_json = array();
	
	//จำนวนลูปเท่ากับ ค่าวิเคราะห์
	while($recnumSearchAna = mysqli_fetch_array($resultSearchAna))
	{
		//ค้นหาราคาของค่าวิเคราะห์ของ anaCode ที่ 1 กับ   รหัสประเภทนักวิจัยที่ส่งมา มีค่าเท่าไหร เลือกมาแค่ 1 record
		$sqlSearchCharge = "select * from serviceChargelist where catCode='$catCode' and anaCode='$recnumSearchAna[0]' limit 1;";
		$resultSerachCharge = mysqli_query($con,$sqlSearchCharge);
		
		if($resultSerachCharge== null)
		{
			echo "คำสั่งผิด";

		}else
		{	
			//เข้าไป
			while($recnumSearchCharge = mysqli_fetch_array($resultSerachCharge))
			{
				$record_json = new stdClass();
				$record_json->scCode = $recnumSearchCharge[0];
				$record_json->catCode = $recnumSearchCharge[1];
				$record_json->anaCode = $recnumSearchCharge[2];
				//$record_json->simCpde = $recnumSearchCharge[3];
				$record_json->price = $recnumSearchCharge[4];
				$result_json[$i] = ($record_json);
				$i++;
			}
		}
	}

	echo json_encode($result_json);
?>