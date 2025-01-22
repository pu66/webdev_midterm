<?php
include "phone.php";
session_start();

if (!isset($_GET['phones'])) {
    echo "ไม่มีการเลือกโทรศัพท์เพื่อเปรียบเทียบ";
    exit;
}

$selectedPhoneIds = explode(",", $_GET['phones']);
$selectedPhones = [];

foreach ($_SESSION['phones'] as $phone) {
    if (in_array($phone->id, $selectedPhoneIds)) {
        $selectedPhones[] = $phone;
    }
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปรียบเทียบโทรศัพท์</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Big Shoulders Display', cursive;
            background-color: #f9f9f9;
            color: #000;
            /* ตั้งสีข้อความเป็นสีดำ */
        }

        h1 {
            font-size: 40px;
            font-weight: 700;
            text-align: left;
            margin-bottom: 10px;
        }

        .compare-info {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: left;
        }

        .compare-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* แสดง 3 คอลัมน์ */
            gap: 20px;
            margin: 0 auto;
            max-width: 1200px;
            /* ขยายพื้นที่คอลัมน์ */
        }

        .compare-item {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            /* ข้อความทั้งหมดชิดซ้าย */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .compare-item img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .compare-item h3 {
            font-size: 20px;
            margin: 10px 0;
            color: #000;
            /* สีข้อความดำ */
        }

        .compare-item p {
            font-size: 16px;
            color: #000;
            /* สีข้อความดำ */
            margin: 5px 0;
        }

        .compare-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }

        .phone-detail p {
            display: flex;
        }

        .phone-detail p::before {
            content: attr(data-label);
            width: 100px;
            /* ความกว้างคงที่สำหรับหัวข้อ */
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <h1>เปรียบเทียบโทรศัพท์</h1>
    <div class="compare-info">
        จำนวนมือถือนำมาเปรียบเทียบ <?= count($selectedPhones) ?> เครื่อง
    </div>
    <div class="compare-list">
        <?php foreach ($selectedPhones as $phone): ?>
            <div class="compare-item">
                <div class="phone-detail">
                    <img src="<?= htmlspecialchars($phone->image) ?>" alt="<?= htmlspecialchars($phone->model) ?>">
                    <h3><?= htmlspecialchars($phone->model) ?></h3>
                    <p data-label="CPU:"><?= htmlspecialchars($phone->cpu) ?></p>
                    <p data-label="RAM:"><?= htmlspecialchars($phone->ram) ?></p>
                    <p data-label="หน้าจอ:"><?= htmlspecialchars($phone->screen) ?></p>
                    <p data-label="ราคา:"><?= htmlspecialchars($phone->price) ?> บาท</p>
                    <p data-label="กล้อง:"><?= htmlspecialchars($phone->camera) ?></p>
                    <p data-label="ขนาด:"><?= htmlspecialchars($phone->size) ?></p>
                    <p data-label="แบตเตอรี่:"><?= htmlspecialchars($phone->battery) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
</body>

</html>