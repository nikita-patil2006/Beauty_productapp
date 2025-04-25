<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comely</title>
    <style>
        /* Your CSS styles here */
        h1{
            font-family: Arial, Helvetica, sans-serif;
        }
        h2{
            padding: 25px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .banner{
            display: flex;
            gap: 15px;
            width: 500px;
            margin-top: 80px;
        }
        #img{
            border-radius: 5ch;
            width: 1502px;
            height: 500px;
            margin: 8px;

        }
        hr{
            color: rgb(160, 157, 157);
        }

        .best-seller{
            display: flex;
            background-color: pink;
        }
        .seller{
            width: 300px;
            border-radius: 5ch;
            padding: 10px;
        }
        .latest-arrivals{
            display: flex;
        }
        .arrival{
            width: 300px;
            border-radius: 5ch;
            padding: 10px;
           }
        .categories{
            display: flex;
        }
        .category{
            width: 169px;
            border-radius: 5ch;
            padding: 10px;
        }
        .Gifting{
            display: flex;
        }
        .gift{
            width: 760px;
            border-radius: 2ch;
            padding: 10px;
        }

        h3,p{
            font-family: Arial, Helvetica, sans-serif;
            padding: 5px 75px;
        }
        p{

        }
        .add {
            text-align: center;
            padding: 20px;
           }

        #quote{
            color: deeppink;

        }
        .brands{

            display: flex;

        }
        .brand{
            border-radius: 2ch;
            padding: 4px;
           margin: 5px;
            height: 125px;
        }
        .Trends{
            display: flex;
        }
        .trend{
            width: 300px;
            border-radius: 3ch;
            padding: 5px;
        }
        .image-container {
            position: relative;
        width: 250px; /* adjust width as needed */
        display: inline-block;
        margin: 8px;
        border-radius: 10px;
        overflow: hidden;
         }

          .image-container img {
            width: 100%;
            height: auto;
            display: block;
          }
        .image-container {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .image-container:hover {
            transform: scale(1.2);
            z-index: 10;
        }

        .text-overlay {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: white;
            font-size: 25px;
            font-weight: 700;
            font-family: sans-serif;
            line-height: 1.2;
        }


        .video{
            width:1520px;

        }
        .services{
            display: flex;
        }
        .svg{
            padding: 5px;
            width: 60px;

        }
        .brands {
            overflow: hidden;
            width: 100%;
            position: relative;
          }

          .logo {
            display: flex;
            width: max-content;
            animation: scrollLoop 20s linear infinite;
          }

          .logo img {
            width: 200px; /* or whatever suits your design */
            margin-right: 20px;
            transition: transform 0.3s ease;
          }

          .logo img:hover {
            transform: scale(1.1); /* Makes image pop on hover */
          }

          /* Keyframes for loop animation */
          @keyframes scrollLoop {
            0% {
              transform: translateX(0);
            }
            100% {
              transform: translateX(-50%);
            }
        }
        .navbar{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;

            z-index: 1000;
            padding: 9px 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);}

            .features-section {
              display: flex;
          justify-content: space-evenly;
          align-items: center;
          background-color: #f8f8f8;
          padding: 40px 20px;
          flex-wrap: wrap;
            }

            .feature-box {
              display: flex;
              align-items: center;
              gap: 16px;
              max-width: 260px;
            }

            .icon {
              background-color: #e91e63;
              border-radius: 50%;
              padding: 10px;
              margin-right: 15px;
              width: 48px;
              height: 48px;
              display: flex;
              align-items: center;
              justify-content: center;
            }

            .icon img {
              width: 34px;
              height: 34px;
            }

            .text h4 {
              font-size: 14px;
              margin: 0;
              font-weight: 600;
              color: #222;
              font-family: Arial, Helvetica, sans-serif;
            }

            .text p {
              margin: 4px 0 0;
              font-size: 13px;
              color: #444;
            }

    </style>
