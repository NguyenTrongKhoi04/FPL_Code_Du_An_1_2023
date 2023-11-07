<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $a=[2,1];
    ?>



    <input type="checkbox" name="checkbox[]" value="2" id="checkbox2" <?php echo (in_array(2, $a) ? "checked disabled" : ""); ?>>
    <label for="checkbox2">Checkbox 2</label>

    <input type="checkbox" name="checkbox[]" value="3" id="checkbox3" <?php echo (in_array(3, $a) ? "checked disabled" : ""); ?>>
    <label for="checkbox3">Checkbox 3</label>

    <input type="checkbox" name="checkbox[]" value="4" id="checkbox4" <?php echo (in_array(4, $a) ? "checked disabled" : ""); ?>>
    <label for="checkbox4">Checkbox 4</label>
</body>
</html>
