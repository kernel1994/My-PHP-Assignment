<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/8
 * Time: 15:42
 */
session_start();
if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}
header("Location: /h5-php/login.html");
