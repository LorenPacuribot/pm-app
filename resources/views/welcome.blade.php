<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
          /*  background: url('images/Background.png') no-repeat center center fixed;
            background-size: cover;
             background-image: linear-gradient(to left,#000000 , #00003f,#0066cc, #0066cc, #00003f,  #000000); */
            background-image: linear-gradient(to left,  #00003f,  #000000);
            color: white;

            /* Set the height of the body to fill the viewport */
            height: 100vh;
            /* Remove any default margin */
            margin: 0;
            /* Center content */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        /* Style for logo */
        .logo {
            width: 200px; /* Adjust width as needed */
            height: auto;
        }
      /* Style for login button */
      .login-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #FFA500;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            text-decoration: none; /* Remove default anchor underline */
            display: inline-block; /* Ensure it behaves like a block element */
        }
        /* Style for login button hover */
        .login-btn:hover {
            background-color: #0056b3; /* Darker shade of blue */
        }
    </style>
</head>
<body>
    <!-- Your logo here -->
    <img src="images/logo.png" alt="Logo" class="logo">

    <!-- Headings -->
    <h2>PROJECT MANAGEMENT</h2>
 <!--   <h2>Admin Panel</h2> -->

    <!-- Login button -->
    <a href="{{ url('/admin/login') }}" class="login-btn"> Admin Dashboard</a>
</body>
</html>
