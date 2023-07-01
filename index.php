<?php
require_once('PeriodicTable.php');
require_once('CodeInfo.php');
$periodic_table = new PeriodicTable(CodeInfo::ELEMENTS_FILE);
$elms = $periodic_table->shapingElements();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>周期表</title>
</head>
<body>
    <h1>PERIODIC TABLE</h1>
    <table>
        <?php foreach ($elms["table1"] as $elm) : ?>
            <?php if ($col === 0) : ?>
                <tr>
            <?php endif; ?>

            <?php if ($col === 18) : ?>
                </tr>
                <?php $col = 0; ?>
            <?php endif; ?>

            <td style="border:1px solid #000;"><?php echo $elm; ?></td>
            <?php $col++; ?>
        <?php endforeach; ?>
    </table>
    <table>
        <?php foreach ($elms["table2"] as $val) : ?>
            <tr>
                <?php foreach ($val as $elm) : ?>
                    <td style="border:1px solid #000;"><?php echo $elm; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>