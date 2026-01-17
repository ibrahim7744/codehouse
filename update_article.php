<?php
require 'conn.php'; 
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'msg' => 'يجب استخدام طريقة POST']);
    exit;
}


if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['status' => 'error', 'msg' => 'معرف المقالة مطلوب (ID is missing).']);
    exit;
}


$id = intval($_POST['id']);
$title = $_POST['title'] ?? '';
$category = $_POST['category'] ?? '';
$content = $_POST['content'] ?? '';
$fileName = null;


$sql = "UPDATE articles SET title=?, category=?, content=?";
$types = 'sssi'; // 3 strings (sss) and 1 integer (i)
$params = [&$title, &$category, &$content];

// 5. التحقق من وجود ملف مرفق ومعالجته
if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] == 0) {
    // إنشاء اسم فريد للملف
    $fileName = time() . '_' . basename($_FILES['imageFile']['name']);
    $uploadPath = "uploads/" . $fileName;

    // التأكد من وجود مجلد "uploads" وأنه قابل للكتابة
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true); // استخدام 0777 للبيئة المحلية لضمان 
    }

    // نقل الملف
    if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadPath)) {
        // إذا نجح الرفع، أضف اسم الملف للاستعلام
        $sql .= ", image=?"; // انتبه: اسم العمود في قاعدة بياناتك هو image وليس file
        $types .= 's';
        $params[] = &$fileName;
    } else {
        // إذا فشل الرفع، أرجع خطأ واضح
        echo json_encode(['status' => 'error', 'msg' => 'فشل رفع الصورة. تحقق من صلاحيات المجلد.']);
        exit;
    }
}

// 6. إضافة ID إلى نهاية الاستعلام
$sql .= " WHERE id=?";
$params[] = &$id;

// 7. تجهيز وتنفيذ الاستعلام
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // ربط المتغيرات بالاستعلام
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'فشل تنفيذ الاستعلام: ' . mysqli_stmt_error($stmt)]);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'فشل تجهيز الاستعلام: ' . mysqli_error($conn)]);
}
?>






