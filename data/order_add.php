<?php
/*
*该页面用于order.html
*获取客户端提交的订单数据，保存到数据库中
*向客户端返回保存的结果，以json格式
*/
$output=[];
@$user_name=$_REQUEST['user_name'];
@$phone=$_REQUEST['phone'];
@$sex=$_REQUEST['sex'];
@$addr=$_REQUEST['addr'];
@$did=$_REQUEST['did'];
$order_time=time()*1000;//下单时间即当前的系统时间，因为time()返回时秒，所以*1000变为毫秒
if(!$user_name||!$addr||!$phone||!$did){
    echo '{"result":"error","msg":"INVALID REQUEST DATA!"}';
    return;
}

//连接数据库
$conn=mysqli_connect('127.0.0.1','root','','kaifanla','3306');
//设置编码方式
$sql='SET NAMES UTF8';
mysqli_query($conn,$sql);
//数据库操作
$sql = "INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";
$result=mysqli_query($conn,$sql);
if($result){//执行成功
    $output['result']='ok';
    //获取刚刚执行的INSERT语句生成的自增编号
    $output['oid']=mysqli_insert_id($conn);
}else{//执行失败
    $output['result']='fail';
    $output['msg']='添加失败！很可能是SQL语法错误！'.$sql;
}
//user_name=张三&phone=123435&sex=1&addr=万寿路123号&did=7

echo json_encode($output);
?>