<?php

function truncate($text, $length) {
    return substr($text, 0, $length) . "...";
}

function formatPrice($amount) {
    return "$" . number_format($amount, 2);
}

function getCurrentYear() {
    return date("Y");
}
?>