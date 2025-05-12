<?php
session_start();
session_unset();
session_destroy();
include_once 'views/includes/assets.php';

echo '
	<script>
		setTimeout(function() {
			Swal.fire({
  				icon: "success",
				title: "Logout successful",
				timer: 1500
			}).then(() => {
			window.location = "login.html";			
			});
		}, 100);
	</script>
';
?>
