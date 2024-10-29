<?php
session_start();


$products = [
    [
        'id' => 1,
        'description' => 'Ultralight Portable Backpacking Large Hammock',
        'price' => 49.00,
        'image' => '2images/p2.1.jpg',
        'link' => 'p1.html?id=1'
    ],

    [
        'id' => 2,
        'description' => 'Outdoor Camping Multifunctional Mosquito Net Hammock',
        'price' => 80.00,
        'image' => '2images/p5.1.jpg',
        'link' => 'p2.html?id=2' 
    ],

    [
        'id' => 3,
        'description' => 'Lightweight Portable Pillow and Wearable Sleeping Bag',
        'price' => 90.00,
        'image' => '2images/p18.1.jpg',
        'link' => 'p3.html?id=3' 
    ],

    [
        'id' => 4,
        'description' => 'Luxury Family Outdoor Camping Waterproof Tent',
        'price' => 510.00,
        'image' => '2images/p15.1.jpg',
        'link' => 'p4.html?id=3' 
    ],

    [
        'id' => 5,
        'description' => 'Ultralight Portable Waterproof Tent with Bed',
        'price' => 120.00,
        'image' => '2images/p9.1.jpg',
        'link' => 'p5.html?id=3'
    ],

    [
        'id' => 6,
        'description' => 'Outdoor Emergency Coldproof Camping Tent',
        'price' => 350.00,
        'image' => '2images/p3.1.jpg',
        'link' => 'p6.html?id=3' 
    ],

    [
        'id' => 7,
        'description' => 'Portable Foldable Lightweight Camping Chair',
        'price' => 349.00,
        'image' => '2images/p17.1.jpg',
        'link' => 'p7.html?id=3' 
    ],

    [
        'id' => 8,
        'description' => 'Heavy Duty Waterproof Camping Hammock',
        'price' => 109.00,
        'image' => '2images/p7.1.jpg',
        'link' => 'p8.html?id=3' 
    ],

    [
        'id' => 9,
        'description' => 'Windproof Waterproof Lightweight Camping Tent',
        'price' => 350.00,
        'image' => '2images/p13.1.jpg',
        'link' => 'p9.html?id=3' 
    ],

    [
        'id' => 10,
        'description' => 'Outdoor Camping Blanket Waterproof Beach Picnic Mat',
        'price' => 220.00,
        'image' => '2images/p19.1.jpg',
        'link' => 'p10.html?id=3' 
    ],

    [
        'id' => 11,
        'description' => 'Outdoor Courtyard Wedding Party Event Canopy Tent',
        'price' => 59.00,
        'image' => '2images/p4.1.jpg',
        'link' => 'p11.html?id=3' 
    ],

    [
        'id' => 12,
        'description' => 'Ultralight Portable Folding Nylon Custom Hammock',
        'price' => 79.00,
        'image' => '2images/p6.1.jpg',
        'link' => 'p12.html?id=3' 
    ],


];

// Initialize the shopping cart if it doesn't exist
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = [];
}

// Handle adding products to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity']; // Ensure quantity is an integer

    // Check if the product is already in the cart
    $itemExists = false;
    foreach ($_SESSION['shopping_cart'] as &$item) {
        if ($item['product_id'] == $productId) {
            $item['product_quantity'] += $quantity; // Update quantity
            $itemExists = true;
            break;
        }
    }

    // If the product doesn't exist, add it
    if (!$itemExists) {
        $itemArray = [
            'product_id' => $productId,
            'product_name' => $_POST['hidden_name'],
            'product_price' => $_POST['hidden_price'],
            'product_quantity' => $quantity,
        ];
        $_SESSION['shopping_cart'][] = $itemArray;
    }

    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle removing products from the cart
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    foreach ($_SESSION['shopping_cart'] as $key => $item) {
        if ($item['product_id'] == $_GET['id']) {
            unset($_SESSION['shopping_cart'][$key]);
            break;
        }
    }

    // Redirect to the same page after removing an item
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Your CSS styles remain the same */
        body {
            background-color: #f5f5f5; /* Light background color */
            font-family: Arial, sans-serif; /* Clean font */
            padding: 20px; /* Padding around the body */
        }
       
        h2, h3 {
            color: #333; /* Darker color for headers */
            text-align: center; /* Centered headers */
            margin-bottom: 20px; /* Space below headings */
        }

        .product {
            border: 1px solid #eaeaea; /* Light border color */
            margin: 10px; /* Spacing between products */
            padding: 15px; /* Padding inside the product box */
            text-align: center; /* Centered text */
            background-color: #f9f9f9; /* Light gray background */
            border-radius: 8px; /* Rounded corners */
            transition: transform 0.2s; /* Smooth hover effect */
        }
        

        .product:hover {
            transform: scale(1.05); /* Scale effect on hover */
        }

        .product img {
            border-radius: 8px; /* Rounded corners for images */
            max-width: 100%; /* Responsive image size */
            height: auto; /* Maintain aspect ratio */
        }

        .table {
            margin-top: 20px; /* Space above table */
        }

        .table th {
            background-color: #343a40; /* Dark header background */
            color: #ffffff; /* White text for headers */
        }

        .table td {
            background-color: #ffffff; /* White background for table cells */
        }

        .table td:hover {
            background-color: #f1f1f1; /* Slightly darker on hover */
        }

        .btn-success {
            background-color: #28a745; /* Green button background */
            border: none; /* No border */
            border-radius: 4px; /* Rounded corners */
            color: white; /* White text */
        }

        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .product {
                margin: 5px; /* Less margin on small screens */
                padding: 10px; /* Less padding */
            }

            .container {
                width: 100%; /* Full width on small screens */
                padding: 15px; /* Less padding */
            }
        }

 /* Style for the Buy Now button */
