<?php
include "phone.php";
session_start();

if (!isset($_SESSION['phones']) || empty($_SESSION['phones'])) {
    echo "ไม่มีข้อมูลโทรศัพท์ในระบบ";
    exit;
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงรายการโทรศัพท์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            font-size: 40px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 50px;
        }

        .phone-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 950px;
            margin: 0 auto;
        }

        .phone-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .phone-item img {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .phone-item h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .phone-item p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .phone-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }

        .phone-item .details-popup {
            display: none;
            position: absolute;
            top: 10px;
            left: 10px;
            width: 250px;
            height: 250px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            text-align: left;
        }

        .phone-item:hover .details-popup {
            display: block;
        }

        .phone-item.selected {
            background-color: #f0f8ff;
            border-color: #007bff;
        }

        .phone-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .phone-link:hover {
            color: inherit;
        }

        #compareButton {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            border: none;
        }

        #compareButton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Mobile Shop</h1>
    <div style="text-align: right; margin-bottom: 20px;">
        <button id="compareButton">เปรียบเทียบ</button>
    </div>
    <div class="phone-list">
        <?php foreach ($_SESSION['phones'] as $phone): ?>
            <div class="phone-item" data-id="<?= $phone->id ?>">
                <a href="detail.php?id=<?= $phone->id ?>" class="phone-link">
                    <img src="<?= htmlspecialchars($phone->image) ?>" alt="<?= htmlspecialchars($phone->model) ?>">
                    <h3><?= htmlspecialchars($phone->model) ?></h3>
                    <p>ราคา: <?= htmlspecialchars($phone->price) ?> บาท</p>
                    <div class="details-popup">
                        <p>รุ่น: <?= htmlspecialchars($phone->model) ?></p>
                        <p>CPU: <?= htmlspecialchars($phone->cpu) ?></p>
                        <p>RAM: <?= htmlspecialchars($phone->ram) ?></p>
                        <p>หน้าจอ: <?= htmlspecialchars($phone->screen) ?></p>
                        <p>ราคา: <?= htmlspecialchars($phone->price) ?> บาท</p>
                    </div>
                </a>
                <label>
                    <input type="checkbox" class="select-phone" />
                    เลือกเพื่อเปรียบเทียบ
                </label>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

    

    <script>
    let selectedCount = 0;
    const checkboxes = document.querySelectorAll('.select-phone');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const parent = this.closest('.phone-item');
            if (this.checked) {
                if (selectedCount >= 3) {
                    this.checked = false;
                    alert('เลือกได้ไม่เกิน 3 รายการ'); 
                    return;
                }
                parent.classList.add('selected');
                selectedCount++;
            } else {
                parent.classList.remove('selected');
                selectedCount--;
            }
        });
    });

    
    document.getElementById("compareButton").addEventListener("click", function() {
        if (selectedCount === 1) {
            alert("กรุณาเลือกโทรศัพท์อย่างน้อย 2 เครื่องเพื่อเปรียบเทียบ");
            return;
        }

        const selectedPhones = [];
        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const phoneItem = checkbox.closest('.phone-item');
                const phoneId = phoneItem.dataset.id;
                selectedPhones.push(phoneId);
            }
        });

        
        window.location.href = "compare.php?phones=" + selectedPhones.join(",");
    });
</script>


</body>

</html>