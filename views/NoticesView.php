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
    <h1>Your notices (<?= /** @var INTEGER $notices */ sizeof($notices)?>)</h1>
    <?php /** @var STRING[] $notices */ foreach ($notices as $notice) { ?>
    <div class="card mt-2">
        <div class="card-body">
            <p style="text-align: center;"><?= htmlentities($notice['text']) ?></p>
        </div>
        <div class="card-footer">
            <form action="/notices/delete" method="POST">
                <?= /** @var STRING $csrfInputField */ $csrfInputField ?>
                <input type="hidden" name="id" value="<?= $notice['id'] ?>">
                <button type="submit" class="btn btn-danger float-right">Delete</button>
            </form>
        </div>
    </div>
    <?php } ?>
</div>

    <?php require 'partials/ScriptsPartial.php'; ?>
</body>