<?php
session_start();
session_destroy();
sleep(2);
// Redirect to the login page:
header('Location: ../index.html');