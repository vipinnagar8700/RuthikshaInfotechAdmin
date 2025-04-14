<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ruthiksha Infotech</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: white;
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            font-family: 'Arial', sans-serif;
        }
        .gallery-images {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .gallery-images img {
            width: 32%;
            border-radius: 8px;
        }
        .project-links {
            margin-top: 30px;
            padding: 20px;
            background-color: #f3f3f3;
            border-radius: 8px;
        }
        .project-links h3 {
            margin-bottom: 15px;
        }
        .project-links a {
            color: #1e40af;
            text-decoration: none;
        }
        .contact-info {
            margin-top: 40px;
            padding: 20px;
            background-color: #f3f3f3;
            border-radius: 8px;
        }
        .contact-info p {
            margin: 10px 0;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="email-container">
    <h1>Welcome to Ruthiksha Infotech!</h1>
    <h2>Hello, {{ $name }} 👋</h2>
    <p>We are excited to have you onboard! Below is a glimpse of our work and services.</p>

    <div class="gallery-images">
        <img src="https://dipanshutech.com/wp-content/uploads/2024/12/Business-Hub-scaled.webp" alt="Gallery Image 1">
        <img src="https://dipanshutech.com/wp-content/uploads/2024/12/Business-Hub-scaled.webp" alt="Gallery Image 2">
        <img src="https://dipanshutech.com/wp-content/uploads/2024/12/Business-Hub-scaled.webp" alt="Gallery Image 3">
    </div>

    <div class="project-links">
        <h3>Check out our Projects:</h3>
        <ul>
            <li><a href="#" target="_blank">Project 1</a></li>
            <li><a href="#" target="_blank">Project 2</a></li>
            <li><a href="#" target="_blank">Project 3</a></li>
        </ul>
    </div>

    <div class="contact-info">
        <h3>Contact Information:</h3>
        <p><strong>Company Name:</strong> Ruthiksha Infotech</p>
        <p><strong>Phone:</strong> +1 234 567 890</p>
        <p><strong>Email:</strong> contact@ruthikshainfotech.com</p>
        <p><strong>Address:</strong> 123 Tech Lane, Silicon Valley, CA</p>
    </div>

    <p>We hope you find our work inspiring! Feel free to reach out to us for more information or if you'd like to work with us on your next project.</p>

    <p style="margin-top: 20px;">Best regards,<br><strong>The Ruthiksha Infotech Team</strong></p>
</div>

<div class="footer">
    <p>&copy; 2025 Ruthiksha Infotech. All rights reserved.</p>
</div>

</body>
</html>
