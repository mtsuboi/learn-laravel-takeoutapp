<?php

namespace App\Models;

class Cart
{
    public $item_id;
    public $item_name;
    public $unit_price;
    public $quantity;
    public $item_image_path;

    public function __construct($item_id, $item_name, $unit_price, $quantity, $item_image_path)
    {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->unit_price = $unit_price;
        $this->quantity = $quantity;
        $this->item_image_path = $item_image_path;
    }
}
