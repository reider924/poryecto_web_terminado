<?php
header('Referrer-Policy: no-referrer');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Content-Security-Policy: self');;
header('Permissions-Policy: geolocation "none";camera "none"; speaker "none";');
header('Strict-Transport-Security max-age=31536000');
header ("Location: dist/authentication/flows/basic/index.php");
?>