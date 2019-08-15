<?php
include ("header.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Login</title>
</head>
<body>
	<div id="content" class="clearfix">
		<form method="post">
			<table>
				<h2><b><pre></pre>Login</b></h2><br>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" id="username" required></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" id="password" required></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" id="submit" value="Login"></td>
					<td><input type="reset" name="reset" id="reset" value="Reset"></td>
				</tr>
			</table>
			<?php
			if(isset($_POST['submit'])){
				include "db_config.php";
				session_start();

				$dbConnection = mysqli_connect($host, $username, $password);

				if(!$dbConnection)
				die("Could not connect to the database. Remember this will only run on the Playdoh server.");

				mysqli_select_db($dbConnection, $dbname);

				$sqlQuery = "SELECT * FROM adminusers";

				$result = mysqli_query($dbConnection,$sqlQuery);

				$rowCount = mysqli_num_rows($result);
				$found = "not found";
				for($i = 0; $i < 1; ++$i){

					$row = mysqli_fetch_row($result);

					if ($_POST['username'] == $row[1] && $_POST['password'] == $row[2]){

						$time=time();
						$currentTime= date("Y-m-d",$t) . " / " . $time;
						$sqlQuery = "UPDATE 'adminusers' SET 'Lastlogin' = '$currentTime' WHERE 'AdminID' = 1 ";

						$_SESSION["username"] = $row[1];
						$_SESSION["AdminLevel"] = $row[3];
						$_SESSION["Lastlogin"] = "$currentTime";
						$_SESSION["submit"] = $_POST["submit"];

						header('Location: internal.php');
						$found = "found";
						echo '<meta http-equiv="refresh" content="0;URL=internal.php" />';
						break;
					}
					else
					$_SESSION["submit"] = null;
					echo "username and password was not authenticated";
				}
				mysqli_close($dbConnection);
			}
			?>

			<br /> <br />
		</form>
		<?php echo '<p>Session ID: ' . session_id() . '</p>';?>
	</div>

	<?php include("footer.php"); ?>
</body>
</html>
