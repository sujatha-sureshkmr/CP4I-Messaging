<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$script_output = "Hello, GitHub Pages!";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shell Script Output</title>

<!--$script_output = shell_exec('ls /Users/sujathasureshkumar/Documents/GitHub/sujatha-sureshkmr.github.io/jms');-->
</head>
<body>
    <h1>Shell Script Output:</h1>
    <pre><?php echo $script_output; ?></pre>
</body>
</html>