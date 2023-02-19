<?php

$dir = str_replace('View\student', '', __DIR__);
$urlImage = str_replace('\View\student', '', __DIR__);
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
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <?php
                if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                <?php
                    unset($_SESSION['success']);
                }
                ?>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 1;
                        foreach ($student as $row) : 
                            // chuyển chuỗi thành mảng
                        $row['image_urls']  = explode(",", $row['image_urls']);?>
                            <tr>
                                <td scope="row"><?php echo $id;
                                                $id++ ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><img width="100" height="40" src="<?php echo  "../Uploads/". $row['image_urls'][0]
                                                ?>" alt=""></td>
                                <td><?php echo $row['birthday'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td>
                                    <a href="student-edit/<?php echo $row['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a id="btnDelete" href="student-delete/<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
<?php require_once  $dir . "View/layout/footer.php"; ?>

</html>