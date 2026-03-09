<?php
function formatPhoneNumber($number) {
    $areaCode = substr($number, 0, 3); 
    $middle   = substr($number, 3, 3); 
    $last     = substr($number, 6); 
    
    return "(" . $areaCode . ") " . $middle . "-" . $last;
}
?>
