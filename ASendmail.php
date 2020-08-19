<?php
	session_start();
	require_once __DIR__. "/phpmailer/PHPMailerAutoload.php";
	header('Content-Type: text/html; charset=utf-8');
	
	require('connectDB.php');
	
	$memCode = $_SESSION['memCode'];
	$facName = $_SESSION['facName'];
	$depName = $_SESSION['depName'];
	$labCode = $_REQUEST['labCode'];
	$dates = $_REQUEST['dates'];
	
	function getMember($memCode)
	{
		require('connectDB.php');

		$sqlSearchMem = "select * from member where memCode='".$memCode."'";
		$resultSearchMem = mysqli_query($con,$sqlSearchMem);

		if($resultSearchMem == null)
		{
			echo "คำสั่งผิด";
		}
	
		$recnumSearchMem = mysqli_fetch_array($resultSearchMem);
		if($recnumSearchMem ==0)
		{
			echo "ไม่พบข้อมูล";
		}
	
		$memName  = $recnumSearchMem[4];
		$email = $recnumSearchMem[5];
		$passmail = $recnumSearchMem[6];
			
		return array($memName,$email,$passmail);
	}
	

	list($AmemName,$Aemail,$Apassmail) = getMember($memCode);
	
	

	if(trim($AmemName) == '' || trim($Aemail) == '' || trim($Apassmail) == '')
	{
		echo "<script>
				alert('กรุณากรอกข้อมูลส่วนตัวให้สมบูรณ์');
				window.open('AEditProfile.php?memCode=$memCode','_self')
			</script>";

	}

	
	function getMailReciver($labCode)
	{
		require('connectDB.php');
		
		$sqlSearchLab = "select * from lab where labCode ='$labCode';";
		$resultSearchLab = mysqli_query($con,$sqlSearchLab);
		if($resultSearchLab == null)
		{
			echo "คำสั่งผิด";
		}

		$recnumSearchLab = mysqli_fetch_array($resultSearchLab);
		if($recnumSearchLab == 0)
		{
			echo "ไม่พบข้อมูล";
		}
		
		$teaCode = $recnumSearchLab[24];
		list($tMemName,$tEmail,$tPassmail) = getMember($teaCode);
		
		return $tEmail;

	}

	$mailTeacher = getMailReciver($labCode);
	

	//mail---------------------------

	$mail = new PHPMailer;
	$mail->CharSet = "utf-8";
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	
	//------------------

	$gmail_username = $Aemail; // gmail ที่ใช้ส่ง
	$gmail_password = $Apassmail; // รหัสผ่าน gmail
	// ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1

	$senderTxt = $AmemName." ".$facName." ภาควิชา".$depName." วิทยาเขตหาดใหญ่";
	

	$sender = $senderTxt; // ชื่อผู้ส่ง
	$email_sender = $Aemail; // เมล์ผู้ส่ง 
	$email_receiver = $mailTeacher; // เมล์ผู้รับ ***

	$subject = "ขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์ ภาควิชาสัตวศาสตร์ คณะทรัพยากรธรรมชาติ"; // หัวข้อเมล์


	$mail->Username = $gmail_username;
	$mail->Password = $gmail_password;
	$mail->setFrom($email_sender, $sender);
	$mail->addAddress($email_receiver);
	$mail->Subject = $subject;

	$contentTxt = "<!DOCTYPE html>
	<html>
		<head>
			<meta charset=utf-8'/>
			<title>ขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์ ภาควิชาสัตวศาสตร์ คณะทรัพยากรธรรมชาติ</title>
		</head>
		<body>
			แจ้งเตือนเจ้าหน้าที่ห้องปฏิบัติการขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์  ".$senderTxt."
			<br><a href='http://localhost/project/login.php'>เข้าสู่ระบบขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์</a>
		</body>
	</html>";
	
	$email_content = $contentTxt;

//  ถ้ามี email ผู้รับ
if($email_receiver){
	$mail->msgHTML($email_content);

	if (!$mail->send()) {  // สั่งให้ส่ง email
		
		$errorTxt = $mail->ErrorInfo;
		// กรณีส่ง email ไม่สำเร็จ
		echo "<script>
				alert('ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง $errorTxt');
				window.open('AManageLab.php','_self');
			</script>";
	}else{
		
		//-------------ส่งอีเมล?สำเร็จปิดปุ่มแก้ไข ปุ่มลบ
		$sqlUpdateAfterSend = "update lab set send='1',labStatus='0',labDate='$dates' where labCode='$labCode';";
		$resultUpdateAfterSend = mysqli_query($con,$sqlUpdateAfterSend);

		if($resultUpdateAfterSend == null)
		{
			echo "คำสั่งผิด";
		}

		//-------------
		
		// กรณีส่ง email สำเร็จ
		echo "<script>
				alert('ระบบได้ส่งข้อความไปเรียบร้อย');
				window.open('AManageLab.php','_self');
			</script>";
	}	
}else
{
		echo "<script>
				alert('ระบบขัดข้องโปรดลองใหม่ภายหลัง');
				window.open('AManageLab.php','_self');
			</script>";
}

?>