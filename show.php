<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>show | 博客</title>
</head>
<body>
  <?php        
    mysql_connect('localhost','demo','demo') or die('can`t work');
    mysql_query("SET NAMES utf8");    
    mysql_select_db('phpdemo');

    $id = $_GET['id'] ;
    $sql = 'select * from posts where id = ' . $id;
    $query = mysql_query($sql);
    $post = mysql_fetch_object($query);
  ?>

  <h1><?php echo $post->id; ?> : <?php echo $post->title; ?>  </h1>
  <p><?php echo $post->body; ?></p>

</body>
</html>