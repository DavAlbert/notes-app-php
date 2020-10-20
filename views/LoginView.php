<?php require 'partials/HeaderPartial.php'; ?>
<?php require 'partials/NavigationPartial.php'; ?>

<body>
    <div class="container">
        <?php /** @var array $errors */ foreach ($errors as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
    <?php } ?>
    <form method="post">
        <h2 class="text-center">Login</h2>
        <?= /** @var string $csrfInputField */ $csrfInputField ?>
        <div class="form-group">
            <label for="email">Username:</label>
            <input class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>
<?php require 'partials/ScriptsPartial.php'; ?>
</body>
