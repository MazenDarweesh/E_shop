<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions_for_task.php"); ?>

<?php
 $current_product = find_product_by_id($_GET["product"]);
if(!$current_product)
{
    //product id was missing or invalid or
    // product couldn't be found in DB
    redirect_to("Main.php");
}

$product_id = $current_product["product_id"];
$query = "DELETE FROM product WHERE product_id = {$product_id} LIMIT 1" ;
$result = mysqli_query($connection,$query);

if ($result&& mysqli_affected_rows($connection)==1)
{
 //success
 $_SESSION["message"] ="product Deleted";
 redirect_to("Main.php");
}
else
{
    $_SESSION["message"]="product Deletion Failed";
    redirect_to("Main.php?product={$product_id}");
}

?>