<?php
$a = [
    [
        'IdSizePro' => 1,
        'IdProduct' => 1,
        'IdSize' => 1,
        'Price' => 2222
    ],

    [
        'IdSizePro' => 2,
        'IdProduct' => 1,
        'IdSize' => 2,
        'Price' => 1000
    ],

    [
        'IdSizePro' => 3,
        'IdProduct' => 3,
        'IdSize' => 3,
        'Price' => 500
    ],

    [
        'IdSizePro' => 4,
        'IdProduct' => 4,
        'IdSize' => 4,
        'Price' => 8000
    ]
]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Giá : <span id="displayPrice"></span></p>
    <select name="chonSize" id="selectSize">
        <?php foreach($a as $i) {?>
            <option value="<?= $i['IdSize']?>" data-price="<?= $i['Price']?>">
            <?= $i['IdSize']?>
            </option>
        <?php } ?>
    </select>

    <script>
        // Chọn giá trị mặc định là giá trị của option đầu tiên
        var defaultPrice = <?= reset($a)['Price'] ?>;
        document.getElementById('displayPrice').innerText = defaultPrice;

        // Xử lý sự kiện khi thay đổi option
        document.getElementById('selectSize').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            document.getElementById('displayPrice').innerText = price;
        });
    </script>
</body>
</html>
