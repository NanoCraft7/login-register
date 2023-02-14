<?php
include '../login/conn.php';

	if (!empty($_SESSION['user_id']))
	{
	    $session_user_id = $_SESSION['user_id'];
	}

	function loggedInCheck() {
		if (empty($session_user_id))
		{
		    header("Location: ../login/login_form.php");
		}
	}

	function loginForm() {
		echo "<form method='post'>";
			echo "<input type='text' name='name'><br>";
			echo "<input type='text' name='password'><br>";
			echo "<input type='submit' name='submit'>";
			echo "<a href='../login/register'>register</a>";
		echo "</form>";
	}

	function loginVal() {
	    $conn = connectDB();
		if (isset($_POST['submit'])) {
			if (strlen($_POST['name']) > 0 && strlen($_POST['password']) > 0){
				$stmt = $conn->prepare($sql = "SELECT * FROM users WHERE name='$_POST[name]', password='$_POST[password]'");
    			$result = $conn->query($sql);
    			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
    			if (count($rows) == 0) {
			        echo "Nothing";
			        return false;
			    }
			}
		}
	}
?>