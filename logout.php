<?php
session_start();
session_unset();
session_destroy();
header("Location: /pw_tubes_243040038/login.php");
exit;
