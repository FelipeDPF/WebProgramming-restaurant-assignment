<?php include("header.php");
include("db_config.php");
?>

<div id="content" class="clearfix">
    <div class="main">
        <center>
            <h2><b><ins>Mailing List</ins></b></h2><br>
            <?php
            $connect = mysqli_connect ( $servername, $username, $password );
            if (! $connect)
            die ( "Could not connect: " . mysqli_error () );
            mysqli_select_db ( $connect, $dbname );
            $query = "SELECT * FROM mailingList;";
            $result = mysqli_query ( $connect, $query );
            $rows = mysqli_num_rows ($result);

            echo "<table align='center' width='100%' border='2'>";
            echo "<tr>";
            echo "<th>Full Name</th>";
            echo "<th>Email Address</th>";
            echo "<th>Email Hash</th>";
            echo "<th>Phone</th>";
            echo "</tr>";
            for($i = 0; $i < $rows; ++ $i) {
                $row = mysqli_fetch_row ( $result );
                echo "<tr>";
                echo "<td>" . $row [1] . " " .$row[2] . "</td>";
                echo "<td>" . $row [4] . "</td>";
                echo "<td>" . $row [5] . "</td>";
                echo "<td>" . $row [3] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($connect);
            ?>
        </center>
    </div>
</div>

<?php include("footer.php"); ?>
