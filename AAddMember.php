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
	<title>เพิ่มสมาชิก</title>
	<meta charset="utf-8">

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
			border:0px solid black;
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
		
		input[type="text"],input[type="password"],input[type='email']{
			width: 300px;
			padding: 0.4em;
			border-radius: 0.2em;
			border: 1px solid #ccc;
			outline: none;
		}

		input[type="submit"]{
			width: 100%;
			padding: 1em;
			border-radius: 30px; 
			border: none;
			color: #fff;
			background-color: #5ABEFF;
			font-size: 1em;
			cursor:pointer;
		}

		#addTel,.delTel {
			cursor:pointer;
		}

		select, textarea {
			width: 300px;
			padding: 0.4em;
			border-radius: 0.2em;
			border: 1px solid #ccc;
			outline: none;
		}

		select:focus, textarea:focus {
			box-shadow: 0 0 0.5em #2a76e6;
			border-color: #2a76e6;
			padding: 0.4em;
			border: 1px solid #2a76e6;
			outline: none;
		}

		input[type="text"]:focus,input[type="password"]:focus,input[type='email']:focus {
			box-shadow: 0 0 0.5em #2a76e6;
			border-color: #2a76e6;
			padding: 0.4em;
			border: 1px solid #2a76e6;
			outline: none;
		}

		#myTables {
			border: 1px solid black;
			border-collapse: separate;
			border-radius: 5px;
			padding:10px;
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
	<script>
		$(document).ready(function(){

			$('#signOut').click(function(){
				window.open('logout.php','_self');
			});
			
			//เมื่อselect เปลี่ยน -> ให้รับ value->หาว่ามีภาควิชาอะไรบ้าง เก็บใส่ json->แสดงออกมา
			$('#facChange').change(function(){
				facCode = $('#facChange').val();
				
				//alert(facCode);
				$.get("getDepartment.php?facCode="+facCode,function(data,status){
					if(status=="success")
					{
						$('#depChange').html("");
						$('#depChange').append("<option name='-1' value='-1' selected>กรุณาเลือกสาขา</option>");
						for(i=0; i<data.length ; i++)
						{
							$('#depChange').append("<option name="+data[i].depCode+" value="+data[i].depCode+">"+ data[i].depName+"</option>");
						}
						
					}else
					{
						alert('ERROR');
					}
				});
			});

			//สร้างบอกว่า นี้คือ แถวที่ 0
			var i = 0;

			$("#addTel").click(function(){
				//ให้แถวเพิ่มที่ละ 1 
				i++;
				//ต่อ table ให้ระบุ id ของแต่ละแถว ที่ถูกเพิ่ม  สร้างปุ่มลบ ให้ id ปุ่มเท่ากับแถวที่ระบุ สร้าง class delTel สำหรับเรียกใช้ ทำการลบ
				$("#mytable").append("<tr id="+i+"><td></td><td><input type='text' name='tel[]' id='tel' onkeypress='return chkNumber(event.charCode)'><u id='"+i+"' class='delTel' style='color:red'>X</u></td></tr>");
				
			});
			
			//คลิ๊ก ปุ่ม delTel เรียกแบบ class จากนั้น ไปหา id ของมัน เอา id นี้ใช้สำหรับหา ตำแหน่ง id แถวที่จะลบ
			$(document).on('click','.delTel',function(){
				var bt_id = $(this).attr('id');
				txt_rowID = "#"+bt_id;
				$(txt_rowID).remove();
			});

			//------------
			$('#chkPassword').on('click',function(){
				
				if($(this).is(':checked'))
				{
					$('#password').attr('type','text');
				}else
				{
					$('#password').attr('type','password');
				}
			
			});

			$('#chkPassmail').on('click',function(){
				
				if($(this).is(':checked'))
				{
					$('#passmail').attr('type','text');
				}else
				{
					$('#passmail').attr('type','password');
				}
			
			});


//-----------


		});
		
		function chkData()
		{
			check = false;
			
			username = $('#username').val();
			password = $('#password').val();
			facCode = $('#facChange').val();
			depCode = $('#depChange').val();
			
			if(username.trim() != '' && password.trim() != '' && facCode !='-1' && depCode !='-1')
			{
				check = true;
			}else
			{
				if(facCode =='-1')
				{
					alert('กรุณาเลือกคณะ');
					$('#facChange').focus();

				}else
				{
					if(depCode =='-1')
					{
						alert('กรุณาเลือกสาขา');
						$('#depChange').focus();
					}else
					{
						if(username.trim() == '')
						{
							alert('กรุณากรอกรหัสบัญชี');
							$('#username').focus();
						}
						else
						{
							if(password.trim() == '')
							{	
								alert('กรุณากรอกรหัสผ่าน');
								$('#password').focus();
							}
						}
					}
				}
			}

			return check;
		}


		function chkNumber(digit)
		{
			chkTel = false;
			
			if(digit >=48 && digit <=57)
			{
				chkTel = true;
			}
			else
			{
				alert('กรุณากรอกเฉพาะตัวเลข');
			}
	
			return chkTel;
		}
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
	
	<!--- ส่วนข้อมูล   -->
	
	<table id='myTables' width='100%' cellspacing='10' cellpadding='5'>
		<tr>
			<td colspan='3'><a href='Amain.php'> ระบบขอใช้ห้องปฏิบัติการวิเคราะห์อาหารสัตว์ > เจ้าหน้าที่ห้องปฏิบัติการ</a> > <a href='AManageMember.php'>จัดการสมาชิก</a> > เพิ่มสมาชิก</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<div align='center'>
					<h2>เพิ่มสมาชิก</h2>
				</div>
	
	<form name='addMember' id='addMember' action='AAddFormMember.php' method='POST' onsubmit='Javascript:return chkData()'>
		<table border='0' id='mytable' cellpadding='10' align='center'>
		
			<tr>
				<td>กลุ่มผู้ใช้งาน</td>
				<td>
					<input type='radio' name='level' value='1' checked>นักศึกษา
					<input type='radio' name='level' value='2'>อาจารย์
					<input type='radio' name='level' value='3'>เจ้าหน้าที่
					<input type='radio' name='level' value='4'>ผู้บริหาร
				</td>
			</tr>
			<tr>
				<td>คณะ</td>
				<td>
					<select name='facCode' id='facChange'>
						<option name='-1' value='-1' selected>กรุณาเลือกคณะ</option>
			
