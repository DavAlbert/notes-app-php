<?php require 'partials/HeaderPartial.php'; ?>
<?php require 'partials/NavigationPartial.php'; ?>
<body>
<div class="container">
    <?php /** @var STRING[] $errors */
    foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php } ?>
    <?php /** @var BOOLEAN $successPassword */
    if ($successPassword) { ?>
        <div class="alert alert-success" role="alert">
            Your password has been changed!
        </div>
    <?php } ?>
    <h1>Welcome <?= /** @var STRING $loggedUser */ htmlentities($loggedUser) ?></h1>
    <form method="post" action="/change-password">
        <h2 class="text-center">Change your password</h2>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
            <?= /** @var STRING $csrfInputField */ $csrfInputField ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
    </form>
</div>
</body>
