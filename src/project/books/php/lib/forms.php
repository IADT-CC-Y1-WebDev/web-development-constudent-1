<?php

function old($key, $default = '') {
    if (isset($_SESSION['form_data'][$key])) {
        return htmlspecialchars($_SESSION['form_data'][$key]);
    }
    return htmlspecialchars($default);
}

function error($key) {
    if (isset($_SESSION['form_errors'][$key])) {
        return '<span class="error-message">' . htmlspecialchars($_SESSION['form_errors'][$key]) . '</span>';
    }
    return '';
}

function chosen($key, $value, $default = []) {
    $selected = $_SESSION['form_data'][$key] ?? $default;
    
    if (is_array($selected)) {
        return in_array($value, $selected);
    }
    return (string)$selected === (string)$value;
}

function clearFormData() {
    unset($_SESSION['form_data']);
}

function clearFormErrors() {
    unset($_SESSION['form_errors']);
}