<?php include("header.php");
include("db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    if (!empty( $_POST ['customerfName'] ) && !empty( $_POST ['customerlName'] ) && !empty( $_POST ['phoneNumber'] ) && !empty( $_POST ['emailAddress'] ) && !empty( $_POST ['username'] ) && !empty( $_POST ['referral'] )) {
        $connect = mysqli_connect ( $servername, $username, $password );
        if (! $connect)
        die ( "Could not connect: " . mysqli_error () );
        mysqli_select_db ( $connect, $dbname );

        $customerfName = $_POST["customerfName"];
        $customerlName = $_POST["customerlName"];
        $phoneNumber = $_POST["phoneNumber"];
        $emailAddress = $_POST["emailAddress"];
        $username = $_POST["username"];
        $referral = $_POST["referral"];

        $check = mysqli_query($connect, "SELECT * FROM mailingList WHERE emailAddress = '$emailAddress'");
        $checkRow = mysqli_num_rows($check);

        if($checkRow > 0){
            die("Cannot add duplicate email".mysqli_error());
        }

        $hashMagic = hash('sha512', $_POST["emailAddress"]);

        $sql = "INSERT INTO mailingList (firstName, lastName, phoneNumber, emailAddress, emailHash, username, referrer) VALUES ('$customerfName', '$customerlName', '$phoneNumber', '$emailAddress','$hashMagic', '$username', '$referral')";
        echo "Successfully Added!";

        mysqli_query ( $connect, $sql);
        mysqli_close ( $connect );
    }
}
?>

<div id="content" class="clearfix">
    <aside>
        <h2>Mailing Address</h2>
        <h3>1385 Woodroffe Ave<br>
            Ottawa, ON K4C1A4</h3>
            <h2>Phone Number</h2>
            <h3>(613)727-4723</h3>
            <h2>Fax Number</h2>
            <h3>(613)555-1212</h3>
            <h2>Email Address</h2>
            <h3>info@wpeatery.com</h3>
        </aside>
        <div class="main">
            <h1>Sign up for our newsletter</h1>
            <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
            <form name="frmNewsletter" id="frmNewsletter" method="post">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="customerfName" id="customerfName" size='40' required></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="customerlName" id="customerlName" size='40' required></td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td><input type="text" name="phoneNumber" id="phoneNumber" size='40' required></td>
                    </tr>
                    <tr>
                        <td>Email Address:</td>
                        <td><input type="text" name="emailAddress" id="emailAddress" size='40' required>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" id="username" size='20' required>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>
                                    <select name="referral" size="1" required>
                                        <option>Select referer</option>
                                        <option value="newspaper">Newspaper</option>
                                        <option value="radio">Radio</option>
                                        <option value="tv">Television</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>
                </div><!-- End Main -->
            </div><!-- End Content -->

            <?php include("footer.php"); ?>
