@extends('layout.master')  

@section('content')
  @include('notice')
  @if (is_login())
    <p>欢迎你: {{current_user()->name}}</p>
  @else
    <a href='sessions/new.php'>login</a>
  @endif  
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
        //need to be refact as $pager->result();
        foreach ($pager->query($_GET['page'])->get() as $post) {
      ?>
          <tr>
            <td>{{ $post->id }}</td>
            <td><a href="show.php?id={{$post->id}}">{{$post->title}}</a></td>
            <td>{{ date('Y-m-d',strtotime($post->created_at)) }}</td>
            <td> 
              <a href="edit.php?id={{$post->id}}">改</a> 
              <a href="delete.php?id={{$post->id}}">删</a> 
            </td>        
          </tr> 
 
      <?php  } ?>
  
    </tbody>
  </table>
  <a href="new.php">新增</a>

  {{ $pager->nav_html() }}

@stop


@section('siderbar')
  @parent
  <div>here is override</div>
@stop {{-- or @overwrite --}}