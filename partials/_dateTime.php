<?php
    function filter_dateTime($dateTime) {
        $d = strtotime($dateTime);
        $date = date("d/m/Y",$d);

        return $date;
    }
?>