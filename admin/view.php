<?php
     require 'database.php';

     if(!empty($_GET['id']))
     {
        $id = checkInput($_GET['id']);
     }
     $db = Database::connect();
     $statement  = $db->prepare('SELECT items.name,items.id,items.description,items.price,items.image, categories.name as category from burger_code.items
     LEFT JOIN burger_code.categories ON burger_code.items.category = burger_code.categories.id
     WHERE burger_code.items.id = ?');
     
     $statement->execute(array($id));
     $item = $statement->fetch();
     Database::disconnect();



     function checkInput($data)
     {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
     }
?>
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
        <div class="container">
            <h1 class="text-logo"><i class="fas fa-utensils"></i> Burger Code <i class="fas fa-utensils"></i></h1>
            <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                   <h1><strong>Voir un item</strong></h1>
                   <br>
                   <form>
                    <div class="form-group">
                        <label>Nom:</label><?php echo' ' . $item['name'];?> 
                    </div>
                    <div class="form-group">
                        <label>Description:</label><?php echo' ' . $item['description'];?> 
                    </div>
                    <div class="form-group">
                        <label>Prix:</label><?php echo' ' . number_format((float)$item['price'],2,'.','').' $';?> 
                    </div>
                    <div class="form-group">
                        <label>Categorie:</label><?php echo' ' . $item['category'];?> 
                    </div>
                    <div class="form-group">
                        <label>image:</label><?php echo' ' . $item['image'];?> 
                    </div>
                   </form>
                   <br>
                   <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><i class="fas fa-arrow-left"></i> Retour</a>
                   </div>
                </div>
                <div class="col-sm-6 site ">
                            <div class="card">
                                <?php
                                echo'<img width="200" weigth = "200" src="../images/' .$item['image']. '" alt="..">';
                                echo'<div class = "price">'.number_format((float)$item['price'],2,'.',''). ' $ </div>';
                                echo'<div class="caption">';
                                    echo'<h4>'.$item['name'].'</h4>';
                                    echo '<p>'.$item['description'].'</p>'; 
                                    echo'<a href="#" class="btn btn-order" role="button"><i class="fas fa-shopping-cart"></i> Commander</a>';
                                echo'</div>';
                                ?>
                            </div>
                    </div>
                 
                
                 
            </div>
         
        </div>

    </body>
</html>