    <?php

/**
  * Function to query information based on
  * a parameter: in this case, branch.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM users
    WHERE branch = :branch";

    $branch = $_POST['branch'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':branch', $branch, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>#</th>
  <th>Name</th>
  <th>Rollno</th>
  <th>Address</th>
  <th>Branch</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["name"]); ?></td>
<td><?php echo escape($row["rollno"]); ?></td>
<td><?php echo escape($row["address"]); ?></td>
<td><?php echo escape($row["branch"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['branch']); ?>.
  <?php }
} ?>
<h1>Student Database<h1>
<h2>Find user based on branch</h2>

<form method="post">
  <label for="branch">Branch</label>
  <input type="text" id="branch" name="branch">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>