<?php

require __DIR__ . "/lib/boot.php";

if (isset($_SESSION["tag"])) {
    redirect("/");
}

// stolen from this website https://www.thepolyglotdeveloper.com/2015/05/use-regex-to-test-password-strength-in-javascript/
$passwordcheck = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})^";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = sanitize_input($_POST["tag"]);

    if (true) { // Here we should check the username with a regex
        $password = sanitize_input($_POST["password"]);
        $password2 = sanitize_input($_POST["password2"]);

        if (preg_match($passwordcheck, $password) != 0) {
            if ($password == $password2) {
                // Everything is correct, add the user to the db

                $stmt = $database->prepare("SELECT tag, password FROM users WHERE tag = ?;");
                $stmt->bind_param("s", $tag);
                $stmt->execute();
            } else {
                $error = "Passwords do not match.";
            }
        } else {
            $error = "Password is not strong enough.";
        }
    } else {
        $error = "Username is invalid";
    }
}

?>

<html class="style--dev">

<head>
    <?php require __DIR__ . "/partials/head.php";?>
    <title>Zytixon - Sign up</title>
</head>

<body class="page--login">
    <div class="login-content">
        <img src="/assets/logos/logo-dev.png" alt="Zytixon logo" class="logo">
        <div class="login-box">
            <h1>Welcome to Zytixon!</h1>
            <?php
if (isset($error)) {
    echo "<div class='error'>$error</div>";
}
?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <label for="js-id-input">
                    <p>
                        <strong>Choose a Zytixon ID</strong><br>
                        <span class="text--muted">This is how others will find and see you, and what you'll use to log in.<br>
                        3-14 characters with no spaces.</span>
                    </p>
                </label>
                <input id="js-id-input" class="text-input" type="text" name="tag" placeholder="e.g. ecnivtwelve or VinceLinise">
                <label for="js-password-input">
                    <p>
                        <strong>Choose a strong password</strong>
                    </p>
                </label>
                <input id="js-password-input" class="text-input" type="password" name="password" placeholder="At least 8 characters with mixed case and symbols">
                <input id="js-password-input" class="text-input" type="password" name="password2" placeholder="Retype your password">
                <button class="btn btn--primary" type="submit">Let's start!</button>
            </form>
        </div>
    </div>
</body>

</html>