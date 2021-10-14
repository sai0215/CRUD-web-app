
<?php


if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "name" => $_POST['name'],
      "rollno"  => $_POST['rollno'],
      "address" => $_POST['address'],
      "branch"  => $_POST['branch'],
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"users",
implode(", ", array_keys($new_user)),
":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['firstname']; ?> successfully added.
<?php } ?>

<h1>Student Database<h1>
<h2>Add a Student</h2>

    <form method="post">
    	<label for="name">Name</label>
    	<input type="text" name="name" id="name">
    	<label for="rollno">Roll Num</label>
    	<input type="text" name="rollno" id="rollno">
    	<label for="address">Address</label>
    	<input type="text" name="address" id="address">
    	<label for="branch">Branch</label>
    	<input type="text" name="branch" id="branch">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php include "templates/footer.php"; ?>
