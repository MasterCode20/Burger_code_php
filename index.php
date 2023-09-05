<!DOCTYPE html>
<html>
<head>
        <title>Burger code </title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://fonts.cdnfonts.com/css/holtwood-one-sc" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container ">
            <h1 class="text-logo"><i class="fas fa-utensils"></i> Burger Code <i class="fas fa-utensils"></i></h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg" ><i class="fas fa-plus"></i>ajouter</a></h1>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Categorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                                require 'database.php';
                                $db = Database::connect();
                                $statement = $db->query('SELECT items.name,items.id,items.description,items.price, categories.name as category from burger_code.items
                                LEFT JOIN burger_code.categories ON burger_code.items.category = burger_code.categories.id
                                ORDER BY burger_code.items.id DESC');
                                while($item = $statement->fetch())
                                {
                                echo'<tr>';
                                echo'<td>' . $item['name'] . '</td>';
                                echo'<td>' . $item['description'] . '</td>';
                                echo'<td>' . number_format((float)$item['price'],2,'.','') . '</td>';
                                echo'<td>' . $item['category'] . '</td>';
                                   echo'<td width="300">';
                                      echo'<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><i class="fas fa-eye"></i>Voir</a>';
                                      echo' ';
                                      echo'<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><i class="fas fa-pencil"></i>Modifier</a>';
                                      echo' ';
                                      echo'<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><i class="fas fa-trash"></i>Supprimer</a>';

                                      echo'</td>';
                                echo'</tr>';
                                }
                                Database::disconnect();
                            ?>
                             
                        </tbody>
                </table>
            </div>
         
        </div>

    </body>
</html>