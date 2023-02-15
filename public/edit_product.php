<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions_for_task.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_product(); ?>

<?php 
if(!$current_product)
{
    //product id was missing or invalid or
    // product couldn't be found in DB
    redirect_to("Main.php");
}
?>

<?php 
if(isset($_POST['submit']))
{
    
///validations 
$required_fields = array("name" ,"price","quantity" , "visible");
validate_presences($required_fields);

$fields_with_max_length = array ("name" => 30);
validate_max_lengths($fields_with_max_length);


    if(empty($errors))
    { 
        //perform update
         $product_id =$current_product["product_id"];
         $name = mysql_prep($_POST["name"]);
         $quantity = (int) $_POST["quantity"];
         $price =  $_POST["price"];
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
        validate_img($img_error,$img_ext,$img_size_kb);

        move_uploaded_file($img_tmp_name,"../public/images/$img_new_name");

        $query  = "UPDATE product SET  ";
        $query .= "name = '{$name}',  ";
        $query .= "quantity = {$quantity},  ";
        $query .= "price = {$price},  ";
        $query .= "image = '{$img_new_name}',  ";
        $query .= "visible = {$visible}  ";
        $query .=  "WHERE product_id = {$product_id}  ";
        $query .=  "LIMIT 1 ";
        $result = mysqli_query($connection,$query);

        if ($result&& mysqli_affected_rows($connection)>=0)
        {
        //success
        $_SESSION["message"] ="product Updated";
        redirect_to("Main.php");
        }
    }
    else
    {
        //faluire وهيبقى خطا فادح يعني ضرب الداتا تايب
       $message ="product Update Failed";
    }

}
else
{
    //if the val didn't submit
    // so it's prply a Get req يعني حد كتب بايده ف شريط الموقع
}
?>

<?php $layout_context = "admin_for_task"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
     <?php 
       echo navigation($current_product) ;
     ?>
      </div>
    <div id="page">
        <?php //$message is just var dnot use session
        if(!empty($message))
        {
            echo "<div class=\"message\">" . htmlentities($message) . "</div>";
        }  

        ?>
        <?php echo form_errors($errors); ?>
        <h2>Edit product: 
        <?php echo htmlentities($current_product["name"]);?></h2>

        <form action="edit_product.php?product=<?php echo urlencode($current_product["product_id"]);?>" method ="post" enctype="multipart/form-data">
        
        <p> Product Name
             <input type="text" name ="name" value="<?php echo htmlentities($current_product["name"]);?>"/>
        </p>

         Quantity:  <input type="text" name ="quantity" value="<?php echo $current_product["quantity"];?>"/>
        <br/>

        Price: <input type="text" name ="price" value="<?php echo $current_product["price"];?>"/>
        
        <br/>
        <p>Visible
             <input type ="radio" name= "visible" value="0" <?php if($current_product["visible"]==0) {echo "checked";} ?> />NO
             <input type ="radio" name= "visible" value="1" <?php if($current_product["visible"]==1) {echo "checked";} ?>/> YES
         </p>        <br/>  

         <p>Image
         <input type="file" class="page-file" name ="img"  value="<?php echo $current_product["image"];?> ">
        </p>   

         <input type ="submit" name ="submit" value="Edit product"/>
        </form>
        <br/>
        <a href="Main.php">Cancel</a>
        <?php//non breaking space?>
        &nbsp;
        &nbsp;
        <a href = "delete_product.php?product=
        <?php echo urlencode($current_product["product_id"]); ?>" onclick="return confirm ('Are you sure??')">
        Delete product</a>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
