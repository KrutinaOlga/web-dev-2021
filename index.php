<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyTitleOfPage</title>
    <style>


    </style>
    <link rel="stylesheet" href="main.css">
</head>
<?php
include_once "autoloader.php";


;

?>
<body>
<div class="card_buttons_box">
    <a href="form.php"> Добавить винтовку </a>
</div>
<div>
    <a href="login.php"> Войти </a>
</div>
<div class="card_list" >
<?php
foreach(DB::getInstance()->getGuns() as $item) {
?>
    <div class="card" >
        <div class="card_header" >
            <div class="card_author_box" >
                <div >
                    <img src = <?=$item->image_link ?>  >
                </div >
                <div >
                    <a href = "#" > ссылочка </a >
                    <p > <?=$item->title ?> </p >
                </div >
            </div >
            <div class="card_buttons_box" >
                <a href = "#" class="icon icon_profile" ></a >
                <a href = "#" class="icon icon_menu" ></a >
            </div >
        </div >
        <div class="card_image" ><img src = <?=$item->image_link ?> ></div >
        <div class="card_footer" > <?=$item->description ?> </div >
    </div >

<?php
}
?>
</div >
</body>
<?php
