<?php
    /*
    * Author: Akansh Sirohi
    */
    function filter_str($str) {
        $str=iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
        $str=addcslashes($str,"'");
        $str=addcslashes($str,'"');
        return htmlspecialchars($str);
    }
?>  