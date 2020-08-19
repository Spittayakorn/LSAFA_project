<?php
	
	$anaCode = $_REQUEST['anaCode'];
	$anaName = $_REQUEST['anaName'];
	$pageNo = $_REQUEST['pageNo'];

	//echo "$anaCode$anaName";
	require('connectDB.php');
	
	$sqlUpdate = " update categorys set catName='$anaName' where catCode='$anaCode';";
	$resultUpdate = mysqli_query($con,$sqlUpdate);

	if($resultUpdate == null)
	{
		echo "<script>
				alert('คำสั่งผิด');
				window.open('AManageCat.php?pageNo=$pageNo','_self');
			</script>";
	}else
	{
		echo "<script>
				alert('แก้ไขข้อมูลค่าวิเคราะห์สำเร็จ');
				window.open('AManageCat.php?pageNo=$pageNo','_self');
			</script>";
	}
?>