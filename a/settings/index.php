<?php
error_reporting(0);
session_start();
include('../../resources/headers/header-no-fade.php');
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../a/settings">Settings</a>
                    </li>
                </ul>
                <a href="../../" class="btn btn-outline-primary">Home</a>
            </div>
        </div>
    </nav>

    <div class="space">
        <b>Name: </b><?php echo $_SESSION['name'] ?>
        <br>
        <br>
        <b>Email: </b><?php echo $_SESSION['email'] ?>
        <br>
        <br>
        <b>Phonix email: </b><?php echo $_SESSION['phonix-email'] ?>
        <br>
        <br>
        <b>Last login: </b><?php echo $_SESSION['last-login'] ?> MDT
        <br>
        <br>
        <b>Created on: </b><?php echo $_SESSION['account-created'] ?>
        <br>
        <br>
        <hr style="width: 20%;">
        <br>
        <h5>Change email</h5>
        <br>
        <form action="../../a/settings/functions/update-email.php" method="POST">
            <input type="text" class="form-control" name="newemail1" placeholder="New email" style="width: 15%;" required>
            <br>
            <input type="text" class="form-control" name="newemail2" placeholder="Confirm new email" style="width: 15%;" required>
            <br>
            <input type="submit" class="btn btn-outline-primary" value="Change">
        </form>
        <br>
        <br>
        <h5>Change name</h5>
        <br>
        <form action="../../a/settings/functions/update-name.php" method="POST">
            <input type="text" class="form-control" name="newname1" placeholder="New name" style="width: 15%;" required>
            <br>
            <input type="text" class="form-control" name="newname2" placeholder="Confirm new name" style="width: 15%;" required>
            <br>
            <input type="submit" class="btn btn-outline-primary" value="Change">
        </form>
        <br>
        <br>
        <h5>Change password</h5>
        <br>
        <form action="../../a/settings/functions/update-password.php" method="POST">
            <input type="text" class="form-control" name="newpass1" placeholder="New password" style="width: 15%;" required>
            <br>
            <input type="text" class="form-control" name="newpass2" placeholder="Confirm new password" style="width: 15%;" required>
            <br>
            <input type="submit" class="btn btn-outline-primary" value="Change">
        </form>
        <br>
        <hr style="width: 20%;">
        <h5>Delete</h5>
        <br>
        <form action="../../a/settings/functions/delete-email.php" method="POST">
            <input type="submit" class="btn btn-danger" value="Delete all email data">
        </form>
        <br>
        <form action="../../a/settings/functions/delete-phone.php" method="POST">
            <input type="submit" class="btn btn-danger" value="Delete all phone data">
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>