<?php
require 'db_connect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'] ?? '';
    $pass = $_POST['password'] ?? '';
    $q = $db->prepare("SELECT id,password,is_approved FROM users WHERE phone=? LIMIT 1"); $q->bind_param('s',$phone); $q->execute(); $r = $q->get_result()->fetch_assoc();
    if (!$r) $err='بيانات الدخول غير صحيحة'; else {
        if (!password_verify($pass,$r['password'])) $err='بيانات الدخول غير صحيحة';
        elseif (!$r['is_approved']) $err='حسابك قيد المراجعة'; else { $_SESSION['user_id']=$r['id']; header('Location: user_dashboard.php'); exit; }
    }
}
?><!doctype html><html lang='ar' dir='rtl'><head><meta charset='utf-8'><title>تسجيل الدخول</title></head><body>
<h2>تسجيل الدخول</h2><?php if(!empty($err)) echo '<div style="color:red">'.htmlspecialchars($err).'</div>'; ?>
<form method='post'><input name='phone' placeholder='رقم الهاتف' required><br><input name='password' type='password' placeholder='كلمة المرور' required><br><button>دخول</button></form>
</body></html>