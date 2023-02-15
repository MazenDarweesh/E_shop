<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions_for_task.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_product(); ?>

<div id="main">
    <div id="navigation">
     <?php 
       echo navigation($current_product) ;
     ?>
      </div>
    <div id="page">
        <?php echo message();?>
        <?php $errors= errors();?>
        <?php echo form_errors($errors); ?>
        <h2>Create Product</h2>
        <form action="create_product.php" method ="post" enctype="multipart/form-data">
         <p> Product Name
             <input type="text" name ="name" value=""/>
         </p>
         <p> Product Price
             <input type="text" name ="price" value=""/>
         </p>
         <p>Quantity
         <input type="text" name ="quantity" value=""/>
        </p> 
            <p>Visible
             <input type ="radio" name= "visible" value="0" />NO
             <input type ="radio" name= "visible" value="1"/> YES
         </p>
         <p>Image
         <input type="file" class="page-file" name ="img" >
        </p> 
         <input type ="submit" name ="submit" value="Create product"/>
        </form>
        <br/>
        <a href="Main.php">Cancel</a>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
