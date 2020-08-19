<?php
	
	$anaCode = $_GET['anaCode'];
	$pageNo = $_GET['pageNo'];
	require('connectDB.php');
	
	$sqlDelServicePrice = "delete from servicechargelist where simCode='$anaCode';";
	$resultDelServicePrice = mysqli_query($con,$sqlDelServicePrice);

	$sqlDelAna = "delete from simplelist where simCode='$anaCode';";
	
	if(mysqli_query($con,$sqlDelAna))
	{
		echo "<script>
				alert('บันทึกข้อมูลสำเร็จ');
				window.open('AManageSimple.php?pageNo=$pageNo','_self');
			</script>";
	}else
	{
		echo "<script>
				alert('บันทึกข้อมูลล้มเหลว');
				window.open('AManageSimple.php?pageNo=$pageNo','_self');
			</script>";
	}
	
?>