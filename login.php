<?php 
$showalert=false;
$showerror=false;





if($_SERVER["REQUEST_METHOD"]=="POST"){
  require 'important/dbconnect.php';
  $uname=$_POST["uname"];


  $upass=$_POST["upass"];
  //$cpass=$_POST["cpass"];

  $exists=false;
  
  $sql="Select * from data where uname='$uname'";
  $result=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result);
  if($num==1){
    while($row=mysqli_fetch_assoc($result)){
      if(password_verify($cpass,$row['upass'])){
        $login=true;
        $showalert=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['uname']=$uname;
        header("location: welcome.php");
    
    
      }
      else{
        $showerror="invalid credentials";
      }
    }



  }
  else{
    $showerror="invalid credentials";
  }





}





?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  <?php require 'important/nav.php'?>
<?php
if($showalert){
  echo'
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success..!</strong> You have successfully logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
if($showerror){
  echo'
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>warning..!</strong>' .$showerror.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
?>



    <div class="container my-4">
        <h1 class="text-center">PLEASE LOG-IN</h1>
       
       <form action="/login/login.php" method="post">
       <div class="mb-3">
            <label for="uname" class="form-label">Name</label>
            <input type="text" class="form-control" id="uname" name="uname">
           
        </div>
        <div class="mb-3">
            <label for="upass" class="form-label">Password</label>
            <input type="password" class="form-control" id="upass" name="upass">
        </div>
       
        <button type="submit" class="btn btn-primary">LOG IN</button>
        </form> 


    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html> 