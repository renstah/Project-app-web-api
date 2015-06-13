<?php
	//$con = mysqli_connect("mysql.hostinger.nl","u647199358_speet","QsHF6NeUHAaMDgJY6U","u647199358_speet");
	$con = mysqli_connect("localhost","root","","speet");

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
