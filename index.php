<?php

require_once './shoppingCart.php';

// Vstup
$inputArray = [  // vstupní pole položek
    [100, 5],    // např. 100 korun x 5 kusu
    [50, 4],
    [500, 1]
];
$coupon = "LETO10";

// Zpracování
$cart = new ShoppingCart($inputArray, $coupon);
$cart->calculateFinalPrice();
echo $cart->getFinalPrice() . "\n";

exit(0);

?>