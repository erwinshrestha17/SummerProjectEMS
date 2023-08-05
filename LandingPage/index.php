<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Factory Landing Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #f5f5f5;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            width: 100px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
        }

        section {
            padding: 50px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #555;
        }

        .testimonial {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .testimonial img {
            width: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<header>
    <img src="logo.png" alt="Factory Logo">
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
</header>

<section id="home">
    <img src="hero-image.jpg" alt="Factory Image">
    <h1>Welcome to [Factory Name]</h1>
    <h2>Your Trusted Source for Quality Food Products</h2>
    <a href="#products" class="cta-button">Explore Our Products</a>
</section>

<section id="about">
    <img src="factory-image.jpg" alt="Factory Image">
    <h2>About Us</h2>
    <p>Introduce your factory, its history, and mission. Highlight your expertise in the food industry, quality standards, and commitment to delivering the best products.</p>
</section>

<section id="products">
    <img src="products-image.jpg" alt="Products Image">
    <h2>Our Products</h2>
    <p>Showcase your range of food products and their unique features. Mention the high-quality ingredients, production processes, and any certifications or awards you have received.</p>
    <a href="#catalog" class="cta-button">View Our Full Product Catalog</a>
</section>

<section id="quality-assurance">
    <img src="quality-image.jpg" alt="Quality Image">
    <h2>Quality Assurance</h2>
    <p>Highlight your factory's commitment to quality and food safety. Talk about your quality control processes, certifications (such as ISO, HACCP), and adherence to industry standards.</p>
</section>

<section id="contact">
    <img src="contact-image.jpg" alt="Contact Image">
    <h2>Contact Us</h2>
    <form action="submit.php" method="POST">
        <input type="text" name="name" placeholder="Your Name">
        <input type="email" name="email" placeholder="Your Email">
        <input type="tel" name="phone" placeholder="Your Phone Number">
        <textarea name="message" placeholder="Your Message"></textarea>
        <button type="submit">Send Message</button>
    </form>
</section>

<footer>
    <p>&copy; 2023 Your Food Factory. All rights reserved.</p>
</footer>
</body>
</html>
