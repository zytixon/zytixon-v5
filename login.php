<?php

require __DIR__ . "/lib/boot.php";

if (isset($_SESSION["tag"])) {
    redirect("/");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = sanitize_input($_POST["tag"]);
    $password = $_POST["password"]);

    $stmt = $database->prepare("SELECT tag, password FROM users WHERE tag = ?;");
    $stmt->bind_param("s", $tag);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $actualpassword = $row["password"];
        if (password_verify($password, $actualpassword)) {
            $_SESSION["tag"] = $row["tag"];

            redirect("/");
        } else {
            $error = "Username or password is incorrect.";
        }
    } else if (!$result) {
        die("<h1>An error occured.</h1>" . $database->error);
    } else {
        $error = "Username or password is incorrect.";
    }
}
?>

<html class="style--dev">

<head>
    <?php require __DIR__ . "/partials/head.php"; ?>
    <title>Zytixon - Log in</title>
</head>

<body class="page--login">
    <div class="login-content">
        <img src="/assets/logos/logo-dev.png" alt="Zytixon logo" class="logo">
        <div class="login-box">
            <h1>Log in</h1>
            <?php
            if (isset($error)) {
                echo "<div class='error'>$error</div>";
            }
            if (isset($_GET["fromAccountCreated"])) {
                echo "<p><strong>You are signed up! Log in below &darr;</strong></p>";
            }
            else {
                echo "<p><strong>Welcome back!</strong></p>";
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <input class="text-input" type="text" name="tag" placeholder="Zytixon ID" required="">
                <input class="text-input" type="password" name="password" placeholder="Password" required="">
                <button class="btn btn--primary" type="submit">Log in</button>
                <a class="btn" href="/register.php">Register</a>     
            </form>
        </div>
    </div>
    <script src="/assets/js/login.js"></script>
</body>

</html>