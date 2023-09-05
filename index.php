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
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container site">
            <h1 class="text-logo"><i class="fas fa-utensils"></i> Burger Code <i class="fas fa-utensils"></i></h1>
            <?php
                     require 'admin/database.php';
                     echo '<nav>
                     <ul class="nav nav-tabs" role="tablist">';
                     $db = Database::connect();
                     $statement = $db->query('SELECT * FROM burger_code.categories');
                     $categorie = $statement->fetchAll();
                     foreach($categorie as $category)
                     {
                        if($category['id'] == '1')
                            echo'<li role="presentation" class="nav-item active"><button class="nav-link" id="tab'.$category['id'].'-tab" type="button" role="tab" aria-selected="true" data-bs-toggle="tab" data-bs-target="#tab'.$category['id'].'">'.$category['name'].'</button></li>';
                        else
                           echo'<li role="presentation" class="nav-item"><button class="nav-link" id="tab'.$category['id'].'-tab" type="button" role="tab" aria-selected="true" data-bs-toggle="tab" data-bs-target="#tab'.$category['id'].'">'.$category['name'].'</button></li>';
                     }
                     echo'</ul>
                     </nav>';
                     echo'<div class="tab-content">';
                     foreach($categorie as $category)
                     {
                        if($category['id'] == '1')
                             echo'<div class="tab-pane fade show active " role="tabpanel" aria-labelledby="tab'.$category['id'].'-tab" id="tab'.$category['id'].'">';
                        else
                        echo'<div class="tab-pane fade show" role="tabpanel" aria-labelledby="tab'.$category['id'].'-tab" id="tab'.$category['id'].'">';
                        echo' <div class="row">';
                            $statement = $db->prepare('SELECT * FROM burger_code.items WHERE items.category =?' );
                            $statement->execute(array($category['id']));
                            while($item = $statement->fetch())
                            {
                              echo'<div class="col-sm-6 col-md-4">
                                     <div class="card">
                                         <img src="images/'.$item['image'].'" alt="..">
                                         <div class="price">'.number_format((float)$item['price'],2,'.',''). '$</div>
                                         <div class="caption">
                                             <h4>'.$item['name'].'</h4>
                                             <p>'.$item['description'].'</p>
                                             <a href="#" class="btn btn-order" role="button"><i class="fas fa-shopping-cart"></i> Commander</a>
                                           </div>
                                     </div>
                                  </div>';
                            
                            }
                        echo'    </div>
                            </div>';
                     }
                     Database::disconnect();
                echo'</div>';     
           ?>
        </div>
    </body>
</html>