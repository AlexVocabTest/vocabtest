<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <title>Student</title>
</head>

<?php
    include 'connect.php';
    $connection = OpenCon();

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

    <h1>STUDENT</h1>

    <div>
        <form class="form" action="" method="POST">
            Class: 
            <select class=GeneratedSelect id="selectclass" name="selectclass" onchange=reload()>
                <option value=""></option>
                <option <?php if ($class == "10.1") echo "selected";?> >10.1</option>
                <option <?php if ($class == "10.4") echo "selected";?> >10.4</option>
                <option <?php if ($class == "11.2") echo "selected";?> >11.2</option>
                <option <?php if ($class == "11.3") echo "selected";?> >11.3</option>
            </select><br><br>

            Student name: <input class=GeneratedInput type="text" name="studentname"><br><br>
            Student email: <input class=GeneratedInput type="text" name="studentemail">@emanuel.org.uk<br><br>

            <button class=GeneratedButton type="submit" name="addStudent" onclick=reload()>Add student</button></a>

        </form>  
    </div>

    <br>

    <div>
        <form class="form" method="POST">
            <table class="GeneratedTable">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Delete</th>
                    </tr>
                </thead> 

                <tbody>
                    <?php

                        $query="SELECT DISTINCT * FROM student WHERE class = '".$class."' ORDER BY studentname ASC";
                        if ($data = $connection->query($query)) {   
                            while ($row = $data->fetch_assoc()) {          
                    ?>
                    

                                <tr>
                                <td><?php echo $row['studentname']; ?></td>
                                <td><?php echo $row['studentemail']; ?></td>
                                <td style="text-align: center" ><input type="checkbox" name="deleteStudentId[]" value="<?= $row['idstudent']; ?>"></td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo $connection->error;
                        }
                    ?>
                </tbody>
            </table>
             <br>
            <button class=GeneratedButton type="submit" name="deleteStudent" onclick="reload()">Delete Student</button></a>
        </form>
    </div>  

    <?php
        if(isset($_POST['addStudent'])) {
            if(isset($_POST['studentname']) && isset($_POST['studentemail']) && isset($_POST['selectclass'])) {

                $studentname = $_POST['studentname'];
                $studentemail = $_POST['studentemail'];
                $class = $_POST['selectclass'];
                                
                $query = "INSERT INTO student(studentname, studentemail, class) VALUES('$studentname', '$studentemail', '$class')";
                echo "<meta http-equiv='refresh' content='0'>";
                
                if ($connection->query($query) === true) {}
                else
                    die ("Error while inserting: " . $connection->error);
            }
        }

        if(isset($_POST['deleteStudent'])){
            if(isset($_POST['deleteStudentId'])){
                foreach($_POST['deleteStudentId'] as $deleteid){
                    $query = "DELETE FROM student WHERE idstudent=".$deleteid;
                    echo "<meta http-equiv='refresh' content='0'>";

                    if ($connection->query($query) === true) {}
                    else
                        die ("Error while deleting: " . $connection->error);
                }
            }
        }
        
        CloseCon($connection); 
    ?>

    <script>
        function reload() {
            var v1=document.getElementById('selectclass').value;
            self.location='student.php?class=' + v1; 
        }
    </script>

</body>
</html>