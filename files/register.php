<?php
session_start();
$con=mysqli_connect('localhost','root','','Abhyuday');
// for registering data
if(isset($_POST['register']))
{

  $fname=$_POST['fname'];
  $dob=  $_POST['dob'];
  $state= $_POST['state'];
  $country=$_POST['country'];
  $gender=  $_POST['gender'];
  $disability= $_POST['disability'];
  $email=$_POST['email'];
  $mobno=  $_POST['mobno'];
  $user_name= $_POST['user_name'];
  $password=$_POST['password'];
  $pass=md5($password.$email);
  $query=$con->prepare("SELECT * FROM `user_info` WHERE `email`=?");
  $query->bind_param("s",$email);
  $query->execute();
  $run= $query->get_result();
  $row=$run->num_rows;
  	if($row==1)
    {
  	   echo '<script>alert("email already exists")</script>';

     }
    else {
      $query1=$con->prepare("INSERT INTO `user_info`(`fname`, `dob`, `state`,`country`, `gender`, `disability`, `email`, `mobno.`,`user_name``password`) VALUES (?, ? ,?)");
      $query1->bind_param("ssssssssss",$username, $email,$pass);
      $query1->execute();
      $run1= $query->get_result();
      echo '<script>alert("Registered Successfully")</script>';


    }
}

// for login`
if(isset($_POST['Login']))
{
  $email=  $_POST['email'];
	$password= $_POST['password'];
  $_SESSION['email']=$email;
  $pass=md5($password.$email);
  $query=$con->prepare("SELECT * FROM `record` WHERE `email` = ?");
  $query->bind_param("s",$email);
  $query->execute();
  $run= $query->get_result();
  $row=$run->num_rows;
	if($row==1){
    $res=$run->fetch_assoc();
    if($res['password']==$pass){
	     header('location:enquiry.php');
     }
     else{
      echo '<script>alert("you entered Wrong password")</script>';
     }
  }
  else {
    echo '<script>alert("you have not yet Registered")</script>';
  }
}
