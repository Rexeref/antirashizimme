<?php
$session = session();
if (empty($session->active) || $session->active == false):
    ?>

    <div id="form-container" class="text-center">
        <form class="form-signin" data-bitwarden-watching="1" action="login/check" method="POST">
            <img class="mb-4" src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" width="250" height="250">
            <h1>eCom</h1>
            <?php
            if ($error != 0) {
                echo $error != 0 ? '<div class="bg-warning rounded-3 p-3 bs-text-primary-danger border border-danger-subtle container"><i class="bi-alarm"></i><h5>' : "";
                switch ($error) {
                    case 1:
                        echo 'Username Vuoto';
                        break;
                    case 2:
                        echo 'Password Vuota';
                        break;
                    case 3:
                        echo 'Credenziali non corrette';
                        break;
                    case 4:
                        echo "L'account è stato registrato correttamente, ora fai il login";
                        break;
                    default:
                        break;
                }
                echo $error != 0 ? '</h5></div>' : "";
            }
            ?>
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required=""
                autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"
                required="">
            <!--<div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>-->
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login <i class="bi bi-door-open"></i></button>
        </form>
    </div>

<?php else: ?>
    <h1>sei già loggato!</h1>
<?php endif ?>