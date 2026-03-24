<?php
function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function setFlashMessage($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlashMessage() {
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

function setFormData($data) {
    $_SESSION["form_data"] = $data;
}

function getFormData() {
    return $_SESSION["form_data"] ?? [];
}

function setFormErrors($errors) {
    $_SESSION["form_errors"] = $errors;
}

function getFormErrors() {
    return $_SESSION["form_errors"] ?? [];
}

function clearFormData() {
    if (isset($_SESSION["form_data"])) {
        unset($_SESSION["form_data"]);
    }
}

function clearFormErrors() {
    if (isset($_SESSION["form_errors"])) {
        unset($_SESSION["form_errors"]);
    }
}
?>