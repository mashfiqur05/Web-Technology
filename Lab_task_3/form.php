<?php
$errors = [];
$success = false;

$fullName = "";
$email = "";
$username = "";
$age = "";
$gender = "";
$course = "";

if (isset($_POST['register'])) {
    $fullName = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $age = trim($_POST['age']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $course = $_POST['course'];
    $terms = isset($_POST['terms']);

    if (empty($fullName) || empty($email) || empty($username) || empty($password) || empty($confirmPassword) || empty($age) || empty($gender) || empty($course)) {
        $errors[] = "All fields are required.";
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $fullName)) {
        $errors[] = "Full Name must contain only letters and spaces.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (strlen($username) < 5) {
        $errors[] = "Username must be at least 5 characters long.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Password and Confirm Password do not match.";
    }

    if ($age < 18) {
        $errors[] = "Age must be 18 or above.";
    }

    if (empty($gender)) {
        $errors[] = "Please select a gender.";
    }

    if ($course == "") {
        $errors[] = "Please select a course.";
    }

    if (!$terms) {
        $errors[] = "You must agree to the Terms & Conditions.";
    }

    if (count($errors) == 0) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 450px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px gray;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .radio-group,
        .checkbox-group {
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Registration Form</h2>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        }
    }
    ?>

    <?php if ($success) { ?>
        <div class="success">Registration Successful!</div>
        <h3>Submitted Details:</h3>
        <p><strong>Full Name:</strong> <?php echo $fullName; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Gender:</strong> <?php echo $gender; ?></p>
        <p><strong>Course:</strong> <?php echo $course; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label>Full Name</label>
        <input type="text" name="fullname" value="<?php echo $fullName; ?>">

        <label>Email Address</label>
        <input type="email" name="email" value="<?php echo $email; ?>">

        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">

        <label>Password</label>
        <input type="password" name="password">

        <label>Confirm Password</label>
        <input type="password" name="confirm_password">

        <label>Age</label>
        <input type="number" name="age" value="<?php echo $age; ?>">

        <label>Gender</label>
        <div class="radio-group">
            <input type="radio" name="gender" value="Male"> Male
            <input type="radio" name="gender" value="Female"> Female
        </div>

        <label>Course Selection</label>
        <select name="course">
            <option value="">Select Course</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Software Engineering">Software Engineering</option>
            <option value="Data Science">Data Science</option>
            <option value="Cyber Security">Cyber Security</option>
        </select>

        <div class="checkbox-group">
            <input type="checkbox" name="terms"> I agree to Terms & Conditions
        </div>

        <button type="submit" name="register">Register</button>
    </form>
</div>

</body>
</html>