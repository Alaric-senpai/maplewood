<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maplewood institute</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include "navbar.php";
    ?>
    <div class="hero" id="hero">
        <h1>Maplewood institute</h1>
        <h2>Empowering Minds, Nurturing Futures</h2>
    </div>
    <div class="about" id="about">
        <div class="intro">
            <h1>About us</h1>
            <p>At Maplewood Academy, 
we are committed to providing a nurturing and innovative
 learning environment for our students. Our dedicated 
faculty and staff strive to foster a culture of academic 
excellence, personal growth, and community involvement.
 We believe in empowering our students to become critical
 thinkers, compassionate leaders, and responsible global
 citizens. With a focus on holistic development, we aim
 to inspire a lifelong love for learning and instill values
 that will guide our students to success in both their academic
 and personal endeavors.
</p>
        </div>
        <div class="profile">
            <img src="./assets/about.jpg" alt="">
        </div>
    </div>
    <div class="contact" id="contact">
        <h1>reach out</h1>
        <p>reach us through the following platforms</p>
        <div class="icons">
            <img src="./telegram.png" alt="" class="icon">
            <img src="./twitter.png" alt="" class="icon">
            <img src="./twitter.png" alt="" class="icon">
            <img src="./facebook (1).png" alt="" class="icon">
        </div>
    </div>
    <div class="footer" id="footer">
        <h1>Alaric creations</h1>
        <p>copyright @<?php echo date('Y'); ?> All rights reserved</p>
    </div>
    <script src="./script.js"></script>
</body>
</html>