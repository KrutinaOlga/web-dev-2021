<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include_once "NewGun.php";
    include_once "./core/db.php";

    $n = new NewGun();
    /** @var NewGun $n */
    $n->title = $_POST['title'];
    $n->image_link = $_POST['image_link'];
    $n->description = $_POST['description'];
    DB::getInstance()->saveGunsItem($n);
     header("Location: form.php?saved");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php
if (isset($_GET['saved'])){
    echo "Винтовка добавлена";
}
?>

<form class="InpForm" method="post" action="form.php">

    <div class="FormElement50 form_group">
        <input name ="title" id="FirstName" type="text"  required >
        <label for="FirstName"> Title </label>
    </div>
    <div class="FormElement50  form_group">
        <input  name ="description" id="SecondName" type="text"  required >
        <label for="SecondName">Description </label>
    </div>
    <div class="FormElement50 form_group">
        <input name ="image_link" id="Login"    type="text" required>
        <label for="Login">Image_link</label>
    </div>
    <div class="form_group">
        <button type="submit">Save</button>
    </div>

</form>
</body>
</html>