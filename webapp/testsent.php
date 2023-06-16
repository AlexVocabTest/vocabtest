<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">    

    <title>Test sent</title>
</head>

<?php

    session_start();
    include 'connect.php';
    $connection = OpenCon();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';

    if(isset($_SESSION['unit']))
        $unit = $_SESSION['unit'];
    else {
        echo "NO TEST WAS SENT";
        exit;
    }
    
    if(isset($_SESSION['idtest']))
        $idtest = $_SESSION['idtest'];
    else {
        echo "NO TEST WAS SENT";
        exit;
    }

    if(isset($_SESSION['class']))
        $class = $_SESSION['class'];
    else {
        echo "NO TEST WAS SENT";
        exit;
    }

?>

<body>
    <div>
        <a href="testtosend.php"><button class=GeneratedButton>Send</button></a>
        <a href="results.php"><button class=GeneratedButton>Results</button></a>
        <a href="test.php"><button class=GeneratedButton>Test</button></a>
        <a href="student.php"><button class=GeneratedButton>Student</button></a>
    </div>

    <h1>TEST SENT</h1> 

    <div>
        <form class="form">
            <?php
            echo "Test has been sent to class: ".$class;
            echo "<br><br>Students: <br>";         

            $timestamp = time();
            // Sent email to all students in class
            $query = "SELECT DISTINCT * FROM student WHERE class = '".$class."'";
            if ($data = $connection->query($query)) {    
                while ($row = $data->fetch_assoc()) { 
                        
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                    try {                

                        //Server settings
                        //$mail->SMTPDebug = 2;                                   //Enable verbose debug output
                        $mail->SMTPDebug = false;
                        $mail->isSMTP();                                        //Send using SMTP
                        $mail->Host       = 'XXX';                              //Set the SMTP server to send through   
                        $mail->SMTPAuth   = true;                               //Enable SMTP authentication
                        $mail->Username   = 'XXX';                              //SMTP username
                        $mail->Password   = 'XXX';                              //SMTP password
                        $mail->SMTPSecure = 'XXX';                              //Enable implicit TLS encryption
                        $mail->Port       = 0;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('email@email.com', 'Vocab test');

                        // Access to student email
                        $mail->AddBCC($row['studentemail']);  

                        $idstudent = $row['idstudent'];
                        $id = uniqid();
                        $link = 'http://localhost/vocabtest/webapp/testanswer.php?id=' . $id . '&idtest=' . $idtest . '&idstudent=' . $idstudent . '&timestamp=' . $timestamp;
                        $message = '<a href="'.$link.'">CLICK HERE</a>';
                        
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Vocab test';
                        $mail->Body    = $message;
                        
                        $mail->send();
                        echo $row['studentemail']."<br>";
                    } catch (Exception $e) {
                        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }


            } else {
                echo $connection->error;
            } 

            echo "<br>DATE: ".gmdate("d-m-Y", $timestamp);
            echo "<br>TIME: ".gmdate("H:i:s", $timestamp);

            ?>
        </form>
    </div>

    <br>

    <div>
        <form class="form">
            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th><?php echo $unit.'. Test number: '.$idtest; ?></th>
                    </tr>
                </thead>
            </table>

            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                    $query2="SELECT DISTINCT * FROM test WHERE idtest = '".$idtest."' AND unit = '".$unit."'";
                    if ($data = $connection->query($query2)) {   
                        while ($row = $data->fetch_assoc()) {  

                            echo "<tr>";
                            echo "<td>".$row["question1"]."</td>";
                            echo "<td>".$row["answer1"]."</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td>".$row["question2"]."</td>";
                            echo "<td>".$row["answer2"]."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo $connection->error;
                    }
                ?>
                </tbody>
            </table>
        </form>
    </div>

    <?php
        CloseCon($connection); 
        session_destroy();
    ?>

</body>
</html>