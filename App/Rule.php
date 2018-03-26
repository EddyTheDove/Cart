<?php
include_once('Base.php');

class Rule extends Base
{
    protected $sku = '';  // product sku
    protected $type = ''; // discount | freebie |
    protected $apply_at = '';
    protected $target = ''; // target product sku
    protected $quantity = ''; // number of target products

    public function __construct($params) {
        $this->sku = $params['sku'];
        $this->type = $params['type'];
        $this->apply_at = $params['apply_at'];
        $this->target = $params['target'];
        $this->quantity = $params['quantity'] ?: 1;
    }
}
