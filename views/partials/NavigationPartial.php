<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Notices</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <? /** @var STRING $loggedUser */
            if ($loggedUser) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/my">My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/notices/create">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/notices">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            <? } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            <? } ?>
        </ul>
    </div>
</nav>