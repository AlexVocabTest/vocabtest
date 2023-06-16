<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <title>Test</title>
</head>

<?php
    include 'connect.php';
    $connection = OpenCon();

    if(isset($_GET['unit'])) 
        $unit = $_GET['unit'];
    else
        $unit = "";    

    if(isset($_GET['idtest'])) 
        $test = $_GET['idtest'];
    else
        $test = "";    
?>

<body>

    <div>
        <a href="testtosend.php"><button class=GeneratedButton>Send</button></a>
        <a href="results.php"><button class=GeneratedButton>Results</button></a>
        <a href="test.php"><button class=GeneratedButton>Test</button></a>
        <a href="student.php"><button class=GeneratedButton>Student</button></a>
    </div>

    <h1>TEST</h1>    


    <div>
        <form class="form" action="" method="POST">
            Unit: 
            <select class=GeneratedSelect id="selectunit" onchange=reload()>
                <option value=""></option>
                <option <?php if ($unit == "Unit 1") echo "selected";?> >Unit 1</option>
                <option <?php if ($unit == "Unit 2") echo "selected";?> >Unit 2</option>
                <option <?php if ($unit == "Unit 3") echo "selected";?> >Unit 3</option>
                <option <?php if ($unit == "Unit 4") echo "selected";?> >Unit 4</option>
                <option <?php if ($unit == "Unit 5") echo "selected";?> >Unit 5</option>
                <option <?php if ($unit == "Unit 6") echo "selected";?> >Unit 6</option>
                <option <?php if ($unit == "Unit 7") echo "selected";?> >Unit 7</option>
                <option <?php if ($unit == "Unit 8") echo "selected";?> >Unit 8</option>
                <option <?php if ($unit == "Unit 9") echo "selected";?> >Unit 9</option>
            </select><br><br>

            Test: 
            <select class=GeneratedSelect id="selecttest" onchange=reload()>
                <option value=""></option>

                <?php
                    $query = "SELECT idtest FROM test WHERE test.unit = '".$unit."' ORDER BY idtest ASC";
                    if ($data = $connection->query($query)) {
                        $idtest = $_GET['idtest'];
                        while ($row = $data->fetch_assoc()) {
                            if ($row['idtest']==$idtest)
                                echo "<option value='$row[idtest]' selected>$row[idtest]</option>";
                            else
                                echo "<option value='$row[idtest]'>$row[idtest]</option>";
                        }
                    } else {
                        echo $connection->error;
                    }
                ?>
            </select><br>
        </form>
    </div>

    <br>

    <div>
        <form class="form" action="" method="POST">
            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $query2 = "SELECT DISTINCT * FROM test WHERE idtest = '".$idtest."' AND unit = '".$unit."'";
                        if ($data2 = $connection->query($query2)) {
                            while ($row = $data2->fetch_assoc()) { 
                                $i = 1;   
                                while ($i <= 2) { 
                                    $question = "question".$i;
                                    $answer = "answer".$i;
                                    echo "<tr>";
                                    echo "<td>".$row[$question]."</td>";
                                    echo "<td>".$row[$answer]."</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                        } else {
                            echo $connection->error;
                        }
                    ?>
                </tbody>
            </table>

            <br>
            <button class=GeneratedButton type="submit" name="deleteTest" onclick="reload()">Delete Test</button></a>
        </form>
    </div>

    <br>

    <div>
        <form class="form" action="" method="POST">
            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $i = 1;   
                        while ($i <= 2) { 
                            $question = "question".$i;
                            $answer = "answer".$i;
                            echo "<tr>";
                            echo "<td><input class=GeneratedInput type='text' name=".$question." style='width:98%;'></td>";
                            echo "<td><input class=GeneratedInput type='text' name=".$answer." style='width:98%;'></td>";
                            echo "</tr>";
                            $i++;
                        }
                    ?>
                </tbody>
            </table>

            <br>
            <button class=GeneratedButton type="submit" name="addTest" onclick="reload()">Add Test</button></a>
        </form>
    </div>




    <?php
        if(isset($_POST['addTest'])){
            if($unit<>"") {
                $question1 = $_POST['question1'];
                $answer1 = $_POST['answer1'];
                $question2 = $_POST['question2'];   
                $answer2 = $_POST['answer2'];
                                
                $query =   "INSERT INTO test(unit, question1, answer1, question2, answer2)
                                VALUES('$unit', '$question1', '$answer1', '$question2', '$answer2')";
                    
                if ($connection->query($query) === true) {
                    echo "<br>";
                    echo "<div>";
                    echo "<form class='form'>";
                    echo "ADDED";   
                    echo "</form>";
                    echo "</div>";
                }
                else 
                    die ("Error while adding: " . $connection->error);
            }
            else {
                echo "<br>";
                echo "<div>";
                echo "<form class='form'>";
                echo "SELECT A UNIT BEFORE ADDING";   
                echo "</form>";
                echo "</div>";
            }
        } 

        if(isset($_POST['deleteTest'])){
            $query = "DELETE FROM test WHERE idtest=".$idtest;
            echo "<meta http-equiv='refresh' content='0'>";

            if ($connection->query($query) === true) {}
            else
                die ("Error while deleting: " . $connection->error);
        }

        CloseCon($connection); 
    ?>



    <script>
        function reload() {
            var v1=document.getElementById('selectunit').value;
            var v2=document.getElementById('selecttest').value;
            self.location='test.php?unit=' + v1 + '&idtest=' + v2; 
        }
    </script>


</body>
</html>