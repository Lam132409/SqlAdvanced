<?php
session_start();
include 'config.php';

$update=false;
$id="";
$title="";
$sku="";
$category="";
//$color="";
//$size="";
//$price="";
//$currency="";
//$description="";
//$status="";
$image="";



if(isset($_POST['add'])){
    $title=$_POST['title'];
    $sku=$_POST['sku'];
    $category=$_POST['category'];
//    $color=$_POST['color'];
//    $size=$_POST['size'];
//    $price=$_POST['price'];
//    $currency=$_POST['currency'];
//    $description=$_POST['description'];
//    $status=$_POST['status'];


    $image=$_FILES['image']['name'];
    $upload="uploads/".$image;

    $query="INSERT INTO products(title,sku,category,image)VALUES(?,?,?,?)";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ssss",$title,$sku,$category,$upload);
    $stmt->execute();
    move_uploaded_file($_FILES['image']['tmp_name'], $upload);

    header('location:index.php');
    $_SESSION['response']="Successfully!";
    $_SESSION['res_type']="success";
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];

    $sql="SELECT image FROM products WHERE id=?";
    $stmt2=$conn->prepare($sql);
    $stmt2->bind_param("i",$id);
    $stmt2->execute();
    $result2=$stmt2->get_result();
    $row=$result2->fetch_assoc();

    $imagepath=$row['image'];
    unlink($imagepath);

    $query="DELETE FROM products WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();

    header('location:index.php');
    $_SESSION['response']="Successfully Deleted!";
    $_SESSION['res_type']="danger";
}
if(isset($_GET['edit'])){
    $id=$_GET['edit'];

    $query="SELECT * FROM products WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $row=$result->fetch_assoc();

    $id=$row['id'];
    $title=$row['title'];
    $sku=$row['sku'];
    $category=$row['category'];
    $color=$row['color'];
    $image=$row['image'];
    $size=$row['size'];
    $price=$row['price'];
    $currency=$row['currency'];
    $description=$row['description'];
    $status=$row['status'];

    $update=true;
}
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $title=$_POST['title'];
    $sku=$_POST['sku'];
    $category=$_POST['category'];
    $color=$_POST['color'];
    $oldimage=$_POST['oldimage'];
    $size=$_POST['size'];
    $price=$_POST['price'];
    $currency=$_POST['currency'];
    $description=$_POST['description'];
    $status=$_POST['status'];

    if(isset($_FILES['image']['title'])&&($_FILES['image']['name']!="")){
        $newimage="uploads/".$_FILES['image']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
    }
    else{
        $newimage=$oldimage;
    }
    $query="UPDATE products SET title=?,sku=?,category=?,color=?,image=?,size=?,price=?,currency=?,description=?,status=? WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ssssi",$title,$sku,$category,$color,$newimage,$size,$price,$currency,$description,$status,$id);
    $stmt->execute();

    $_SESSION['response']="Updated Successfully!";
    $_SESSION['res_type']="primary";
    header('location:index.php');
}

if(isset($_GET['details'])){
    $id=$_GET['details'];
    $query="SELECT * FROM products WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $row=$result->fetch_assoc();

    $vid=$row['id'];
    $vtitle=$row['title'];
    $vsku=$row['sku'];
    $vcategory=$row['category'];
    $color=$row['color'];
    $vimage=$row['image'];
    $size=$row['size'];
    $price=$row['price'];
    $currency=$row['currency'];
    $description=$row['description'];
    $status=$row['status'];
}
//color,size,price,currency,description,status,
//$color,$size,$price,$currency,$description,$status,
?>