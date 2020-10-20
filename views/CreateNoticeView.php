<?php require 'partials/HeaderPartial.php'; ?>
<?php require 'partials/NavigationPartial.php'; ?>

<body>
<div class="container">
    <?php /** @var array $errors */
    foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php } ?>
    <?php /** @var boolean $success */ if ($success) { ?>
        <div class="alert alert-success" role="alert">
            Successful created notice.
        </div>
    <?php } ?>
    <form method="post">
        <h2 class="text-center">Create Notice</h2>
        <?= /** @var string $csrfInputField */ $csrfInputField ?>
        <div class="form-group">
            <label for="text">Text:</label>
            <textarea rows="10" class="form-control" id="text" name="text"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Create</button>
    </form>
</div>
<?php require 'partials/ScriptsPartial.php'; ?>
</body>
