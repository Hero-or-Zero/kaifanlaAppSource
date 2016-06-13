<?php
/*
*该页面用于detail.html
*根据菜品编号向客户端分页返回某一道菜品详情以json格式
*/
$output=[];
@$did=$_REQUEST['did'];
if(!$did){//若客户端未提交菜品编号，或者编号为空
    echo '[]';
    return;
}

//连接数据库
$conn=mysqli_connect('127.0.0.1','root','','kaifanla','3306');
//设置编码方式
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
//数据库操作
$sql = "SELECT did,name,price,img_lg,material,detail FROM kf_dish WHERE did=$did";
$result=mysqli_query($conn,$sql);
if(($row=mysqli_fetch_assoc($result))!==NULL){//一行一行的从数据库里面读取数据
    $output[]=$row;
}

echo json_encode($output);
?>