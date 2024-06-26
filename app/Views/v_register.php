<main class="container">
    <?php
    $session = session();
    if (empty($session->active) || $session->active == false):
    ?>
    
        <div id="form-container" class="col-6 p-3 m-auto border rounded">
            <form class="form-signin" data-bitwarden-watching="1" action="register/check" method="POST">
                <h1>Sign-up</h1>
                <?php
                echo $error != 0 ? '<div class="bg-outline-warning rounded-3 p-3 bs-text-primary-danger border border-danger-subtle container my-3"><i class="bi-alarm"></i><h5>' : "";
                switch ($error) {
                    case 1:
                        echo 'Username Vuoto';
                        break;
                    case 2:
                        echo 'Password Vuota';
                        break;
                    case 3:
                        echo 'Username già presente';
                        break;
                    default:
                        break;
                }
                echo $error != 0 ? '</h5></div>' : "";
                ?>
                <label for="inputUsername" class="sr-only">Username</label>
                <input type="text" id="inputUsername" class="form-control my-2" placeholder="Username" name="username"
                    aria-describedby="emailHelp" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control my-2" placeholder="Password" name="password"
                    required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign-up <i class="bi bi-key"></i></button>
            </form>
        </div>

    <?php else: ?>
        <h1>sei già loggato!</h1>
    <?php endif ?>
</main>