</head>
<body>


    <section class="banner">
        <div><img id="img" src="assets/images/banner2.avif" alt=""></div>
    </section>

    <div style="text-align: center; padding: 20px;">
        <h2>Welcome to Comely</h2>
        <p>This is the homepage.</p>
        <p>
            <a href="product.php">View Products</a> |
            <a href="register.php">Register</a> |
            <a href="login.php">Login</a> |
            <a href="cart.php">Cart</a>
        </p>
    </div>

    <h2>Best Sellers</h2>
    <section class="best-seller">
        <div><img class="seller" src="assets/images/best1.avif" alt="">
            <h3>Up To 25% Off</h3>
            <p style="font-weight: 600; color: rgb(89, 84, 84);">Extra 5% Off on 899</p>
        </div>
        <div><img class="seller" src="assets/images/best2.avif" alt="">
            <h3>Up To 25% Off</h3>
            <p style="font-weight: 600; color: rgb(99, 97, 97);">Extra 5% Off on 899</p>
        </div>
        <div><img class="seller" src="assets/images/best3.avif" alt="">
            <h3>Up To 25% Off</h3>
            <p style="font-weight: 600; color: rgb(99, 97, 97);">Extra 5% Off on 899</p>
        </div>
        <div><img class="seller" src="assets/images/best4.avif" alt="">
            <h3>Up To 25% Off</h3>
            <p style="font-weight: 600; color: rgb(99, 97, 97);">Extra 5% Off on 899</p>
        </div>
        <div><img class="seller" src="assets/images/best5.avif" alt="">
            <h3>Up To 25% Off</h3>
            <p style="font-weight: 600; color: rgb(99, 97, 97);">Extra 5% Off on 899</p>
        </div>
    </section>

    <section class="add">
        <h2>Only at Comely</h2>
        <p id="quote">You define your beauty</p>
    </section>

    <div class="brands">
        <div class="logo">
            <div><img class="brand" src="assets/images/brand1.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand2.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand3.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand4.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand5.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand6.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand7.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand8.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand9.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand1.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand2.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand3.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand4.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand5.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand6.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand7.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand8.avif" alt=""></div>
            <div><img class="brand" src="assets/images/brand9.avif" alt="">
        </div>
    </div>

    <h2>Latest Arrivals</h2>
    <section class="latest-arrivals">
        <div><img class="arrival" src="assets/images/arr1.avif" alt="">
        </div>
        <div><img class="arrival" src="assets/images/arr2.avif" alt="">
        </div>
        <div><img class="arrival" src="assets/images/arr3.avif" alt="">
        </div>
        <div><img class="arrival" src="assets/images/arr4.avif" alt="">
        </div>
        <div><img class="arrival" src="assets/images/arr5.avif" alt="">
        </div>
    </section>

    <h2>Your Beauty Must-Haves</h2>
    <section class="categories">
        <div><img class="category" src="assets/images/cat1.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat2.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat3.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat4.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat5.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat6.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat7.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat8.avif" alt="">
        </div>
        <div><img class="category" src="assets/images/cat9.avif" alt="">
        </div>
    </section>
    <div class="text">
        <h2>Get Gifting</h2>
    </div>
    <section class="Gifting">
        <div><img class="gift" src="assets/images/gift1.avif" alt="">
        </div>
        <div><img class="gift" src="assets/images/gift2.avif" alt="">
        </div>
    </section>

    <section>
        <div>
            <img class="video" src="assets/images/banner3.webp" alt="">
        </div>
    </section>

    <h2>Get on the Trends</h2>
    <section class="Trends">
        <div class="image-container"><img class="trend" src="assets/images/trends1.avif" alt="">
            <div class="text-overlay">TRENDING SUNSCREEN</div>
        </div>
        <div class="image-container"><img class="trend" src="assets/images/trend6.avif" alt="">
            <div class="text-overlay">TRANSITIONAL</div>
        </div>
        <div class="image-container"><img class="trend" src="assets/images/trends2.avif" alt="">
            <div class="text-overlay">CATCHY EYESHADOW LOOK</div>
        </div>
        <div class="image-container"><img class="trend" src="assets/images/trends3.avif" alt="">
            <div class="text-overlay">FRENCH PHARMACY</div>
        </div>
        <div class="image-container"><img class="trend" src="assets/images/trends4.avif" alt="">
            <div class="text-overlay">THE NO-MAKEUP LOOK</div>
        </div>
        <div class="image-container"><img class="trend" src="assets/images/trends5.avif" alt="">
            <div class="text-overlay">ESSENTIAL BODYCARE</div>
        </div>
    </section>



    <script src="assets/js/script.js"></script>
</body>
</html>
