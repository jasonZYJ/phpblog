<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>show | 博客</title>
</head>
<body>
  <?php        
    require_once './inc/db.php';    
    
    $query = $db->prepare('select * from posts where id = :id');
    $query->bindValue(':id',$_GET['id'],PDO::PARAM_INT);
    $query->execute();
    $post = $query->fetchObject();    
  ?>

  <h1><?php echo $post->id; ?> : <?php echo $post->title; ?>  </h1>
  <p><?php echo $post->body; ?></p>

</body>
</html>