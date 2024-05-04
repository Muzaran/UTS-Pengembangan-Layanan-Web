<?php
class Product {
    public $id;
    public $name;
    public $price;
    public $category_id;
    public $supplier_id;

    public function __construct($id, $name, $price, $category_id, $supplier_id) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->supplier_id = $supplier_id;
    }
}

class Category {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
}

class Supplier {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
}

class Transaction {
    public $id;
    public $product_id;
    public $quantity;
    public $total_amount;

    public function __construct($id, $product_id, $quantity, $total_amount) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->total_amount = $total_amount;
    }
}
?>
