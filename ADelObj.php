<?php
	
	$anaCode = $_GET['anaCode'];
	$pageNo = $_GET['pageNo'];
	require('connectDB.php');
	
	$sqlDelAna = "delete from objective where objCode='$anaCode';";
	
	if(mysqli_query($con,$sqlDelAna))
	{
		echo "<script>
				alert('บันทึกข้อมูลสำเร็จ');
				window.open('AManageObj.php?pageNo=$pageNo','_self');
			</script>";
	}else
	{
		echo "<script>
				alert('บันทึกข้อมูลล้มเหลว');
				window.open('AManageObj.php?pageNo=$pageNo','_self');
			</script>";
	}
	
?>