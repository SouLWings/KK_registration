<?php
include 'func';
connectDB();
if($result = mysql_query("select * from newtable")){//id,sel,ic
	echo 'select query success';
	while($row = mysql_fetch_assoc($result))
	{
		if(mysql_query("update oldtable set sel = $row['sel'] where ic = $row['ic']"))
			echo 'student $ic updated';
		else
			echo 'fail update student $ic';
	}
}
else
echo 'failed';

?>