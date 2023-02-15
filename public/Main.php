<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions_for_task.php"); ?>
<?php $layout_context = "admin_for_shop"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_product(); ?>

<div id="main">
    <div id="navigation">
      <br/>
      <a href = "admin_for_shop.php"> &laquo; Main Menu</a><br/>
     <?php 
       echo navigation($current_product) ;
     ?>
     <br/>
     <a href="new_product.php">+Add a New product</a>
    </div>
    <div id="page">
        <?php echo message();?>
        <?php if($current_product) { ?>
        <h2>Manage Product List</h2>
        Product Name: <?php echo htmlentities($current_product["name"]);?>
        <br/>
        Quantity: <?php echo $current_product["quantity"]; ?>
        <br/>
        Price: <?php echo $current_product["price"]; ?>
        <br/>
        Visible: <?php echo $current_product["visible"]==1?'yes':'no'; ?>
        <br/>  
        <br/>
        <img src="../public/images/<?php echo $current_product["image"];  ?>">
        <br/>  
        <a href = "edit_product.php?product=<?php echo urlencode($current_product["product_id"]);?>"> Edit product </a>
        <br/>

      
         <br/><br/>
        

        <?php } else { ?>
        <h2>Manage Content</h2>
        Please Select a product 
        <?php }   ?>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
