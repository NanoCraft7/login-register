<?php
if (!empty($_SESSION['user_id']))
{
    $session_user_id = $_SESSION['user_id'];
}

if (empty($session_user_id))
{
    // header("Location: ../login/login_form.php");
}
?>