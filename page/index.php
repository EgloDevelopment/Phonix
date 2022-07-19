<?php
error_reporting(0);
session_start();

if ($_GET['a'] == 'js') {
    echo 'Sorry, you need Javascript enabled to use Phonix.';
} else {
    echo 'You look lost, <a href="../">go home?</a>';
}
?>