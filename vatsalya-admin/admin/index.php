<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
session_start();


if(isset($_SESSION['loggeduser'])){
?>
    <div class="container">
        <h1>You are logged in as <?php echo $_SESSION['loggeduser'];?></h1>

    </div>
    <?php
}
else{
	echo "Login first";
}
?>
</body>

</html>