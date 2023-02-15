<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions_for_task.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php 
if(isset($_POST['submit']))
{
    //process the form
    $name = mysql_prep($_POST["name"]);
    $price =  $_POST["price"];
    $quantity = (int) $_POST["quantity"];
    $visible = (int) $_POST["visible"];
    $img=$_FILES['img'];

    //extracting the file data 
    $img_name =$img['name'];
    $img_type =$img['type'];
    $img_tmp_name =$img['tmp_name'];
    $img_error =$img['error'];
    $img_size =$img['size'];
    $img_ext=pathinfo($img_name,PATHINFO_EXTENSION);
    $img_new_name=uniqid(). "." . $img_ext;

    $img_size_kb=$img_size/(1024);
    //validations 
    $required_fields = array("name" ,"price","quantity" , "visible");
    validate_presences($required_fields);

    $fields_with_max_length = array ("name" => 30);
    validate_max_lengths($fields_with_max_length);

    //img valdiation...
    //error=0;ext=png,jpg;1kp->2048kb
    validate_img($img_error,$img_ext,$img_size_kb);


    move_uploaded_file($img_tmp_name,"../public/images/$img_new_name");

    if(!empty($errors))
    {
        $_SESSION["errors"]= $errors;
        redirect_to("new_product.php");
    }

    $query  = "INSERT INTO product ( ";
    $query .= "name ,price,quantity,image, visible  ";
    $query .= ") VALUES ( ";
    $query .= "'{$name}',{$price},{$quantity},'{$img_new_name}',{$visible} ";
    $query .= ")";
    $result = mysqli_query($connection,$query);

    if ($result)
    {
      //success
      $_SESSION["message"] ="Product Created";
      redirect_to("Main.php");
    } 
    else
    {
        //faluire وهيبقى خطا فادح يعني ضرب الداتا تايب
        $_SESSION["message"]="Product Creation Failed";
        redirect_to("new_product.php");
    }

}
else
{
    //if the val didn't submit
    // so it's prply a Get req يعني حد كتب بايده ف شريط الموقع
    redirect_to("new_product.php");
}
?>





<?php
if(isset($connection)) {mysqli_close($connection);}
?>