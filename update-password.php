<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- ลิงก์ไปยัง Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
        *{
    font-family: "Prompt", sans-serif;
    margin: 0px;
    box-sizing:border-box ;
    padding: 0;
    text-decoration: none; 
    list-style-type: none;
}
    body {
      background-color: #0C0F14;
    }
    .container {
    color: white;
    width: 50%;
    margin: 0 auto;
    text-align: center;
    margin-top: 20rem;
    }

    



input[type="password"],
input[type="exampleInputPassword1"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: #E58E27;
    color: white;
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    display: inline-block;
    box-sizing: border-box;
    border-radius: 5px;
    border-radius: 6px;
}

#otpInput {
    display: none;
}
  </style>
</head>
<body>
  <?php
    $phone = $_GET["phone"];
  ?>
  <div class="container">
    <form action="update-password-sql.php?phone=<?php echo $phone; ?>" method="POST">
      <div class="form-group">
        <label for="exampleInputPassword1"><h5>New Password</h5></label>
        <!-- ใช้ Bootstrap class form-control -->
        <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1"><h5>Confirm Password</h5></label>
        <!-- ใช้ Bootstrap class form-control -->
        <input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password" placeholder="Confirm Password">
      </div>
      <!-- ใช้ Bootstrap class btn btn-primary -->
      <button type="submit" class="a">Submit</button>
    </form>
  </div>
</body>
</html>
