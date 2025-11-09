<?php
if (isset($_GET["logout"]) && $_GET["logout"]) {
    session_unset();
    session_destroy();
    header("Location: ./");
}
