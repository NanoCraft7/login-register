<?php
include '../login-register/conn.php';

	if (!empty($_SESSION['user_id']))
	{
	    $session_user_id = $_SESSION['user_id'];
	}

	function loggedInCheck() {
		if (empty($session_user_id))
		{
		    header("Location: ../login-register/login_form.php");
		}
	}

	function loginForm() {
		echo "<form method='post'>";
			echo "<input type='text' name='name'><br>";
			echo "<input type='text' name='password'><br>";
			echo "<input type='submit' name='submit'>";
			echo "<a href='../login-register/register'>register</a>";
		echo "</form>";
	}

	function loginVal() {
	    $conn = connectDB();
		if (isset($_POST['submit'])) {
			if (strlen($_POST['name']) > 0 && strlen($_POST['password']) > 0){
				$username = $_POST['name'];
				$password = hash('sha256', $_POST['password']);
				$stmt = $conn->prepare($sql = "SELECT * FROM users WHERE name='$username'");
    			$result = $conn->query($sql);
    			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
				var_dump($rows);
    			if (count($rows) == 0) {
			        echo "Nothing";
			        return false;
			    } else {
					if ($password == $row['password']) {
						$_SESSION['user_id'] = $row[id];
					}
				}
			}
		}
	}
?>