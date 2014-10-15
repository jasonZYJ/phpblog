<?php 
require_once '../inc/session.php';
require_once '../inc/db.php';

require_once '../inc/pager.php';

$query = pager_query('select * from posts ',$nav_html,$_GET['page']);
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

  <?php echo $nav_html; ?> 
</body>
</html>


