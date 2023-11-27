<div class="row m-0">
    <div class="col-md-12 mt-3">
        <?php if (isset($_SESSION["status"]) &&  $_SESSION['status'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_SESSION['status']);
            unset($_SESSION['message']);
        } else if (isset($_SESSION["status"]) &&  $_SESSION['status'] == 'error') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_SESSION['status']);
            unset($_SESSION['message']);
        } ?>

        <?php if (isset($_COOKIE["status"]) &&  $_COOKIE['status'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_COOKIE["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_COOKIE['status']);
            unset($_COOKIE['message']);
        } else if (isset($_COOKIE["status"]) &&  $_COOKIE['status'] == 'error') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_COOKIE["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_COOKIE['status']);
            unset($_COOKIE['message']);
        } ?>

    </div>
</div>