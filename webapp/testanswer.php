<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">    

    <title>Answers</title>
</head>

<?php
    include 'connect.php';
    $connection = OpenCon();
    //$timemax = time() + 60*10; // now + 10 minutes

    if(isset($_GET['id'])) 
        $id = $_GET['id'];
    else {

    }

    if(isset($_GET['idtest'])) 
        $idtest = $_GET['idtest'];
    else {

    }

    if(isset($_GET['idstudent'])) 
        $idstudent = $_GET['idstudent'];
    else {

    }

    if(isset($_GET['timestamp'])) {
        $starttime = $_GET['timestamp'];
        $finishtime = $starttime + 60*15; // finish = start + 15 minutes
    } else {

    }

    $points = 0;
?>


<body>
    <h1>ANSWERS</h1> 
    
    <div>
        <form class="form" method="POST">

            START TIME:  <?php echo gmdate("H:i:s", $starttime); ?><br>
            FINISH TIME: <?php echo gmdate("H:i:s", $finishtime); ?><br><br>

            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th style="width: 3%;text-align:center;">Q</th>
                    <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td style="width: 3%;text-align:center;">1</td>
                    <td><input class=GeneratedInput name="answer1" style='width:98%;'></td>
                    </tr>
                    <tr>
                    <td style="width: 3%;text-align:center;">2</td>
                    <td><input class=GeneratedInput name="answer2" style='width:98%;'></td>
                    </tr>
                </tbody>
            </table>

            <br>

            <button class=GeneratedButton type="submit">Send</button>
        </form>
    </div>
    <br>
    
    
        <?php
            if (!empty($_POST)) {
                if (time()>$finishtime) {
                    ?>
                        <div>
                            <table class="GeneratedTable">
                                <thead>
                                    <tr>
                                    <th><?php echo 'ATTENTION: TEST SENT OUT OF TIME. ANSWERS NOT REGISTERED<br>'; ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php
                    $answer1 = '';
                    $answer2 = '';
                } else {
                    $answer1 = $_POST['answer1'];
                    $answer2 = $_POST['answer2'];
                }

                // Execute SQL
                $query = "SELECT * FROM test WHERE test.idtest = '".$idtest."'";
                $data = $connection->query($query);
                    
                // Print rows
                $row = $data->fetch_assoc()
                ?>
                    <div>
                        <form class="form">
                            <table class="GeneratedTable">
                                <thead>
                                    <tr>
                                        <th>Questions</th>
                                        <th>Your answers</th>
                                        <th>Correct answers</th>
                                        <th>Correction</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><?php echo $row["question1"]; ?></td>
                                        <td><?php echo $answer1; ?></td>
                                        <td><?php echo $row["answer1"]; ?></td>
                                        <td><?php 
        
                                            if(strcasecmp($answer1, $row["answer1"]) == 0) {
                                                echo 'Correct';
                                                    $points++;
                                            } else
                                                echo 'Incorrect';                    
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $row["question2"]; ?></td>
                                        <td><?php echo $answer2; ?></td>
                                        <td><?php echo $row["answer2"]; ?></td>
                                        <td><?php

                                            if(strcasecmp($answer2, $row["answer2"]) == 0) {
                                                echo 'Correct'; 
                                                $points++;
                                            } else
                                                echo 'Incorrect';    
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <br>
                  
                   
                    <div>
                        <form class="form">
                            <table class="GeneratedTable">
                                <thead>
                                    <tr>
                                    <th>Points: <?php echo $points.' / 2';?></th>
                                    </tr>
                                </thead>
                            </table>
                        </form>
                    </div>
                   
                                        
                    <br>
                    <?php
                        $query = "INSERT INTO answer(idstudent, idtest, points, answer1, answer2)
                                    VALUES('$idstudent', '$idtest', '$points', '$answer1', '$answer2')";
                    
                        if($connection->query($query) === true) {}
                        else
                            die("Error al insertar datos: " . $connection->error);
        
                    ?>
                <?php
            } 
            
            CloseCon($connection); 
        ?>


</body>
</html>