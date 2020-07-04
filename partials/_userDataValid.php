<?php
    function test_input($str) {
        
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        
        return $str;
    }
?>