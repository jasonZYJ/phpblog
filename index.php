<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>首页 - 博客</title>
</head>

<body>
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
        $posts = Array(
            Array('id'=>'1','title'=>'第1篇帖子','created_at'=>'2012-1-1  21:07:57'),
            Array('id'=>'2','title'=>'第2篇帖子','created_at'=>'2012-2-2  21:07:57'),
            Array('id'=>'3','title'=>'第3篇帖子','created_at'=>'2012-3-3  21:07:57')
          );

        foreach ($posts as $post) {
      ?>

          <tr>
            <td><?php echo $post['id']; ?></td>
            <td><a href="show.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></td>
            <td><?php echo $post['created_at']; ?></td> 
            <td> 
              <a href="edit.php?id=<?php echo $post['id']; ?>">改</a> 
              <a href="delete.php?id=<?php echo $post['id']; ?>">删</a> 
            </td>        
          </tr> 
 
      <?php  } ?>
  
    </tbody>
  </table>
  <a href="new.php">新增</a>
</body>
</html>


