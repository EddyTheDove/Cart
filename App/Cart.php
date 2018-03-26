<?php

include_once('DB.php');

class Cart
{
    protected $rules    = [];
    protected $order    = [];
    protected $products = [];
    protected $items    = [];

    public function __construct() {
        $this->rules = DB::getRules();
    }

    /**
     * Add product to cart
     * @param Product  $product
     * @param integer $quantity
     */
    public function addProduct($sku, $quantity) {
        $product = DB::getProduct($sku);

        if ($product) {
            $item = (object) [
                'sku' => $sku,
                'off' => 0,
                'price' => $product->price,
                'quantity' => $quantity
            ];

            $itemExists = false;

            for ($i = 0; $i < sizeof($this->items); $i++) {
                if ($this->items[$i]->sku === $sku) {
                    $itemExists = true;
                    break;
                }
            }

            if (!$itemExists) {
                $this->items [] = $item;
            }

            $this->checkForRule($product, $item);
        }
    }


    /**
     * [total description]
     * @return [type] [description]
     */
    public function total ()
    {
        echo "Products in cart: ";

        foreach ($this->items as $item) {
            echo $item->sku . " x " . $item->quantity . ", ";
        }

        echo "<br />Expected total: $";
        $total = 0;

        foreach ($this->items as $item) {
            $total += (($item->price * $item->quantity) - (int) $item->off) / 100;
        }

        echo number_format($total, '2');
    }

    public function toString () {
        print_r($this->items);
    }


    private function checkForRule ($product, $item)
    {
        $productRule = null;

        foreach ($this->rules as $rule) {
            if ($rule->sku === $product->sku) {
                $productRule = $rule;
            }
        }

        // If there is any rule about the product
        if ($productRule) {
            if ($item->quantity >= $productRule->apply_at) {
                if ($productRule->type === 'discount') {
                    $item->price = $product->discount;
                } else {
                    if ($productRule->sku === $productRule->target) {
                        // buy x get 1 free
                        $item->off = $product->price;
                    } else {
                        // buy x get y free
                        $this->makeOneFree($productRule->target);
                    }
                }
            }
        }
    }


    private function makeOneFree ($sku)
    {
        $product = DB::getProduct($sku);

        // Check if the product is already in the items list
        $itemExists = false;
        for ($i = 0; $i < sizeof($this->items); $i++) {
            if ($this->items[$i]->sku === $sku) {
                $this->items[$i]->off = $this->items[$i]->price;
                $itemExists = true;
                echo "price is " . $this->items[$i]->price;
                return;
            }
        }

        if (!$itemExists) {
            $this->items [] = (object) [
                'sku'       => $sku,
                'price'     => $product->price,
                'off'       => $product->price,
                'quantity'  => 1
            ];
        }
    }
}
