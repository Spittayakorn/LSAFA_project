<?php

	$labDate = $_POST['labDate'];
	$labName = $_POST['labName'];
	$catCode = $_POST['catCode'];
	$labTel = $_POST['labTel'];
	$objCode = $_POST['objCode'];
	$objTitle = $_POST['objTitle'];
	$labNRepeat = $_POST['labNRepeat'];
	$labSDate = $_POST['labSDate'];
	$labEDate = $_POST['labEDate'];
	$boCode = $_POST['boCode'];
	$memCode = $_POST['memCode'];
	$labNo = $_POST['labNo'];
	$labYear = $_POST['labYear'];
	
	if(isset($_POST['anaCode']))
	{
		$anaCode = count($_POST['anaCode']);
	}

	if(isset($_POST['simCode'])){
		$simCode = count($_POST['simCode']);
	}

	if(isset($_POST['volume']))
	{
		$volume = count($_POST['volume']);
	}
	
	/*
	echo "$labDate&nbsp;$labName&nbsp;$catCode&nbsp;$labTel&nbsp;$objCode&nbsp;$objTitle&nbsp;$labNRepeat&nbsp;$labSDate &nbsp;$labEDate&nbsp;$boCode&nbsp;$memCode";
	*/
	
	require('connectDB.php');
	
	//ฟังก์ชันสุ่มรหัสเอกสาร
	function getName($n) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 
  
		for ($i = 0; $i < $n; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 
	return $randomString; 
	}
	

	$sqlSearchLabNo = "select * from documentlab where docnoLab = '$labNo';";
	$resultSearchLabNo = mysqli_query($con,$sqlSearchLabNo);
	
	if($resultSearchLabNo == null)
	{
		echo "คำสั่งผิด";
	}
	
	$numRowSearchLabNo = mysqli_num_rows($resultSearchLabNo);

	if($numRowSearchLabNo == 0)
	{


	$sqlAddLabNo = " insert into documentlab values($labNo,'$labNo');";
	$resultAddLabNo = mysqli_query($con,$sqlAddLabNo);
	if($resultAddLabNo == null)
	{
		echo "คำสั่งผิด";
	}
	

	$labDocument = '';
	while(true)
	{
		$labDocument = getName(10);
		$sqlSearchLabDocument = "select * from lab where labDocument='$labDocument';";
		$resultSearchLabDocument = mysqli_query($con,$sqlSearchLabDocument);

		if($resultSearchLabDocument == null)
		{
			echo "คำสั่งผิด";
		
		}

		$recnumRow = mysqli_num_rows($resultSearchLabDocument);
		if($recnumRow == 0)
		{
			break;
		}
	}

	$sqlAddLab = "insert into Lab values ('','".$labDocument."','$labNo','$labYear','$labDate','$labName',$catCode,'$labTel',$objCode,'$objTitle',$labNRepeat,
'$labSDate','$labEDate','0','0','1','0','0','','','','0',$memCode,$memCode,$boCode,'0');";

	$resultAddLab = mysqli_query($con,$sqlAddLab);

	if($resultAddLab == null)
	{
		echo 'คำสั่งผิด';
	}

	$sqlSearchLabCode = "select * from lab where labDocument='".$labDocument."';";
	$resultSearchLabCode = mysqli_query($con,$sqlSearchLabCode);

	if($resultSearchLabCode == null)
	{
		echo "คำสั่งผิด";
	}
	
	$recnumSearchLabCode = mysqli_fetch_array($resultSearchLabCode);
	$labCode =  $recnumSearchLabCode[0];
	
	if(isset($_POST['anaCode']))
	{
		for($i=0;$i<$anaCode;$i++)
		{
			/*
			echo "<br>รหัสประเภทนักวิจัย คือ $catCode รหัสค่าวิเคราะห์    คือ   '".$_POST['anaCode'][$i]."'  รหัสชนิดตัวอย่าง คือ    '".$_POST['simCode'][$i]."'ปริมาณ คือ '".$_POST['volume'][$i]."'<br>";
			*/

			$sqlSearchServicePrice = "select * from serviceChargelist where anaCode='".$_POST['anaCode'][$i]."' and simCode='".$_POST['simCode'][$i]."' and catCode='$catCode';";
			$resultSearchServicePrice = mysqli_query($con,$sqlSearchServicePrice);

			if($resultSearchServicePrice == null)
			{
				echo "คำสั่งผิด";
			}

			$recnumSearchServicePrice = mysqli_fetch_array($resultSearchServicePrice);
			$scCode = $recnumSearchServicePrice[0];

			//echo $scCode;
		
			$sqlAddDataAnalysis = "insert into DataAnalysis values('',".$_POST['volume'][$i].",0,$labCode,$scCode);";
			$resultAddDataAnalysis = mysqli_query($con,$sqlAddDataAnalysis);

			if($resultAddDataAnalysis == null)
			{
				echo "คำสั่งผิด";
			}

		}

	}

	echo "<script>
			alert('เพิ่มขอใช้ห้องปฏิบัติการสมบูรณ์');
			window.open('AManageLab.php','_self');
		</script>";
	
	}
	else
	{
		echo "<script>
				alert('เลขที่ซ้ำ');
				window.open('AAddlab.php','_self');
			</script>";
	}
	
?>
