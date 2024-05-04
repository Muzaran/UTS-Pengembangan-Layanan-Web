<?php
require_once 'app/Controller/Controller.php';

class View {
    public function showProducts() {
        $controller = new Controller();
        $products = $controller->getProducts();
        echo "<h1>Products</h1>";
        echo "<ul>";
        foreach ($products as $product) {
            echo "<li>{$product->name} - \${$product->price}</li>";
        }
        echo "</ul>";
    }

    public function showCategories() {
        $controller = new Controller();
        $categories = $controller->getCategories();
        echo "<h1>Categories</h1>";
        echo "<ul>";
        foreach ($categories as $category) {
            echo "<li>{$category->name}</li>";
        }
        echo "</ul>";
    }

    public function showSuppliers() {
        $controller = new Controller();
        $suppliers = $controller->getSuppliers();
        echo "<h1>Suppliers</h1>";
        echo "<ul>";
        foreach ($suppliers as $supplier) {
            echo "<li>{$supplier->name}</li>";
        }
        echo "</ul>";
    }

    public function showTransactions() {
        $controller = new Controller();
        $transactions = $controller->getTransactions();
        echo "<h1>Transactions</h1>";
        echo "<ul>";
        foreach ($transactions as $transaction) {
            echo "<li>Transaction ID: {$transaction->id}, Product ID: {$transaction->product_id}, Quantity: {$transaction->quantity}, Total Amount: \${$transaction->total_amount}</li>";
        }
        echo "</ul>";
    }
}
?>
