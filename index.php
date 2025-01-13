<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerala Lottery Checker</title>
</head>
<body>

    <h2>Enter Lottery Ticket Number and Select Type</h2>
    <form action="process.php" method="POST">
        <label for="ticketNumber">Ticket Number:</label>
        <input type="text" id="ticketNumber" name="ticketNumber" required><br><br>

        <label for="lotteryType">Lottery Type:</label>
        <select id="lotteryType" name="lotteryType">
            <?php
            // Fetch last 10 lottery types using a Python script (or directly with PHP)
            $lotteryTypes = json_decode(file_get_contents("lottery_types.json"), true);
            foreach($lotteryTypes as $lottery) {
                echo "<option value='{$lottery['name']}'>{$lottery['name']}</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Check Result">
    </form>

</body>
</html>
