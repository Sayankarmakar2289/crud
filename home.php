<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', 'yoru',);
// error handiling
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// query on database to delect products
$statement = $pdo->prepare('SELECT * FROM products');
$statement->execute();
$products = $statement->fetchAll();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">





    <style>
        html {
            height: 100%;
            box-sizing: border-box;
        }

        body {
            background: #ffffff url('https://images.unsplash.com/photo-1495985812444-236d6a87bdd9?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=900&ixid=MnwxfDB8MXxyYW5kb218fHx8fHx8fHwxNjI0NjQxNzU4&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=1600') no-repeat center/cover;
        }

        .thumb-image
        {
            width: 50px;
            
        }
    </style>

    <title>PRODUCTS</title>








</head>

<body>

    <figure class="text-center">
        <blockquote class="blockquote">
            <strong>
                <p>WELCOME TO THE ORGAN STORE</p>
            </strong>
        </blockquote>
        <figcaption class="blockquote-footer">
            <h6>Get variety of organs at cheap rate</h6>
        </figcaption>
    </figure>
    <p>
        <a href="create.php" type="button" class="btn btn-outline-primary">Create</a>
    </p>
    <table class="table">
        <thead class="p-2 bg-primary text-white">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="shadow-lg p-3 mb-5 bg-body rounded">
            <?php foreach ($products as $id => $product) { ?>
                <tr>
                    <th scope="row" class="shadow p-3 mb-5 bg-body rounded"><?php echo $id + 1 ?></th>
                    <td class="shadow p-3 mb-5 bg-body rounded"><?php echo $product['title'] ?></td>
                    <td class="shadow p-3 mb-5 bg-body rounded"><?php echo $product['price'] ?></td>
                    <td class="shadow p-3 mb-5 bg-body rounded"><?php echo $product['create_date'] ?></td>
                    <td class="shadow p-3 mb-5 bg-body rounded"><img class="thumb-image" src="<?php echo $product['image']?>"> </img></td>
                    <td>
                        <button type="button" class="btn-sm btn-outline-primary">Edit</button>
                        <button type="button" class="btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>