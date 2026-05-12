<?php
// API to fetch products from the database and return as JSON response
include 'db.php';
/* @var $pdo PDO */

header('Content-Type: application/json');

try {
    // TODO completed: Fetch all products and return as JSON
    $stmt     = $pdo->query("SELECT id, name, price FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cast price to float so JSON encodes it as a number, not a string
    foreach ($products as &$product) {
        $product['price'] = (float) $product['price'];
    }

    echo json_encode([
        'status' => 'success',
        'data'   => $products
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status'  => 'error',
        'message' => $e->getMessage()
    ]);
}
