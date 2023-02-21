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
				$formUsername = $_POST['name'];
				$formPassword = hash('sha256', $_POST['password']);
				$stmt = $conn->prepare($sql = "SELECT * FROM users WHERE name='$formUsername'");
    			$result = $conn->query($sql);
    			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
				var_dump($rows);
    			if (count($rows) > 0) {
					$DBPassword = hash('sha256', $rows[0]["password"]);
					echo $rows[0]["password"];
					if ($formPassword == $DBPassword) {
						$_SESSION['user_id'] = $rows[0]["id"];
						header("../login-register/_index.php");
					} else {
						echo "no";
					}
			    } else {
			        echo "Nothing";
			        return false;
				}
			}
		}
	}
?>