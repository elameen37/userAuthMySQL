<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country)
{
    //create a connection variable using the db function in config.php
    $conn = db();
    //check if user with this email already exist in the database

    //check if user with this email already exist in the database
    $query = "select * from Students where email='$email'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo ("Email found");
    } else {
        $sql = "INSERT INTO `Students` (`full_names`, `country`, `email`, `gender`, `password`) VALUES
    ('$fullnames', '$country', '$email', '$gender', '$password')";
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "User Successfully registered";
            header("Location: /userAuthMySQL/forms/register.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


//login users
function loginUser($email, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();


if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($conn,"select ID from users where  Email='$email' && Password='$password' ");
    $result = mysqli_query($conn, $query);
    if (mysqli_query($conn, $query) === TRUE){
      $_SESSION['id']=$result['id'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }

    // echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
}

}


function resetPassword($email, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
}

function getusers()
{
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo "<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            //show data
            echo "<tr style='height: 30px'>" .
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] .
                "</td> <td style='width: 150px'>" . $data['country'] .
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                "value=" . $data['id'] . ">" .
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>" .
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

function deleteaccount($id)
{
    $conn = db();
    //delete user with the given id from the database
    $del = "delete from Students where id=$id";
    mysqli_query($conn, $del);
    echo "deleted successfull";
    getusers();
}
