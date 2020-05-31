<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    return;
}

require_once "link.php";
$stmt = $link->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $_SESSION['user']['email']);
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
</head>
<body>
<?php include_once('header_with_theme.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6" id="user_info">
            <div class="col-md-6 img">
                <img id="photo" src="<?php echo $row['img'] ?>" width="247" height="329"  alt="" class="img-rounded">
            </div>
            <div class="col-md-6 details">
                <blockquote>
                    <h5 id="fullname"><?php echo $row['name'] . ' ' . $row['surname'] ?></h5>
                    <small><cite title="Source Title" id="address"><i class="icon-map-marker"></i> <?php echo $row['address'] ?></cite></small>
                </blockquote>
                <div id="email"><span><?php echo $row['email'] ?></span></div><br>
                <div id="url"><span><a href=" <?php echo $row['url'] ?>">My page in <b>VK</b></a></span></div> <br>
                <div id="birthday"><span><?php echo $row['birthday'] ?></span></div>
            </div>
            <a href="signout.php" class="btn btn-primary">Sign Out</a>
        </div>
    </div>
</div>

</body>
</html>
