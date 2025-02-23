<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>about us</h3>
    <p> <a href="home.php">Home</a> / About </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.png" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>
At Bagaicha, we focus on bringing you fresh, beautiful flowers at great prices.
 Our flowers are carefully selected to make sure they’re always top quality and last longer. We make custom bouquets for any event, just the way 
 you prefer, and ensure your order is delivered on time. With friendly service and affordable options, we’re here to make your flower shopping easy and fun!
            </p>
            <!-- <a href="shop.php" class="btn">shop now</a> -->
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>what we provide?</h3>
            <p>
At Bagaicha, we provide a wide variety of fresh flowers for all occasions, including birthdays, weddings, anniversaries, and more.
 We offer custom bouquets designed to match your unique style and preferences. In addition to flowers, we also provide plants, vases, 
 and gift items to complement your arrangements. Our fast delivery service ensures that your flowers arrive fresh and on time, making every moment 
 special. Whatever your floral needs, we’re here to help!</p>
            <!-- <a href="contact.php" class="btn">contact us</a> -->
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>
We are Bagaicha, a flower shop based in Nepal, dedicated to bringing the beauty of fresh flowers to your doorstep. 
Whether it’s for a celebration or a thoughtful gesture, we specialize in creating stunning floral arrangements for all kinds of occasions. 
Our team at Bagaicha is passionate about providing high-quality flowers, customized to your preferences, and delivering them with care and promptness.
 We’re here to make every moment brighter with the perfect flowers for you and your loved ones.</p>
                      <a href="shop.php" class="btn">shop now</a>

        </div>

    </div>

</section>













<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>