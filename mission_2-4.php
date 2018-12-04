!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
        <?php
                $filename = "mission_2-1_yourname.txt";
                $lines = file($filename);
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $delete_target = $_POST['delete_target'];
                $edit_target = $_POST['edit_target'];
                $editting_target = $_POST['editting_target'];

                if (!empty($edit_target)) {
                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($edit_target == $data[0]) {
                                        $old_name = $data[1];
                                        $old_comment = $data[2];
                                }
                        }
                }

        ?>
         <form action="mission_2-4.php" method="post">
                <input type="text" name="name" placeholder="名前" value="<?= $old_name; ?>">
                <input type="text" name="comment" placeholder="コメント" value="<?= $old_comment; ?>">
                <input type="hidden" name="editting_target" value="<?= $edit_target; ?>">
                <input type="submit" value="送信する">
                <input type="text" name="delete_target" placeholder="削除番号
">
                <input type="submit" value="削除する">
                <input type="text" name="edit_target" placeholder="編集番号">
                <input type="submit" value="編集する">
        </form>
        <?php

                # 新規投稿処理
                if (!empty($name) && !empty($comment) && empty($editing_target)) {
                        if (file_exists($filename)) {
                                $count = count($lines) + 1;
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
                        $fp = fopen($filename, 'w');

                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($delete_target != $data[0]) {
                                        fwrite($fp, $line);
                                }
                        }

                        fclose($fp);
                }

                # 編集処理
                if (!empty($name) && !empty($comment) && !empty($editting_target)) {
                        $fp = fopen($filename, 'w');

                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($editting_target != $data[0]) {
                                        fwrite($fp, $line);
                                } else {
                                        $date = date("Y/m/d H:i:s");
                                        $new_line = "{$date[0]}<>$name<>$comment<>$date\n";
                                        fwrite($fp, $new_line);
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

        