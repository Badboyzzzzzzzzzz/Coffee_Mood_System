<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost:3000/admin-panel/admins/login-admins.php");
exit();

