<?php
// api.php

// Get user input
$message = $_POST['message'];

// Call generate_text.py and capture output
$output = shell_exec("python generate_text.py " . escapeshellarg($message));

// Return output
echo $output;
?>
