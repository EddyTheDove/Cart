<?php
include_once('Base.php');

class Product extends Base
{
    protected $sku = '';
    protected $name = '';
    protected $price = 0;
    protected $discount = 0;

    public function __construct($params) {
        $this->sku = $params['sku'];
        $this->name = $params['name'];
        $this->price = $params['price'];
        $this->discount = $params['discount'] ?? 0;
    }

    // magic getters just for efficiency purposes
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

}
