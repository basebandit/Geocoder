<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $human = intval($_POST['human']);
    $from = 'Demo Contact Form';
    $to = 'evansonmwangi83@gmail.com';
    $subject = 'Message from Contact Demo ';

    $body = "From: $name\n E-Mail: $email\n Message:\n $message";
    // Check if name has been entered
    if (!$_POST['name']) {
        $errName = 'Please enter your name';
    }

    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Please enter a valid email address';
    }

    //Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Please enter your message';
    }
    //Check if simple anti-bot test is correct
    if ($human !== 5) {
        $errHuman = 'Your anti-spam is incorrect';
    }
// If there are no errors, send the email
    if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        if (mail($to, $subject, $body, $from)) {
            $result = '<div class="alert alert-success">Thank You! I will be in touch</div>';
        } else {
            $result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Geocoder">
    <meta name="author" content="devmars">
    <title>Geocoder::Contact Me</title>

    <!-- Bootstrap CSS file -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="css/geocoder.css" rel="stylesheet">
</head>
<body>

<?php require_once 'inc/components/contact_header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" id="contact-head">
            <h1 class="page-header text-center">Contact Me</h1>
            <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">Name</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name"
                               value="<?php echo htmlspecialchars($_POST['name']); ?>">
                        <?php echo "<p class='text-danger'>$errName</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-2 control-label">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="example@domain.com"
                               value="<?php echo htmlspecialchars($_POST['email']); ?>">
                        <?php echo "<p class='text-danger'>$errEmail</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-md-2 control-label">Message</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="4"
                                  name="message"><?php echo htmlspecialchars($_POST['message']); ?></textarea>
                        <?php echo "<p class='text-danger'>$errMessage</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="human" class="col-md-2 control-label">2 + 3 = ?</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="human" name="human"
                               placeholder="Your Answer (Antibot test)">
                        <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <!--<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">-->
                        <button id="submit" name="submit" type="submit" class="btn btn-lg btn-primary">
                            Send <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-sm-offset-2">
                        <span class="text-center">
                        <?php echo $result; ?>
                            </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('inc/components/footer.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>