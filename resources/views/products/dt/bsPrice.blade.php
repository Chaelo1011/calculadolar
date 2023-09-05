<?php
    if ($bs_day) {
        $bs_sale_price = $dollar_sale_price*$bs_day->dolar_user_transference;
        echo "<span>$bs_sale_price Bs</span>";
    } else {
        echo "<span class='text-danger'>Debes ingresar la tasa del dia. <a href='/'>Registrar</a></span>";
    }
?>