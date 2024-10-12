<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SO YUMMI</title>
  <!-- Bootstrap CSS -->
  <link href="<?php echo base_url(); ?>/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background-color: #625b70;
      background-image: url('<?php echo base_url(); ?>/dist/images/background.jpg'); /* Add your background image path */
      background-size: cover; /* Ensures the image covers the entire container */
      background-repeat: no-repeat; /* Prevents the image from repeating */
      background-position: center; /* Centers the image */
    }.login-container {
      max-width: 400px;
      margin: auto;
      margin-top: 150px;
      padding: 30px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }

    .login-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #333;
      text-align: center;
    }
    .form-control {
      border: 1px solid #ced4da;
      border-radius: 5px;
    }
    .form-control:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }
    .login-button {
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
      width: 100%;
    }
    .login-button:hover {
      background-color: #0056b3;
    }
    .login-footer {
      margin-top: 20px;
      text-align: center;
    }
    .login-footer a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }
    .login-footer a:hover {
      text-decoration: underline;
    }
    .logincenter {
      text-align: center;
      color: green;
    }
    .logo {
      display: block;
      margin: 0 auto 20px;
      max-width: 100px;
    }
    .icon-color {
      color: #007bff; /* Replace with your desired color */
    }
  </style>
</head>

<body>

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="login-container">
        <img src="<?php echo base_url(); ?>/dist/images/logo.jpg" alt="Logo" class="logo">
        <h4 class="logincenter">Soo Yummeh Baby Food</h4>
        <hr>
        <form class="form-horizontal mt-3 form-material" id="loginform" method="POST" action='<?php echo base_url(); ?>logincon/auth_login' enctype='multipart/form-data'>
          <div class="mb-3 input-group">
            <span class="input-group-text icon-color"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" name="username" placeholder="User" autocomplete="off" required>
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text icon-color"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
          </div>
          <button type="submit" class="btn btn-primary login-button">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- JS -->
<script src="<?php echo base_url(); ?>/dist/js/bootstrap.min.js"></script>
</body>
</html>

