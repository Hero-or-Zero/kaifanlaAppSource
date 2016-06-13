<?php
/*
*该页面用于main.html
*根据搜索关键字向客户端分页返回菜品数据以json格式
*/
$output = [];
@$kw = $_REQUEST['kw'];
if(!$kw){  //若客户端未提交或提交了空字符串
    echo '[]';
    return;  //退出当前页面的执行
}

//连接数据库
$conn=mysqli_connect('127.0.0.1','root','','kaifanla','3306');
//设置编码方式
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
//数据库操作
$sql = "SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%'";
$result=mysqli_query($conn,$sql);
while(($row=mysqli_fetch_assoc($result))!==NULL){//一行一行的从数据库里面读取数据
    $output[]=$row;
}

echo json_encode($output);
?>