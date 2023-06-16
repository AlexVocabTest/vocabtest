<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <title>Test to send</title>
</head>

<?php
    session_start();
    include 'connect.php';
    $connection = OpenCon();

    if(isset($_GET['unit'])) 
        $unit = $_GET['unit'];
    else
        $unit = "";    

    if(isset($_GET['idtest'])) 
        $idtest = $_GET['idtest'];
    else
        $idtest = "";    

    if(isset($_GET['class'])) 
        $class = $_GET['class'];
    else
        $class = "";    

?>

<body>
    <div>
        <a href="testtosend.php"><button class=GeneratedButton>Send</button></a>
        <a href="results.php"><button class=GeneratedButton>Results</button></a>
        <a href="test.php"><button class=GeneratedButton>Test</button></a>
        <a href="student.php"><button class=GeneratedButton>Student</button></a>
    </div>

    <h1>TEST TO SEND</h1> 

    <div>
        <form class="form">

            Choose a unit:
            <select class=GeneratedSelect id=selectunit onchange=reload()>
                <option selected value=''></option>

                <?php
                    $query="SELECT DISTINCT unit FROM test ORDER BY unit ASC";
                    if ($data = $connection->query($query)) {
                        $unit = $_GET['unit'];
                        while ($row = $data->fetch_assoc()) {
                            if ($row['unit']==$unit)
                                echo "<option value='$row[unit]' selected>$row[unit]</option>";
                            else
                                echo "<option value='$row[unit]'>$row[unit]</option>";
                        }
                    } else {
                        echo $connection->error;
                    }
                ?>
            </select><br><br>

            Choose a test:
            <select class=GeneratedSelect id=selecttest onchange=reload()>
                <option selected value=''></option>

                <?php
                    $query2 = "SELECT idtest FROM test WHERE test.unit = '".$unit."' ORDER BY idtest ASC";
                    echo $query2;
                    if ($data2 = $connection->query($query2)) {
                        $idtest = $_GET['idtest'];
                        while ($row = $data2->fetch_assoc()) {
                            if ($row['idtest']==$idtest)
                                echo "<option value='$row[idtest]' selected>$row[idtest]</option>";
                            else
                                echo "<option value='$row[idtest]'>$row[idtest]</option>";
                        }

                    } else {
                        echo $connection->error;
                    }
                ?>
            </select><br><br>

            Choose a class: 
            <select class=GeneratedSelect id="selectclass" onchange=reload()>
                <option value=""></option>
                <?php
                    $query = "SELECT DISTINCT class FROM student ORDER BY class ASC";
                    if ($data = $connection->query($query)) {
                        $class = $_GET['class'];
                        while ($row = $data->fetch_assoc()) {
                            if ($row['class']==$class)
                                echo "<option value='$row[class]' selected>$row[class]</option>";
                            else
                                echo "<option value='$row[class]'>$row[class]</option>";
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
        <form class="form" action="testsent.php" method=post>
            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                    $query="SELECT DISTINCT * FROM test WHERE idtest = '".$idtest."' AND unit = '".$unit."'";
                    if ($data = $connection->query($query)) {   
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
            
            <br>                        
            <button class=GeneratedButton type="submit">Send test</button>
        </form>
    </div>


    <?php
        $_SESSION['unit'] = $unit;
        $_SESSION['idtest'] = $idtest;
        $_SESSION['class'] = $class;

        CloseCon($connection); 
    ?>

    <script>
        function reload() {
            var v1=document.getElementById('selectunit').value;
            var v2=document.getElementById('selecttest').value;
            var v3=document.getElementById('selectclass').value;
            self.location='testtosend.php?unit=' + v1 + '&idtest=' + v2 + '&class=' + v3; 
        }
    </script>


</body>
</html>