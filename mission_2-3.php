!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
        <form action="mission_2-3.php" method="post">
                <input type="text" name="name" placeholder="名前">
                <input type="text" name="comment" placeholder="コメント">
                <input type="submit" value="送信する">
                <input type="text" name="delete_target" placeholder="削除番号
">
                <input type="submit" value="削除する">
        </form>
        <?php
                $filename = "mission_2-1_yourname.txt";
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $delete_target = $_POST['delete_target'];

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

                # 削除処理
                if (!empty($delete_target)) {
                        $lines = file($filename);
                        $fp = fopen($filename, 'w');

                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($delete_target != $data[0]) {
                                        fwrite($fp, $line);
                                }
                        }

                        fclose($fp);
                }
                
                # 表示処理
                $lines = file($filename, FILE_IGNORE_NEW_LINES);

                foreach($lines as $line) {
                        $record = explode("<>", $line);
                        echo "投稿番号: " . $record[0];
                        echo " 名前: " . $record[1];
                        echo " コメント: " . $record[2];
                        echo " 投稿日時: " . $record[3];
                        echo nl2br("\n");
                }
        ?>
</body>
</html>
