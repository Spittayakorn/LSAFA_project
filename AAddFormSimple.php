<?php

	$anaName = count($_REQUEST['anaName']);
	//echo $anaName;
	
	require('connectDB.php');
	
	if($anaName>0)
	{
		for($i=0;$i<$anaName;$i++)
		{
			if(trim($_REQUEST['anaName'][$i])!='')
			{
				$sqlAddAnaName = "insert into simplelist values('','".$_REQUEST['anaName'][$i]."');";
				$resultAddAnaName = mysqli_query($con,$sqlAddAnaName);		
			}
		}
	}

	echo "<script>
				alert('เพิ่มชนิดตัวอย่างสำเร็จ');
				window.open('AManageServiceChargeQuerySim.php','_self');
			</script>";
	
?>