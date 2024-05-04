<?php
require_once 'app/Model/Model.php';

class Controller {
    public function getProducts() {
        $products = array(
            new Product(1, 'Product 1', 100, 1, 1),
            new Product(2, 'Product 2', 150, 1, 2),
            new Product(3, 'Product 3', 200, 2, 1),
            new Product(4, 'Product 4', 120, 2, 2)
        );
        return $products;
    }

    public function getCategories() {
        $categories = array(
            new Category(1, 'Category 1'),
            new Category(2, 'Category 2')
        );
        return $categories;
    }

    public function getSuppliers() {
        $suppliers = array(
            new Supplier(1, 'Supplier A'),
            new Supplier(2, 'Supplier B')
        );
        return $suppliers;
    }

    public function getTransactions() {
        $transactions = array(
            new Transaction(1, 1, 2, 200),
            new Transaction(2, 2, 1, 150)
        );
        return $transactions;
    }
}
?>
