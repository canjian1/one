<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account = htmlspecialchars($_POST['account']);
    $password = htmlspecialchars($_POST['password']);
    $steps = htmlspecialchars($_POST['steps']);
    
    $url = "https://steps.api.030101.xyz/api?account=$account&password=$password&steps=$steps";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 禁用SSL验证
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        $message = '提交失败!';
    } else {
        // 检查api返回结果中是否包含 "success" 或 "密码错误"
        if (strpos($result, 'success') !== false) {
                 echo "<script>alert('提交成功！');</script>";
                 exit;
        } 
        else{
               echo "<script>alert('提交失败，请检查账号密码是否正确！');</script>";
               exit;
        } 
    }
    
    curl_close($ch);
    
    // 输出JavaScript代码来显示弹窗消息
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script type='text/javascript'>window.history.back();</script>";
} else {
    echo "<script type='text/javascript'>alert('无效的请求方式。');</script>";
    echo "<script type='text/javascript'>window.history.back();</script>";
}
?>