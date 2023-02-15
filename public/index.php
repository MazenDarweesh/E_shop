<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions_for_task.php"); ?>
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_product(); ?>

<div id="main">
    <div id="navigation">
     <?php echo public_navigation($current_product) ; ?>
    </div>
    <div id="page">
        <?php if($current_product) { ?>
        <h2>Product List</h2>
        Product Name: <?php echo htmlentities($current_product["name"]);?>
        <br/>
        Quantity: <?php echo $current_product["quantity"]; ?>
        <br/>
        Price: <?php echo $current_product["price"]; ?>
        <br/>
        <br/>
        <img src="../public/images/<?php echo $current_product["image"];  ?>">
        <br/><br/>       
       
       
        <?php  }else { ?>
        <h2>Manage Content</h2>
        Please Select a Product 
        <?php }   ?>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
