<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
 
    <title>Results</title>
</head>

<?php
    include 'connect.php';
    $connection = OpenCon();

    if(isset($_GET['class'])) 
        $class = $_GET['class'];
    else
        $class = "";    

    if(isset($_GET['fromdate'])) 
        $fromdate = $_GET['fromdate'];
    else
        $fromdate = "";    

    if(isset($_GET['todate'])) 
        $todate = $_GET['todate'];
    else
        $todate = "";    

?>

<body>

    <div>
        <a href="testtosend.php"><button class=GeneratedButton>Send</button></a>
        <a href="results.php"><button class=GeneratedButton>Results</button></a>
        <a href="test.php"><button class=GeneratedButton>Test</button></a>
        <a href="student.php"><button class=GeneratedButton>Student</button></a>
    </div>

    <h1>RESULTS</h1>

    <div>
        <form class="form" action="" method="POST">
            Class: 
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
            </select><br><br>

            From: 
            <input type=date name=fromdate id=fromdate value='<?php echo $fromdate; ?>' onChange='reload()' class=GeneratedInput>                 
            <br><br>
            To:
            <input type=date name=todate id=todate value='<?php echo $todate; ?>' onChange='reload()' class=GeneratedInput>
            <br>
        </form> 
    </div>
    
    <br>

    <div>
        <form class="form" action="" method="POST">
            <table class="GeneratedTable" id="table">
                <thead>
                    <tr>
                    <th>Student</th>
                    <th>Percentage</th>
                    </tr>
                </thead> 

                <tbody>
                    <?php
                        if($fromdate<>"") 
                            if($todate<>"") 
                                $query = "SELECT student.studentname, ROUND(AVG(answer.points),2) FROM answer, student WHERE answer.idstudent = student.idstudent AND DATE(answer.date) > '".$fromdate."' AND DATE(answer.date) < '".$todate."' AND student.class = '".$class."'  GROUP BY student.studentname;";
                            else
                                $query = "SELECT student.studentname, ROUND(AVG(answer.points),2) FROM answer, student WHERE answer.idstudent = student.idstudent AND DATE(answer.date) > '".$fromdate."' AND student.class = '".$class."'  GROUP BY student.studentname;";
                        else
                            if($todate<>"") 
                                $query = "SELECT student.studentname, ROUND(AVG(answer.points),2) FROM answer, student WHERE answer.idstudent = student.idstudent AND DATE(answer.date) < '".$todate."' AND student.class = '".$class."'  GROUP BY student.studentname;";
                            else
                            $query = "SELECT student.studentname, ROUND(AVG(answer.points),2) FROM answer, student WHERE answer.idstudent = student.idstudent AND student.class = '".$class."'  GROUP BY student.studentname;";

                        if ($data = $connection->query($query)) {    
                            while ($row = $data->fetch_assoc()) {          
                                $average = $row['ROUND(AVG(answer.points),2)'];
                                $percentage = ($average/2)*100;     
                    ?>
                    

                    <tr>
                    <td><?php echo $row['studentname']; ?></td>
                    <td><?php echo $percentage."%"; ?></td>
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
            <button onclick="tableToCSV()" class=GeneratedButton>Export</button>
        </form>
    </div>

    <script>
        function reload() {
            var v1=document.getElementById('selectclass').value;
            var v2=document.getElementById('fromdate').value;
            var v3=document.getElementById('todate').value;
            self.location='results.php?class=' + v1 + '&fromdate=' + v2 + '&todate=' + v3;; 
        }


        function tableToCSV() {
            // Variable to store the final csv data
            var csv_data = [];

            // Get each row data
            var rows = document.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                // Get each column data
                var cols = rows[i].querySelectorAll('td,th');
                // Stores each csv row data
                var csvrow = [];
                for (var j = 0; j < cols.length; j++) {

                    // Get the text data of each cell
                    // of a row and push it to csvrow
                    csvrow.push(cols[j].innerHTML);
                }
                // Combine each column value with comma
                csv_data.push(csvrow.join(","));
            }

            // Combine each row data with new line character
            csv_data = csv_data.join('\n');
            // Call this function to download csv file 
            downloadCSVFile(csv_data);
        }


        function downloadCSVFile(csv_data) {
            // Create CSV file object and feed
            // our csv_data into it
            CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });

            // Create to temporary link to initiate
            // download process
            var temp_link = document.createElement('a');

            // Download csv file
            temp_link.download = "vocabtest.csv";
            var url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;

            // This link should not be displayed
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);

            // Automatically click the link to
            // trigger download
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>


</body>
</html>