<?php
	
	require('connectDB.php');
	
	//ต้องการคณะ
	$sqlFac = 'select * from faculty;';
	$resultFac = mysqli_query($con,$sqlFac);
	
	//ตรวจสอบคำสั่งถูกไหม
	if($resultFac == null)
	{
		echo "คำสั่งผิด";
	}
	
	//แสดงผลลัพธ์
	while($recnumFac = mysqli_fetch_array($resultFac))
	{
		echo "<option name=$recnumFac[0] value=$recnumFac[0] >$recnumFac[1]</option>";
	}
?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td id='dep'>สาขา</td>
				<td>
					<select name='depCode' id='depChange'>
						<option name='-1' value='-1' selected>กรุณาเลือกสาขา</option>	
					</select>
						
				</td>
			</tr>
			
			<tr>
				<td>รหัสบัญชี</td>
				<td>
					<input type='text' name='username' id='username'>
				</td>
			</tr>
	
			<tr>
				<td>รหัสผ่าน</td>
				<td>
					<input type='password' name='password' id='password'>
					<input type='checkbox' id='chkPassword'>แสดง
				</td>
			</tr>
			
			<tr>
				<td for='name'>ชื่อ-นามสกุล</td>
				<td>
					<input type='text' name='name' id='name'>
				</td>
			</tr>
			
			<tr>
				<td for='email'>อีเมล์</td>
				<td>
					<input type='email' name='email' id='email'>
					<a href=' https://myaccount.google.com/lesssecureapps?pli=1'>ตั้งค่าการส่งอีเมล์</a>
				</td>
		
			</tr>
			<tr>
				<td for='passmail'>รหัสผ่านอีเมล์</td>
				<td>
					<input type='password' name='passmail' id='passmail'>
					<input type='checkbox' id='chkPassmail'>แสดง
				</td>
			</tr>
<!---- เริ่มเบอร์โทร -->	
			<tr>
				<td>เบอร์โทร</td>
				<td>
					<input type='text' name='tel[]' id='tel' onkeypress='return chkNumber(event.charCode)'>
					<u id='addTel' style='color:blue'>เพิ่มเบอร์</u>
				</td>
			</tr>
<!---- จบเบอร์โทร -->
		</table>
		
		<br><br>
		<input type='submit' id='submit' value='เพิ่มสมาชิก'>&nbsp;
		
	</form>
			
			</td>
		</tr>
	</table>
	<br><br>

</body>
</html>