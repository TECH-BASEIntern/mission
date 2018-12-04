<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
        <form action="mission_2-1.php" method="post">
                <input type="text" name="name" placeholder="名前">
                <input type="text" name="comment" placeholder="コメント">
                <input type="submit" value="送信する">
        </form>
        <?php
                $filename = "mission_2-1_yourname.txt";
                $name = $_POST['name'];
                $comment = $_POST['comment'];

                # 新規投稿処理
                if (!empty($name) && !empty($comment)) {
                        if (file_exists($filename)) {
                                $count = count(file($filename)) + 1;
                        } else {
                                $count = 1;
                        }
                        $date = date("Y/m/d H:i:s");
                        $line = "$count<>$name<>$comment<>$date\n";

                        $fp = fopen($filename, 'a');
                        fwrite($fp, $line);
                        fclose($fp);
                }
        ?>
</body>
</html>