<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" href="style2.css">
   
  
    <title>minitchat</title>
</head>


<body>
   
   <?php
    // connexion a la bdd
   try {
        $bdd = new PDO("mysql:host=localhost;dbname=minitchat;charset=utf8", 'root', 'samroot');
       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e) {
        die('erreur :  ' . $e->getessage());
    }
    ?>
    
     <?php
    if(!isset($_SESSION['user'])){
            $_SESSION['user'] = "guest";
            
        }
    ?> 
    
   
   
<h1><u>tp mini tchat</u></h1>


<div class="container">
 <div class="jumbotron">
  
<div class="container basdepage col-sm-10" >
<form action="action_page.php" method="post">
 
    <div class="form-group row ">
     <div class="offset-sm-2 col-sm-12 ">
      <label for="user" class="text-center ">pseudo</label>
      
        <input type="text" class="form-control" id="user" name="user" placeholder="votre pseudo" value = "<?php echo $_SESSION['user']?>" >
        
         
        
      </div>
    </div>
    
    <div class="form-group row">
    <div class="offset-sm-2 col-sm-12 ">
    <label for="message">message</label>
    <textarea class="form-control" id="message" name="message" rows="3"  cols="70" ></textarea>
  </div>
    </div>
    
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary">envoyer le message</button>
        
          <hr>
 
      </div>
    </div>
  </form>
 </div>
   
   
   
    
        
    
      
  
  <?php
        
     $reponse= $bdd->query('SELECT user, message, date FROM messages ORDER BY ID DESC LIMIT 0, 10');
     while($donnes = $reponse->fetch()):
           
//formatage de la date
    $date = new DateTime($donnes['date']);
    $dateFormatee = $date->format('d/m/Y');
    $heureForamtee = $date->format('H:i:s');
        
        

 
  ?>
  
  
  <div class="row ">
       <div class="col-sm-10">
       
   <h4>
       <span class="label label-default">
       
       <?=  $donnes['user'] . " " ?>
       
       </span>

      <span class="date"> <small>
          <?= " .Le " . $dateFormatee . " à " . $heureForamtee ?>
      </small>
      
      </span>
   </h4>    
       </div>
  </div>




<div class="row col-sm-10">
   <div class="well bloc">
<p><?=  $donnes['message'] ?></p>
       
   </div>

    
</div>




 
   <?php endwhile; ?> 
    <?php $reponse->closeCursor(); ?>

  
  
 
  <br><br><br>
</div>

</div>



</body>
</html>