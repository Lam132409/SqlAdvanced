<?php
include 'action.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD App</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php">Home </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
</nav>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <hr>
            <?php if (isset($_SESSION['response'])) { ?>
                <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <b><?= $_SESSION['response']; ?></b>
                </div>
            <?php } unset($_SESSION['response']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info">Thêm và sửa thông tin sản phẩm</h3>
            <form action="action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                    <input type="text" name="title" value="<?= $title; ?>" class="form-control" placeholder="Tên sản phẩm" required>
                </div>
                <div class="form-group">
                    <input type="text" name="sku" value="<?= $sku; ?>" class="form-control" placeholder="Mã sản phẩm" required>
                </div>
                <div class="form-group">
                    <input type="text" name="category" value="<?= $category; ?>" class="form-control" placeholder="Loại sản phẩm" required>
                </div>
<!--                <div class="form-group">-->
<!--                    <input type="text" name="color" value="--><?//= $color; ?><!--" class="form-control" placeholder="Màu sắc" required>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <input type="text" name="size" value="--><?//= $size; ?><!--" class="form-control" placeholder="Kích thước" required>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <input type="text" name="price" value="--><?//= $price; ?><!--" class="form-control" placeholder="Giá" required>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <input type="text" name="currency" value="--><?//= $currency; ?><!--" class="form-control" placeholder="Đơn vị tiền" required>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <textarea  name="description" value="--><?//= $description; ?><!--" class="form-control" placeholder="Mô tả" required></textarea>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <input type="text" name="status" value="--><?//= $status; ?><!--" class="form-control" placeholder="Trạng thái" required>-->
<!--                </div>-->

                <div class="form-group">
                    <input type="hidden" name="oldimage" value="<?= $image; ?>">
                    <input type="file" name="image" class="custom-file">
                    <img src="<?= $image; ?>" width="120" class="img-thumbnail">
                </div>

                <div class="form-group">
                    <?php if ($update == true) { ?>
                        <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
                    <?php } else { ?>
                        <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <?php
            $query = 'SELECT * FROM products';
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <h3 class="text-center text-info">Danh sách sản phẩm</h3>
            <table class="table table-hover" id="data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên SP</th>
                    <th>Mã SP</th>
                    <th>Loại SP</th>
<!--                    <th>Màu</th>-->
<!--                    <th>Kích thước</th>-->
<!--                    <th>Giá</th>-->
<!--                    <th>Đơn vị tiền</th>-->
<!--                    <th>Mô tả</th>-->
<!--                    <th>Trạng thái</th>-->
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><img src="<?= $row['image']; ?>" width="75"></td>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['sku']; ?></td>
                        <td><?= $row['category']; ?></td>
<!--                        <td>--><?//= $row['color']; ?><!--</td>-->
<!--                        <td>--><?//= $row['size']; ?><!--</td>-->
<!--                        <td>--><?//= $row['price']; ?><!--</td>-->
<!--                        <td>--><?//= $row['currency']; ?><!--</td>-->
<!--                        <td>--><?//= $row['description']; ?><!--</td>-->
<!--                        <td>--><?//= $row['status']; ?><!--</td>-->
                        <td>
                            <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-2">Details</a> |
                            <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want delete this record?');">Delete</a> |
                            <a href="index.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').DataTable({
            paging: true
        });
    });
</script>
</body>

</html>