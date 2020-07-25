<?php

require __DIR__ . "/include/boot.php";

if (isset($_SESSION["id"])) {
    redirect("./");
}

// thanks to the ppl of the code() discord for help with this one :D
$tagcheck = "/^[a-zA-Z0-9]{3,14}$/";
// stolen from this website https://www.thepolyglotdeveloper.com/2015/05/use-regex-to-test-password-strength-in-javascript/
$passwordcheck = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})^/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = sanitize_input($_POST["tag"]);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    // We don't sanitize passwords, because :
    // - They are never shown on page.
    // - The special chars being parsed as HTML enitites would require to type these entities literally.
    // They also won't hurt the database (normally), since we are using prepared statements.

    if (preg_match($tagcheck, $tag)) {
        if ($password === $password2) {
            if (preg_match($passwordcheck, $password)) {
                $stmt = $database->prepare("SELECT tag FROM users WHERE tag = ?;");
                $stmt->bind_param("s", $tag);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 0) {
                    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $database->prepare("INSERT INTO users (tag, password, avatar_url) VALUES (?, ?, '/assets/images/avatar-default.png')");
                    $stmt->bind_param("ss", $tag, $passwordhash);
                    $stmt->execute();

                    redirect("/login.php?fromAccountCreated");
                    }
                else {
                    $error = "This ID is already taken. Use your creativity!";
                }
            }
            else {
                $error = "The password you chose is not strong enough.";
            }
        } else {
            $error = "The two passwords don't match.";
        }
    } else {
        $error = "Your ID is invalid, or empty.";
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
                <input id="js-id-input" class="text-input" type="text" name="tag" placeholder="e.g. ecnivtwelve or VinceLinise" required="">
                <label for="js-password-input">
                    <p>
                        <strong>Choose a strong password</strong>
                    </p>
                </label>
                <input id="js-password-input" class="text-input" type="password" name="password" placeholder="At least 8 characters with mixed case and symbols" required="">
                <input id="js-password-input" class="text-input" type="password" name="password2" placeholder="Retype your password" required="">
                <button class="btn btn--primary" type="submit">Let's start!</button>
                <a class="btn" href="/login.php">Log in</a>
            </form>
        </div>
    </div>
    <script src="/assets/js/login.js"></script>
</body>

</html>
