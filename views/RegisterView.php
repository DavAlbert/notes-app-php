<?php require 'partials/HeaderPartial.php'; ?>
<?php require 'partials/NavigationPartial.php'; ?>
<body>
<div class="container">
    <? /** @var STRING[] $errors */
    foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <? } ?>
    <form method="post">
        <h2 class="text-center">Register</h2>
        <div class="form-group">
            <label for="username">Username:</label>
            <input class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
</div>
</body>
