<?php
//session_start();
// error_reporting(0);
// include('..config.php');
require_once "../config.php";


//register users
function registerUser($fullnames, $email, $password, $gender, $country)
{
    //create a connection variable using the db function in config.php
    $conn = db();
    
    //check if user with this email already exist in the database
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $msg = "User aleady exist, please try again";
            echo "<script>
            alert('$msg');
            window.location.href='../forms/register.html';
            </script>";
            exit;
        } else {
            //if the email does not exist in the database store all the data in the database as a new user
            $query = "INSERT INTO students (full_names, country, email, gender, password) VALUES ('$fullnames', '$country', '$email', '$gender', '$password')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $msg = "Registration successful";
                echo "<script>
                alert('$msg');
                window.location.href='../forms/login.html';
                </script>";
                exit;
            } else {
                echo "failed. Try again";
            }
        }
    }
}



//login users
function loginUser($email, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();

    // echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    // open connection to the database and check if username exist in the database    
    // if it does, check if the password is the same with what is given
    $query = "SELECT * FROM students WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($conn, $query);

    // if true then set user session for the user and redirect to the dasbboard
    if ($result) {
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            
            session_start();
            $_SESSION['email'] = $email;

            $msg = "Login successful";
            echo "<script>
            alert('$msg');
            window.location.href='../dashboard.php';
            </script>";
            exit;
        } else {
            $msg = "Invalid details please try again";
            echo "<script>
            alert('$msg');
            window.location.href='../forms/login.html';
            </script>";
            exit;
        }
    }
}



function resetPassword($email, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();
    // echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
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
        echo "</table></table><a href='../dashboard.php'>Back</a></center></body></html>";
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
    {
        $msg = "Delete Successful";
        echo "<script>
        alert('$msg');
        window.location.href='../dashboard.php';
        </script>";
        exit;
    }
    
}
