<?php
     require 'database.php';

     if(!empty($_GET['id']))
     {
        $id = checkInput($_GET['id']);
     }
     if(!empty($_POST))
     {
            $id = checkInput($_POST['id']);

            $db = Database::connect();
            $statement  = $db->prepare('DELETE FROM burger_code.items WHERE id = ?');
            $statement->execute(array($id));
            Database::disconnect();
            header("Location: index.php");

     }


     function checkInput($data)
     {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
     }
?>
<!DOCTYPE HTML>
<html lang="en">
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
                <div class="col-sm-6">
                   <h1><strong>Supprimer un item</strong></h1>
                   <br>
                   <form  class="form" action="<?php echo 'delete.php?id='.$id;?>" role="form" method="post" >
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <P class="alert alert-warning">Attention cet items sera definitivement supprimer!!</P>
                        <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                        <a class="btn btn-primary" href="index.php">Non</a>
                    </div>
                   </form> 
                </div>
            </div>
         
        </div>

    </body>
</html>