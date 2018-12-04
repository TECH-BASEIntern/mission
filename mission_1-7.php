<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
        <?php
                $filename = "mission_1-6_yourname.txt";
                $lines = file($filename, FILE_IGNORE_NEW_LINES);

                foreach($lines as $line) {
                        echo htmlspecialchars($line, ENT_QUOTES, "UTF-8") . nl2br("\n");
                }
        ?>
</body>
</html>