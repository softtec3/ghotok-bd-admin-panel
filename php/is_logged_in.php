<?php
session_start();
if (!isset($_SESSION) || !isset($_SESSION["admin_id"]) || empty($_SESSION) || $_SESSION["admin_id"] == "" || empty($_SESSION["admin_id"])) {
    header("Location: ./");
    exit();
}