.btn-buy-now {
    background-color: #FF0000; /* Blue color */
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    margin-top: 15px; /* Space above the button */
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect for Buy Now button */
.btn-buy-now:hover {
    background-color: #008000; /* Darker blue on hover */
}

/* Container for aligning the button */
.btn-container {
    display: flex;
    justify-content: flex-end; /* Aligns to the right for desktop */
}

/* Media query for mobile devices */
@media (max-width: 768px) {
    .btn-container {
        justify-content: center; /* Center the button for mobile */
    }
}



    </style>
</head>
<body>
<header>
        <div class="scroll-navbar">
            <div class="navbar">
                <div class="logo">
                    <a href="homepage.html">
                        <img src="https://i.ibb.co/yXPGPbh/d1c27e8c477d6a4027efc4779abdc68c-1-removebg-preview-removebg-preview.png" alt="Traveller Logo">
                    </a>
            </div>
            <button class="scroll-mobile-menu-toggle" aria-label="Toggle Navigation">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="scroll-nav-links">
                <li><a href="homepage.html">Home</a></li>
                <li><a href="Checkout.html">Checkout</a></li>
               
              
            </ul>
        </div>
    </header>
    <br><br> 
    <div class="container">
        <h2>Products</h2>
        <br><br>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 col-sm-6">
                    <form method="post" action="">
                        <div class="product">
                            <a href="<?php echo $product['link']; ?>"> <!-- Link for the product -->
                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['description']; ?>">
                            </a>
                            <h5 class="text-info"><?php echo $product['description']; ?></h5>
                            <h5 class="text-danger">$<?php echo number_format($product['price'], 2); ?></h5>
                            <input type="number" name="quantity" class="form-control" value="1" min="1">
                            <input type="hidden" name="hidden_name" value="<?php echo $product['description']; ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $product['price']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"><br>
                            <input type="submit" name="add" class="btn btn-success" value="Add to cart">
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div><br><br><br>

        <h3>Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Product Description</th>
                    <th>Quantity</th>
                    <th>Price Details</th>
                    <th>Total Price</th>
                    <th>Remove Item</th>
                </tr>
                <?php if (!empty($_SESSION['shopping_cart'])): ?>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['shopping_cart'] as $value):
                        $productName = $value['product_name'] ?? '';
                        $productQuantity = $value['product_quantity'] ?? 0;
                        $productPrice = $value['product_price'] ?? 0.00;
                        $totalPrice = $productQuantity * $productPrice;
                        $total += $totalPrice;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($productName); ?></td>
                        <td><?php echo htmlspecialchars($productQuantity); ?></td>
                        <td>$<?php echo number_format($productPrice, 2); ?></td>
                        <td>$<?php echo number_format($totalPrice, 2); ?></td>
                        <td><a href="?action=delete&id=<?php echo $value['product_id']; ?>" class="text-danger">Remove Item</a></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right">$<?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No items in cart</td>
                    </tr>
                <?php endif; ?>
            </table>
            
        </div>
        <div class="btn-container">
    <a href="Checkout.html" class="btn btn-primary btn-buy-now">Buy Now</a> 
</div>
    </div><br><br>
    
</div>

<footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="homepage.html">
                        <img src="https://i.ibb.co/yXPGPbh/d1c27e8c477d6a4027efc4779abdc68c-1-removebg-preview-removebg-preview.png" alt="Traveller Logo">
                    </a>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
    
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="aboutus.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="news.html">FAQs</a></li>
                    <li><a href="signup.html">Sign Up</a></li>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
    
            <div class="footer-contact">
                <h3>Contact Information</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Adventure Street, Colombo, Sri Lanka</li>
                    <li><i class="fas fa-phone-alt"></i> +94 123 456 789</li>
                    <li><i class="fas fa-envelope"></i> support@traveller.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Traveller. All rights reserved.</p>
        </div>
    </footer>
</body>
<script>
    // JavaScript to toggle the scroll-navbar menu
const scrollMobileMenuToggle = document.querySelector('.scroll-mobile-menu-toggle');
const scrollNavLinks = document.querySelector('.scroll-nav-links');

scrollMobileMenuToggle.addEventListener('click', () => {
    scrollNavLinks.classList.toggle('open');
});

   </script>
</html>
