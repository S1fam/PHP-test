<?php

class ShoppingCart {
    private array $items = [];
    private $coupon = "";
    private $finalPrice = 0;

    function __construct(array $items, string $coupon) {
        if(count($items) < 1) {
            echo "košík je prázdný";
            exit(1);
        }
        $this->items = $items;
        $this->coupon = $coupon;
    }

    function calculateFinalPrice() {
        $priceWithoutCoupon = 0;
        for($x = 0; $x < count($this->items); $x++) {
            $priceWithoutCoupon += $this->items[$x][0] * $this->items[$x][1];
        }
        $this->finalPrice = $this->applyCoupon($priceWithoutCoupon);
        $this->finalPrice += 99; // cena za dopravu až po uplatnění kupónu (aby LETO10 neodečítal 10% z cena+doprava)
    }

    private function applyCoupon(int $priceWithoutCoupon) {
        switch($this->coupon) {
            case 'LETO10':
                return $priceWithoutCoupon - (0.1 * $priceWithoutCoupon);
            case 'STOVKA':
                if($priceWithoutCoupon > 1000) { 
                    return $priceWithoutCoupon -= 100; 
                } else {
                    return $priceWithoutCoupon;
                }
            case 'DOPRAVA':
                return $priceWithoutCoupon -= 99;
            case '':  // pokud kupón není vyplněn
                return $priceWithoutCoupon;
            default:  // pokud je zadán neplatný kupón
                echo "neplatný kupón\n";
                exit(1);
        }
    }

    public function getFinalPrice() : float {
        return $this->finalPrice;
    }
}

?>