<?php
require 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $country_code = $_POST['country_code'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $pass = $_POST['password'] ?? '';
    if (!$name || !$email || !$phone || !$pass) { $err='الرجاء ملء الحقول المطلوبة'; }
    else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $id_image = null;
        if (!empty($_FILES['id_card']['name'])) {
            $namefile = time().'_'.basename($_FILES['id_card']['name']);
            $target = 'uploads/pending/'.$namefile;
            if (!is_dir(dirname($target))) mkdir(dirname($target),0755,true);
            move_uploaded_file($_FILES['id_card']['tmp_name'],$target);
            $id_image = $namefile;
        }
        $db->query("INSERT INTO users (name,email,country_code,phone,password,id_image,is_approved) VALUES ('".$db->real_escape_string($name)."','".$db->real_escape_string($email)."','".$db->real_escape_string($country_code)."','".$db->real_escape_string($phone)."','".$db->real_escape_string($hash)."','".$db->real_escape_string($id_image)."',0)");
        $success = 'تم إنشاء الحساب. في انتظار موافقة الإدارة.';
    }
}
?>
<!doctype html><html lang='ar' dir='rtl'><head><meta charset='utf-8'><title>إنشاء حساب</title></head><body>
<h2>إنشاء حساب</h2>
<?php if(!empty($err)) echo '<div style="color:red">'.htmlspecialchars($err).'</div>'; ?>
<?php if(!empty($success)) echo '<div style="color:green">'.htmlspecialchars($success).'</div>'; ?>
<form method='post' enctype='multipart/form-data'>
<input name='name' placeholder='الاسم كما في الهوية' required><br>
<label>تصوير/رفع الهوية</label><input name='id_card' type='file' accept='image/*' capture='camera' required><br>
<input name='email' placeholder='البريد الإلكتروني' required><br>
<select name='country_code'><option value='+966'>+966 السعودية</option><option value='+20'>+20 مصر</option></select>
<input name='phone' placeholder='رقم الهاتف' required><br>
<input name='password' type='password' placeholder='كلمة المرور' required><br>
<button>إنشاء الحساب</button>
</form>
</body></html>