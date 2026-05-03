<?php
require 'config.php';

$msg = "";

if (isset($_POST['add_btn'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $reg_no = $_POST['registration_no'];
    $dept = $_POST['department'];

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $reg_no = mysqli_real_escape_string($conn, $reg_no);
    $dept = mysqli_real_escape_string($conn, $dept);

    $sql = "INSERT INTO students (name, email, registration_no, department)
            VALUES ('$name', '$email', '$reg_no', '$dept')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $msg = "student added successfully!";
    } else {
        $msg = "error adding student";
    }
}

if (isset($_POST['update_btn'])) {

    $id = (int) $_POST['student_id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['department'];

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $dept = mysqli_real_escape_string($conn, $dept);

    $sql = "UPDATE students SET name='$name', email='$email', department='$dept' WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $msg = "student updated successfully!";
    } else {
        $msg = "error updating";
    }
}

// DELETE 
if (isset($_GET['delete_id'])) {
    $did = (int) $_GET['delete_id'];
    $sql = "DELETE FROM students WHERE id=$did";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $msg = "deleted successfully!";
    } else {
        $msg = "error deleting";
    }
}

// EDIT
$row_edit = null;
if (isset($_GET['edit_id'])) {

    $eid = (int) $_GET['edit_id'];
    $sql = "SELECT * FROM students WHERE id=$eid";
    $qr = mysqli_query($conn, $sql);
    $row_edit = mysqli_fetch_assoc($qr);
}


$sql_list = "SELECT * FROM students";
$result_list = mysqli_query($conn, $sql_list);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
</head>
<body>

<h1>Student Management System</h1>

<?php
if ($msg != "") {
    echo "<p>" . $msg . "</p>";
}
?>

<h2>Add New Student</h2>
<form action="" method="post">
    Name:<br>
    <input type="text" name="name" required><br><br>

    Email:<br>
    <input type="text" name="email" required><br><br>

    Registration Number:<br>
    <input type="text" name="registration_no" required><br><br>

    Department:<br>
    <input type="text" name="department" required><br><br>

    <input type="submit" name="add_btn" value="Add Student">
</form>


<?php
if ($row_edit != null) {
?>

<hr>
<h2>Edit Student</h2>
<form action="" method="post">
    <input type="hidden" name="student_id" value="<?php echo $row_edit['id']; ?>">

    Name:<br>
    <input type="text" name="name" value="<?php echo $row_edit['name']; ?>" required><br><br>

    Email:<br>
    <input type="text" name="email" value="<?php echo $row_edit['email']; ?>" required><br><br>

    Registration Number (cant change): <?php echo $row_edit['registration_no']; ?>
    <br><br>

    Department:<br>
    <input type="text" name="department" value="<?php echo $row_edit['department']; ?>" required><br><br>

    <input type="submit" name="update_btn" value="Update">
</form>

<?php
}
?>


<hr>
<h2>List of Students</h2>

<table border="1">
    <tr>
        <td><b>Name</b></td>
        <td><b>Email</b></td>
        <td><b>Registration No</b></td>
        <td><b>Department</b></td>
        <td><b>Actions</b></td>
    </tr>

    <?php
    while ($r = mysqli_fetch_assoc($result_list)) {
        echo "<tr>";
        echo "<td>" . $r['name'] . "</td>";
        echo "<td>" . $r['email'] . "</td>";
        echo "<td>" . $r['registration_no'] . "</td>";
        echo "<td>" . $r['department'] . "</td>";

        echo "<td>";
        echo "<a href='index.php?edit_id=" . $r['id'] . "'>Edit</a>";
        echo " | ";
        echo "<a href='index.php?delete_id=" . $r['id'] . "' onclick='return confirm(\"are you sure?\")'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }
    ?>
</table>

</body>
</html>



