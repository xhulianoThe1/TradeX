<?php

/** CSI 418
Page for account creation and entry into user table, modified from my CS410 Library Database Project
  *
  * This script is used to create a new entry in the users table.
  * The first section of code builds the SQL statement necessary to insert new data.
  * The second section of code builds the user interface, allowing for a new user to be created.
  */


if (isset($_POST['submit'])) { 
    require "config.php";
    require "common.php";

    try {
      
        /* This try block connects to the database and builds the SQL statement.
         * It accesses the required information, and then inserts it into the user table using an
         * insert command.
        */

        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "first_name" => $_POST['first_name'],
            "last_name"  => $_POST['last_name'],
            "email"     => $_POST['email'],
            "password"   => $_POST['password'],
            "is_admin" => 0,
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "user",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } 
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
  }

}
?>


<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['first_name']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
    <label for="first_name">First Name</label>
	<input type="text" name="first_name" id="first_name">
	<label for="last_name">Last Name</label>
	<input type="text" name="last_name" id="last_name">
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<label for="password">Password</label>
	<input type="text" name="password" id="password">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="access.html">Back to home</a>

<?php require "templates/footer.php"; ?>
