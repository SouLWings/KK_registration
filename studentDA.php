<?php 
session_start();
include 'func.php';
connectDB();
if(isset($_SESSION['login']) && isset($_POST['action']))
{
	//insert a student record from admin
	if($_POST['action'] == 'insert')
	{
		if(isset($_POST['name']) && !empty($_POST['name']) &&isset($_POST['ic']) && !empty($_POST['ic']) &&isset($_POST['matric']) && !empty($_POST['matric']) &&isset($_POST['room']) && !empty($_POST['room'])&&isset($_POST['sel']) && !empty($_POST['sel']) && isset($_POST['race']))
		{
			$ic = strtoupper($_POST['ic']);
			$m = strtoupper($_POST['matric']);
			$name = strtoupper($_POST['name']);
			$room = strtoupper($_POST['room']);
			$sel = strtoupper($_POST['sel']);
			$race = strtoupper($_POST['race']);
			$last = substr($ic, -1);
			$gender='MALE';
			if($last%2==0)
				$gender = 'FEMALE';
			if(mysql_num_rows(mysql_query("SELECT * FROM student WHERE ic='$ic'")) == 0)
				if(mysql_num_rows(mysql_query("SELECT * FROM student WHERE matricNum = '$m'")) == 0)
					if(mysql_query("INSERT INTO `student` ( `name` , `matricNum` , `ic` , `roomNum` , `sel` , `gender`,  `race`) VALUES ('$name',  '$m',  '$ic',  '$room', '$sel' , '$gender',  '$race')"))
						header("Location:adminhome.php?r=4&s=t&n=$name");
					else
						header("Location:adminhome.php?r=4&s=fe=0");
				else
					header("Location:adminhome.php?r=4&s=f&e=2"); 
			else
				header("Location:adminhome.php?r=4&s=f&e=1"); 
		}
		else
			header("Location:adminhome.php?r=4&s=f&e=3"); 
	}
	else if($_POST['action'] == 'edit')
	{
		if(isset($_POST['name']) && !empty($_POST['name']) &&isset($_POST['ic']) && !empty($_POST['ic']) &&isset($_POST['matric']) && !empty($_POST['matric']) && isset($_POST['gender']) && !empty($_POST['gender']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['race']) && isset($_POST['religion']) && isset($_POST['room']) && !empty($_POST['room']) && isset($_POST['laptop']) && !empty($_POST['laptop']) && isset($_POST['checkedIn']) && !empty($_POST['checkedIn']) && isset($_POST['id']) && !empty($_POST['id']))
		{
			$id = $_POST['id'];
			$name = strtoupper($_POST['name']);
			$ic = strtoupper($_POST['ic']);
			$matric = strtoupper($_POST['matric']);
			$gender = strtoupper($_POST['gender']);
			$address = strtoupper($_POST['address']);
			$phone = strtoupper($_POST['phone']);
			$email = strtoupper($_POST['email']);
			$race = strtoupper($_POST['race']);
			$religion = strtoupper($_POST['religion']);
			$room = strtoupper($_POST['room']);
			$laptop = strtoupper($_POST['laptop']);
			$checkedIn = strtoupper($_POST['checkedIn']);
			
			if(mysql_num_rows(mysql_query("SELECT * FROM student WHERE id=$id")) == 1)
				if(mysql_query("UPDATE `student` SET name = '$name',  ic = '$ic', matricNum = '$matric',  gender = '$gender', address = '$address', phone = '$phone', email = '$email', race = '$race', religion = '$religion', roomNum = '$room', haveLaptop = '$laptop', isCheckedIn = '$checkedIn' WHERE id = $id"))
					header("Location:adminhome.php?r=1&a=e&s=t&ic=$ic");
				else
					header("Location:adminhome.php?r=1&a=e&s=f&e=1&ic=$ic");//error 1 = update query failed;
			else
				header("Location:adminhome.php?r=1&a=e&s=f&e=2&ic=$ic"); //error 2 = student not found.
		}	
		else
			header("Location:adminhome.php?r=1&a=e&s=f&e=3&ic=$ic");//error 3 = incomplete form
	}
	else if($_POST['action'] == 'delete')
	{
		if(isset($_POST['ic']) && !empty($_POST['ic']))
		{
			$ic = strtoupper($_POST['ic']);
			if(mysql_num_rows(mysql_query("SELECT * FROM student WHERE ic=$ic")) == 1)
				if(mysql_query("DELETE FROM student WHERE ic='$ic'") == 1)
					header("Location:adminhome.php?r=1&a=d&s=t&ic=$ic");
				else
					header("Location:adminhome.php?r=1&a=d&s=f&e=1&ic=$ic");
			else
				header("Location:adminhome.php?r=1&a=d&s=f&e=2&ic=$ic");
		}
		else
			header("Location:adminhome.php?r=1&a=d&s=f&e=3&ic=$ic");//error 3 = incomplete form
	}
}
else
{
	header("Location:adminlogin.php");
}
?>