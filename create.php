<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', 'yoru',);
// error handiling
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// form validation array
$errors = [];



// inserting in db
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $date = $_POST['date1'];
    $image = $_FILES['image'];

    // $date = date('Y-m-d H:i:s');





    // form validation
    if (!$title) {

        $errors[] = 'Please enter the title';
    }

    if (!$price) {

        $errors[] = 'Please enter the price';
    }

    if (!$date) {

        $errors[] = 'Please enter the date';
    }

    // create a server image storing folder if not exists
    if (!is_dir('data images')) {
        mkdir('data images');
    }


    if (!$errors) {

        $imagePath = '';

        // image error handling
        $image = $_FILES['image'] ?? null;

        if ($image && $image['tmp_name']) {

            $imagePath = 'data images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname($imagePath));

            // uploading files to server filesystem
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        // $pdo->prepare("INSERT INTO products (title, price, create_date) VALUES ('$title', $price, '$date')");
        $stmt = $pdo->prepare("INSERT INTO `products` (`id`, `title`, `price`, `create_date`, `image`) VALUES (NULL, '$title', $price, '$date', '$imagePath')");
        $stmt->execute();
        header('Location: home.php');
    }
}

// random string generatoring function
function randomString($n)
{

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzACBDEFGHIJKLMNOPQRSTUVWZXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str = $characters[$index];
    }
    return $str;
}

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create Products</title>
    <style>
        html {
            height: 100%;
            box-sizing: border-box;
        }

        body {
            background: #ffffff url('https://images.unsplash.com/photo-1495985812444-236d6a87bdd9?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=900&ixid=MnwxfDB8MXxyYW5kb218fHx8fHx8fHwxNjI0NjQxNzU4&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=1600') no-repeat center/cover;
        }
    </style>
</head>


<body>






    <?php if (!empty($errors)) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">

            <?php foreach ($errors as $error) : ?>

                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>











    <!-- form code -->
    <form action="create.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <br>
            <input type="file" name="image">
        </div>



        <div class="mb-3">
            <label class="form-label">Product Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Title Here">
            <div id="validationServer03Feedback" class="invalid-feedback">
                Please provide a Title.
            </div>
        </div>




        <div class="mb-3">
            <label class="form-label">Product Price</label>
            <input type="number" name="price" class="form-control" step=".01" placeholder="Enter Price Here">
        </div>




        <div class="mb-3">
            <label class="form-label">Product Date</label>
            <input type="date" name="date1" class="form-control">
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>













    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>





