<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/img/fav.ico" type="image/x-icon">

    <?php foreach ($srcCsses as $srcCss): ?>
    <link rel="stylesheet" href="<?php echo $srcCss?>">
    <?php endforeach; ?>

    <title>SnowBoards</title>
</head>
<body>
   
<div class="header">

    <?php foreach ($srcLogotypes as $srcLogotype): ?>
    <img src="<?php echo $srcLogotype?>" alt="logotype1">
    <?php endforeach; ?>

</div>
<hr>

<div class="menu">
    <ul>
        <li><a class="linkMenu" href="/"> Menu </a></li>
        <li><a class="linkMenu" href="/goods"> Goods </a></li>
        <li><a class="linkMenu" href="/contacts"> Contacts </a></li>
        <li><a class="linkMenu" href="/login">Authorized</a></li>
        <li><a class="linkMenu" href="/users">Users</a></li>
    </ul>
</div>
<hr>

<?php 

$handleRequest();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php foreach ($jsScripts as $jsScript): ?>
<script src="<?php echo $jsScript?>"></script>
<?php endforeach; ?>


</body>
</html>