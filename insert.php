<?php
     require 'database.php';
     $nameError = $descriptionError = $priceError = $imageError = $categoryError =$name = $description = $price = $image = $category = "";
     if(!empty($_POST))
     {
        $name             = checkInput($_POST['name']);
        $description      = checkInput($_POST['description']);
        $price            = checkInput($_POST['price']);
        $category         = checkInput($_POST['category']);
        $image            = checkInput($_FILES['image']['name']);
        $imagePath        = '../images/'. basename($image);
        $imageExtension   = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess        = true;
        $isUploadsuccess  = false;

        if(empty($name))
        {
            $nameError = "ce champ est obligatoire";
            $isSuccess  = false;
        }
        if(empty($description))
        {
            $descriptionError = "ce champ est obligatoire";
            $isSuccess  = false;
        }
        if(empty($price))
        {
            $priceError = "ce champ est obligatoire";
            $isSuccess  = false;
        }
        if(empty($category))
        {
            $categoryError = "ce champ est obligatoire";
            $isSuccess  = false;
        }
        if(empty($image))
        {
            $imageError = "ce champ est obligatoire";
            $isSuccess  = false;
        }
        else
        {
           $isUploadsuccess = true;
           if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension !="gif")
           {
               $imageError = "les ficiers autorises sont : jpg,png,jpeg,gif";
               $isUploadsuccess = false;
           }
           if(file_exists($imagePath))
           {
              $imageError = "le ficier existe deja!!";
              $isUploadsuccess = false;
           }
           if($_FILES["image"]["size"] > 500000)
           {
              $imageError = "le fichier ne doit pas depasser 500KB";
              $isUploadsuccess = false;
           }
           if($isUploadsuccess)
           {
             if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
               {
                  $imageError = "il ya eu une errreur lors de lupload";
                  $isUploadsuccess = false;
               }
           }
        }

        if($isSuccess && $isUploadsuccess)
          {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO burger_code.items (name,description,price,category,image) VALUE(?,?,?,?,?)" );
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: index.php");

          }
     }


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
        <div class="container ">
            <h1 class="text-logo"><i class="fas fa-utensils"></i> Burger Code <i class="fas fa-utensils"></i></h1>
            <div class="container admin">
             <div class="row">
                   <h1><strong>Ajouter un items</strong></h1>
                   <br>
                 <form  class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="nom de larticle" value="<?php echo $name; ?>">
                            <span class="help-inline"><?php echo $nameError ?></span>
                        </div>
                        <div class="form-group">
                        <label for="description">Description:</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="la description" value="<?php echo $description; ?>">
                            <span class="help-inline"><?php echo $descriptionError ?></span>
                        </div>
                        <div class="form-group">
                        <label>Prix: (en $)</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="le prix" value="<?php echo $price ?>">
                            <span class="help-inline"><?php echo $priceError ?></span>
                        </div>
                        <div class="form-group">
                            <label for="category">categorie</label>
                            <select type="text" id="category" class="form-control" name="category">
                            <?php
                                $db = Database::connect();
                                foreach($db->query('SELECT * from burger_code.categories;') as $row)
                                {
                                   echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                Database::disconnect();
                            ?>
                            </select>
                            <span class="help-inline"><?php echo $categoryError ?></span>
                        </div>
                        <div class="form-group">
                           <label for="image">Sélectioner une image:</label><br>
                           <input type="file"  id="image" name="image">
                           <span class="help-inline"><?php echo $imageError; ?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Ajouter</button>
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour</a>
                        </div>
                </form>
                   
             </div>
         
        </div>

    </body>
</html> 