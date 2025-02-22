<?php

// Include configuration
require_once 'config.php';

// Start session
session_start();

$user_id = $_SESSION['user_id'] ?? null;

// Redirect to login if the user is not logged in
if (!$user_id) {
    header('location:login.php');
    exit;
}

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(strip_tags($data));
}

// // Handle add to wishlist
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
//     $product_id = sanitize_input($_POST['product_id']);
//     $product_name = sanitize_input($_POST['product_name']);
//     $product_price = sanitize_input($_POST['product_price']);
//     $product_image = sanitize_input($_POST['product_image']);

//     // Prepare query to check if product exists in wishlist or cart
//     $stmt = $conn->prepare(
//         "SELECT * FROM `wishlist` WHERE name = ? AND user_id = ? UNION SELECT * FROM `cart` WHERE name = ? AND user_id = ?"
//     );
//     $stmt->bind_param('sisi', $product_name, $user_id, $product_name, $user_id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $message[] = 'Product already exists in wishlist or cart';
//     } else {
//         // Insert into wishlist
//         $insert_stmt = $conn->prepare(
//             "INSERT INTO `wishlist` (user_id, pid, name, price, image) VALUES (?, ?, ?, ?, ?)"
//         );
//         $insert_stmt->bind_param('iisss', $user_id, $product_id, $product_name, $product_price, $product_image);
//         $insert_stmt->execute();
//         $message[] = 'Product added to wishlist';
//     }
// }

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = sanitize_input($_POST['product_id']);
    $product_name = sanitize_input($_POST['product_name']);
    $product_price = sanitize_input($_POST['product_price']);
    $product_image = sanitize_input($_POST['product_image']);
    $product_quantity = intval($_POST['product_quantity']);

    // Prepare query to check if product exists in cart
    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $stmt->bind_param('si', $product_name, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message[] = 'Product already exists in cart';
    } else {
        // // Remove from wishlist if it exists
        // $delete_stmt = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
        // $delete_stmt->bind_param('si', $product_name, $user_id);
        // $delete_stmt->execute();

        // Insert into cart
        $insert_stmt = $conn->prepare(
            "INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $insert_stmt->bind_param('iissis', $user_id, $product_id, $product_name, $product_price, $product_quantity, $product_image);
        $insert_stmt->execute();
        $message[] = 'Product added to cart';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require 'header.php'; ?>

<section class="home">
    <div class="content">
        <h3>New Collections</h3>
        <!-- <p>Welcome to Bagaicha</p> -->
        <a href="about.php" class="btn">Discover More</a>
    </div>
</section>

<section class="products">
    <h1 class="title">Latest Products</h1>
    <div class="box-container">
        <?php
        // Fetch products with pagination
        $limit = 6;
        $result = $conn->query("SELECT * FROM `products` LIMIT $limit");

        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
        ?>
        <form action="" method="POST" class="box">
            <a href="view_page.php?pid=<?= $product['id']; ?>" class="fas fa-eye"></a>
            <div class="price">रु <?= $product['price']; ?>/-</div>
            <img src="uploaded_img/<?= $product['image']; ?>" alt="Product Image" class="image" loading="lazy">
            <div class="name"><?= $product['name']; ?></div>
            <input type="number" name="product_quantity" value="1" min="1" class="qty">
            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
            <input type="hidden" name="product_image" value="<?= $product['image']; ?>">
            <!-- <input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn"> -->
            <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
        </form>
        <?php
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
    <div class="more-btn">
        <a href="shop.php" class="option-btn">Load More</a>
    </div>
</section>

<section class="home-contact">
    <div class="content">
        <h3>Have any questions?</h3>
        <!-- <p>Thank you for visiting our website.</p> -->
        <a href="contact.php" class="btn">Contact Us</a>
    </div>
</section>

<?php require 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
