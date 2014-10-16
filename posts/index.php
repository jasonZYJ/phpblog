<?php 
require_once '../inc/common.php';
require_once '../inc/session.php';
require_once '../inc/db.php';

//require_once '../inc/orm.php';
//use Illuminate\Database\Capsule\Manager as Capsule;
//echo Capsule::table('posts')->count();
//class Post extends Illuminate\Database\Eloquent\Model {}
//echo Post::all()->count();
//require_once '../inc/pager.php';

$pager = new Pager('select * from posts ');
$query = $pager->query($_GET['page']);
//$pager2 = new Pager('select * from users ',2,'page2');
//$query2 = $pager2->query($_GET['page2']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>首页 - 博客</title>
</head>

<body>
  <?php if(is_login()) echo '当前用户: ' . current_user()->name ;?>
  <table border=1>
    <caption><h1>帖子列表</h1></caption>
    <thead>
      <tr>
        <th>id</th>
        <th>标题</th>
        <th>创建日期</th>
        <th>操作</th>        
      </tr>
    </thead>
    <tbody>
      <?php
        while ( $post =  $query->fetchObject() ) {
      ?>
          <tr>
            <td><?php echo $post->id; ?></td>
            <td><a href="show.php?id=<?php print $post->id; ?>"><?php echo $post->title; ?></a></td>
            <td><?php echo date('Y-m-d',strtotime($post->created_at));?></td>
            <td> 
              <a href="edit.php?id=<?php echo $post->id; ?>">改</a> 
              <a href="delete.php?id=<?php echo $post->id; ?>">删</a> 
            </td>        
          </tr> 
 
      <?php  } ?>
  
    </tbody>
  </table>
  <a href="new.php">新增</a>

  <?php echo $pager->nav_html(); ?> 
</body>
</html>


