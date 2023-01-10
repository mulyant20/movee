<?php
    function getPrice($price, $discount) {
        $disc = ($discount/100) * $price;
        return format($price - $disc);
    }

    function getPerDay($price, $days) {
        return format(ceil($price / $days));
    }

    function format($price) {
        return number_format($price, 0, '', '.');
    }