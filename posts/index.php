<?php 

require_once '../inc/session.php';
require_once '../inc/db.php';

//计算总记录数
$query = $db->query('select count(*) as amount from posts;');
$row_amount = $query->fetchObject()->amount;
        
//计算总页数
$page_size = 2;
$page_amount = ceil($row_amount / $page_size);

//当未指定页号，或者页号错误时
$page_current = empty($_GET['page']) ? 1 : $_GET['page'];
if ($page_current < 1) $page_current = 1;
if ($page_current > $page_amount) $page_current = $page_amount;

//生成上一页、下一页
if($page_current <= 1 )
  $page_previous = 1 ;
else
  $page_previous = $page_current - 1;

if($page_current >= $page_amount )
  $page_next = $page_amount ;
else
  $page_next = $page_current + 1 ;

$params = $_GET;
$params['page'] = 1;
$page_first_q =  http_build_query($params);
$params['page'] = $page_previous;
$page_previous_q =  http_build_query($params);
$params['page'] = $page_next;
$page_next_q =  http_build_query($params);
$params['page'] = $page_amount;
$page_last_q =  http_build_query($params);


//计算返回纪录的起点与记录数
$row_base= ($page_current-1) * $page_size;
$page_sql = "LIMIT {$page_size} OFFSET {$row_base}";

$sql =  "select * from posts  $page_sql";
//echo $sql;
$query  = $db->query($sql);
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

  <div id="pager"> 
    <a href="?<?php echo $page_first_q ?> ">首页</a>
    <a href="?<?php echo $page_previous_q ?>">上一页</a>
    <a href="?<?php echo $page_next_q ?>">下一页</a>    
    <a href="?<?php echo $page_last_q ?>">末页</a>  
    <span>当前第 <?php echo $page_current ?>  页</span>
    <span>总共 <?php echo $page_amount ?> 页</span> 
  </div>    
</body>
</html>


