  <?php

    function h($str) {
      return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    $name = (string)filter_input(INPUT_POST, 'name'); // $_POST['name']
    $text = (string)filter_input(INPUT_POST, 'text'); // $_POST['text']
    $fp = fopen('data.csv','a+b');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      flock($fp, LOCK_EX); // 排他ロックを行う
      fputcsv($fp,[$name,$text]);
      rewind($fp);
    }
    while($row = fgetcsv($fp)){
      $rows[] = $row;
    }
    flock($fp, LOCK_UN); // ロック解除
    fclose($fp);
   ?>
  <?php
  include 'index.tpl.php';
  ?>
    <section>
      <form  method="post" action="">
        <p>名前<input type="text" name="name" value=""></p>
        <p>本文<textarea name = "text" rows = "4"cols = "30" ></textarea></p>
        <button type="submit">投稿</button>
      </form>
    </section>
    <section>
      <h2>投稿一覧</h2>
      <?php if (!empty($rows)): ?>
          <ul>
      <?php foreach ($rows as $row): ?>
              <li><?=h($row[1])?> (<?=h($row[0])?>)</li>
      <?php endforeach; ?>
          </ul>
      <?php else: ?>
          <p>投稿はまだありません</p>
      <?php endif; ?>
    </section>
  </body>
</html>
