<?php

function redirect($url) {
    header("Location: $url");
    exit();
}


function setFormData($data) {
    $_SESSION['form_data'] = $data;
}

function setFormErrors($errors) {
    $_SESSION['form_errors'] = $errors;
}

function h($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}