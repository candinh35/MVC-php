<?php
$dir = str_replace('View\student', '', __DIR__);
?>
<!doctype html>
<html lang="en">

<head>

</head>
<?php
require_once $dir . "View/layout/header.php"
?>

<body>
<div class="container">
    <?php
    if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php
        unset($_SESSION['error']);
    }
    ?>
    <div class="row justify-content-center">

        <div class="col-lg-6 border rounded border-primary">

            <div class="text-center mt-4 text-primary">
                <h2>Create</h2>
            </div>
            <form action="student-store" method="post" class="p-5" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId"
                           value="">
                </div>
                <div class="form-group">
                    <label for="">Birthday</label>
                    <input type="date" name="birthday" id="" class="form-control" placeholder=""
                           aria-describedby="helpId" value="">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" id="" class="form-control" placeholder=""
                           aria-describedby="helpId" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="images[]" multiple>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>

                </div>
                <button class=" btn btn-primary">Create Student</button>
                <a href="student" class="btn btn-warning ml-4">Back</a>
            </form>
        </div>
    </div>
</div>

</body>
<?php require_once $dir . "View/layout/footer.php"; ?>

</html>