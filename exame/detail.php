<?php
include "phone.php";
session_start();


if (!isset($_SESSION['phones']) || empty($_SESSION['phones'])) {
    echo "ไม่มีข้อมูลโทรศัพท์ในระบบ";
    exit;
}


if (!isset($_GET['id'])) {
    echo "ไม่พบข้อมูลโทรศัพท์ที่เลือก";
    exit;
}

$phoneId = $_GET['id'];
$selectedPhone = null;

foreach ($_SESSION['phones'] as $phone) {
    if ($phone->id == $phoneId) {
        $selectedPhone = $phone;
        break;
    }
}

if (!$selectedPhone) {
    echo "ไม่พบข้อมูลโทรศัพท์ที่เลือก";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดโทรศัพท์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        .phone-detail {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .phone-detail img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: contain;
            margin-bottom: 20px;
        }
        .phone-detail h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .phone-detail p {
            font-size: 18px;
            margin: 8px 0;
            color: #333;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
        .phone-detail p {
    display: flex;
}

.phone-detail p::before {
    content: attr(data-label);
    width: 100px;
    flex-shrink: 0;
}
        
    </style>
</head>
<body>

<div class="phone-detail">
    <img src="<?= htmlspecialchars($selectedPhone->image) ?>" alt="<?= htmlspecialchars($selectedPhone->model) ?>">
    <h1>รุ่น: <?= htmlspecialchars($selectedPhone->model) ?></h1>
    <p data-label="CPU:"><?= htmlspecialchars($phone->cpu) ?></p>
    <p data-label="RAM:"><?= htmlspecialchars($phone->ram) ?></p>
    <p data-label="หน้าจอ:"><?= htmlspecialchars($phone->screen) ?></p>
    <p data-label="ราคา:"><?= htmlspecialchars($phone->price) ?> บาท</p>
    <p data-label="กล้อง:"><?= htmlspecialchars($phone->camera) ?></p>
    <p data-label="ขนาด:"><?= htmlspecialchars($phone->size) ?></p>
    <p data-label="แบตเตอรี่:"><?= htmlspecialchars($phone->battery) ?></p>
    <a href="index.php" class="back-btn">ย้อนกลับ</a>
</div>

</body>
</html>
