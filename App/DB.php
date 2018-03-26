<?php
include_once('Rule.php');
include_once('Product.php');

class DB
{
    public static function getProducts () {
        return [
            new Product([ 'sku' => '9325336130810', 'name' => 'Game of Thrones: Season 1', 'price' => '3949' ]),
            new Product([ 'sku' => '9325336028278', 'name' => 'The Fresh Prince of Bel-Air', 'price' => '1999' ]),
            new Product([ 'sku' => '9780201835953', 'name' => 'The Mythical Man-Month', 'price' => 3187, 'discount' => 2199 ]),
            new Product([ 'sku' => '9781430219484', 'name' => 'Coders at Work', 'price' => 2872 ]),
            new Product([ 'sku' => '9780132071482', 'name' => 'Artificial Intelligence', 'price' => 11992 ])
        ];
    }


    public static function getProduct ($sku) {
        foreach(self::getProducts() as $product) {
            if ($product->sku === $sku) {
                return $product;
            }
        }
        return false;
    }


    public static function getRules () {
        return [
            new Rule([
                'sku'       => '9780201835953',
                'target'    => '9780201835953',
                'apply_at'  => 10,
                'type'      => 'discount',
                'quantity' => 0
            ]),

            new Rule([
                'sku'       => '9781430219484',
                'target'    => '9781430219484',
                'apply_at'  => 3,
                'type'      => 'freebie',
                'quantity'  => 1
            ]),

            new Rule([
                'sku'       => '9325336130810',
                'target'    => '9325336028278',
                'apply_at'  => 1,
                'type'      => 'freebie',
                'quantity'  => 1
            ])
        ];
    }
}
