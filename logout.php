<?php
session_start();
session_destroy();
header('Location: ' . '/cork/login');
exit();
