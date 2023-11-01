<?php

session_start([
    'cookie_lifetime' => 900,
]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>User Page</title>
</head>

<body>
    <?php include_once "../data/homeData.php"; ?>
</body>

</html>