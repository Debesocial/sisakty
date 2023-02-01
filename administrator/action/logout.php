<?php 
// Copyright Andika Debi Putra 2020
// mengaktifkan session php
session_start();

// menghapus semua session
session_destroy();

// mengalihkan halaman ke halaman login
header("location:../index.php");
?>