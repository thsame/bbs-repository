  <?php
    $fp = fopen('data.csv','a+b');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

      fputcsv($fp,[$_POST['name'],$_POST['text']]);
      rewind($fp);
    }
    while($row = fgetcsv($fp)){
      $rows[] = $row;
    }
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
              <li><?=$row[1]?> (<?=$row[0]?>)</li>
      <?php endforeach; ?>
          </ul>
      <?php else: ?>
          <p>投稿はまだありません</p>
      <?php endif; ?>
    </section>
  </body>
</html>
