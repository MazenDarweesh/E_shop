<?php require_once("../includes/functions_for_task.php"); ?>
<?php $layout_context = "admin_for_shop"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="page">
        <h2>Admin Menu</h2>
        <p>Welcome to the admin area.</p>
        <ul>
            <li>
                <a href="Main.php">Manage Website Content </a>
            </li>
            <li>
                <a href="manage_admins.php">Manage Admin Users </a>
            </li>
            <li>
                <a href="logout.php">logout</a>
            </li>
        </ul>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>