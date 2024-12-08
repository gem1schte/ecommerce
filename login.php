<?php
require_once 'conn.php';
require_once 'assets.php';
// Execute the following logic only if a POST request is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure that the form fields exist
    if (isset($_POST['username_email']) && isset($_POST['password'])) {
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

        // Use a prepared statement to query the database
        $sql = "SELECT password FROM register WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ss", $username_email, $username_email);

            // Execute the query
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the user exists
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $row['password'])) {
                    echo "Login successful! Welcome, " . htmlspecialchars($username_email) . ".</p>";

                    //logout Account
                    echo '<form method="POST" action="logout.php">';
                    echo '<button type="submit">logout</button>';
                    echo '</form>';

                    //Delete Account
                    echo '<form method="POST" action="delete.php">';
                    echo '<input type="hidden" name="username" value="' . htmlspecialchars($username_email) . '">';
                    echo '<button type="submit">Delete Account</button>';
                    echo '</form>';


                    echo '<img src="image/programmer_meme.jpg" title="This meme describes a programmer’s daily struggle with errors...">';
                } else {
                    echo '
                    <script>
                        setTimeout(function() {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Incorrect password!",    
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location = "login.html";
                            });
                        }, 100);
                    </script>
                    ';

                }
            } else {
                echo '
                <script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "User not found!",
                            footer: "<a href=\"register.html\">Register a new account now?</a>"
                           
                        }).then(() => {
                            window.location = "login.html";
                        });
                    }, 100);
                </script>
                ';
                exit();
         
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Failed to prepare statement: " . $conn->error;
        }
    } else {
        echo "Please enter a username and password!";
    }
}

// Close the database connection
$conn->close();
?>