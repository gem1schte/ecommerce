<?php
require_once 'conn.php';
require_once 'assets.php';
// Prepare statement
$sql = "INSERT INTO register (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error); // Debugging
}

// Bind parameters
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
// $password = $_POST['password']; //Storing the password in plain text is risky and insecure
$stmt->bind_param("sss", $username, $email, $password);

//Check username or email is already registered
$query = "SELECT 1 FROM register WHERE username = '$username' OR email = '$email'";
$check_result = $conn->query($query);
if ($check_result->num_rows > 0){
	echo '
	<script>
		setTimeout(function() {
			Swal.fire({
				icon: "warning",
				title: "Warning!",
				text: "This username or email has been registered!",
				showConfirmButton: false,
				timer: 1500
			}).then(() => {
				window.location = "register.html";
			});
		}, 100);
	</script>
	';
	exit();
	
}

// Execute the statement
if ($stmt->execute()) {

	echo '
	<script>
		setTimeout(function() {
			Swal.fire({
				icon: "success",
				title: "Nice to meet you!",
				text: "You have successfully registered!",
				showConfirmButton: false,
				timer: 1500
			}).then(() => {
				window.location = "login.html";
			});
		}, 100);
	</script>
	';
	
} 
else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
