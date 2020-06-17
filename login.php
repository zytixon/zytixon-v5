<?php

require __DIR__ . "/lib/boot.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = sanitize_input($_POST["tag"]);
    $password = sanitize_input($_POST["password"]);

    $stmt = $database->prepare("SELECT tag, password FROM users WHERE tag = ?;");
    $stmt->bind_param("s", $tag);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $actualpassword = $row["password"];
        if (password_verify($password, $actualpassword)) {
            $_SESSION["tag"] = $row["tag"];

            header("Location: /");
            exit();
        } else {
            echo "Mot de passe ou nom d'utilisateur incorrect.";
        }
    } else if (!$result) {
        die("<h1>An error occured.</h1>" . $database->error);
    } else {
        echo "Mot de passe ou nom d'utilisateur incorrect.";
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
            <p><strong>Welcome back!</strong></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <input class="text-input" type="text" name="tag" placeholder="Zytixon ID">
                <input class="text-input" type="password" name="password" placeholder="Password">
                <button class="btn btn--primary" type="submit">Log in</button>
            </form>
        </div>
    </div>
</body>

</html>