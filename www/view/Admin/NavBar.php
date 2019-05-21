<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
            <a class="nav-link" href="?action=Accueil">Home
                <span class="sr-only">(current)</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="?action=ShowAllUsers">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?action=Preferences">Paramètres</a>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><?= (ESession::GetUser() === false) ? "" : ESession::GetUser()->Nickname ?></a>
            </li>
            <li class="nav-item">
            <a href="?action=Logout"><button class="btn btn-light">Log out</button></a>
            </li>
        </ul>
        </div>
    </div>
</nav>