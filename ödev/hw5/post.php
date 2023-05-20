<?php
    if(isset($_POST["name"]) && !empty($_POST["name"])){  
        $name = $_POST["name"];
        if(!preg_match("/^[a-z A-Z]*$/", $name)){
            $setName = false;
            echo "Name: Only letters and whitespace allowed.";
        }
        else{
            $setName = true;
            echo "Name: ".$_POST["name"]." ";
        }
    }

    if(isset($_POST["email"]) && !empty($_POST["email"])){
        $email = $_POST["email"];
        $setEmail = true;
        echo "Email: ".$_POST["email"]." ";
    }

    if(isset($_POST["gender"]) && !empty($_POST["gender"])){
        $gender = $_POST["gender"];
        $setGender = true;
        echo "Gender: ".$_POST["gender"]." <br>";
    }

    if(isset($_POST["submit"]) && $setName && $setEmail && $setGender){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "myDB";
        $tableName = "students";

        $conn = new mysqli($servername, $username, $password);
        if($conn->connect_error){
            die("Connection failed ". $conn->connect_error);
        }
        echo "Connected succesfully<br>";

        if(!mysqli_select_db($conn,$dbName)){
            $sql = "CREATE DATABASE ". $dbName;
            if(mysqli_query($conn,$sql)){
                echo "Database Created Succesfully <br>";
            }
            else{
                echo "Error Creating Database" . mysqli_error($conn);
            }
        }
        
        $sql2 = "CREATE TABLE IF NOT EXISTS STUDENTS(
                id INT(2) NOT NULL AUTO_INCREMENT ,
                FULLNAME VARCHAR(30) NOT NULL,
                EMAIL VARCHAR(30) NOT NULL,
                GENDER ENUM('MALE', 'FEMALE'),
                PRIMARY KEY(id))";
        if(mysqli_query($conn, $sql2)){
            echo "<br>";
        }
        else{
            echo "Error creating table ". mysqli_error($conn);
        }

        $sql3 = "INSERT INTO STUDENTS(fullname, email, gender)VALUES('$name', '$email', '$gender')";
        if(mysqli_query($conn, $sql3)){
            echo "Data Added Succesfully <br> <br>";
        }
        else{
            echo "Error adding data ". mysqli_error($conn);
        }

        $sql4 = "SELECT id, FULLNAME, EMAIL, GENDER FROM STUDENTS";
        $result = mysqli_query($conn,$sql4);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "id: ". $row["id"]. " - Name: ". $row["FULLNAME"] . " - E-Mail: ". $row["EMAIL"]. " - Gender: ". $row["GENDER"] . "<br>";
            }
        }
        else{
                echo "0 results";
        }  
        $conn -> close();  
    }
    else{
        echo "Student Add Failed. <br> <br>";
    }
?>

<a href="index.php">Add Student</a>;