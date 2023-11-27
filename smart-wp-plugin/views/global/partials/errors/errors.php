<?php if(isset($_SESSION["sb-erros"])) { $v_errors=$_SESSION['sb-erros'] ?>
    <div class="row sb-errors-row m-0">
        <div class="col-md-12 bg-white sb-erros-col-md-12">
            <ul class="sb-error-list text-danger">
            <?php foreach($v_errors->firstOfAll() as $error) { ?>
                <li class="sb-erros-list-item text-danger"><?=$error?></li>
            <?php } ?>
            </ul>
        </div>
    </div>

<?php unset($_SESSION['sb-erros']); }?>
<?php if(isset($_COOKIE["sb-erros"])) { echo $_COOKIE['sb-erros'];
     $v_errors=json_decode($_COOKIE['sb-erros'])?>
    <div class="row sb-errors-row m-0">
        <div class="col-md-12 bg-white sb-erros-col-md-12">
            <ul class="sb-error-list text-danger">
            <?php foreach($v_errors as $error) { ?>
                <li class="sb-erros-list-item text-danger"><?=$error?></li>
            <?php } ?>
            </ul>
        </div>
    </div>

<?php unset($_COOKIE['sb-erros']); }?>