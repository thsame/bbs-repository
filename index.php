  <?php
    include 'BBS.class.php';

    session_start();
    $rows = BBSClass::fileOpen();

   ?>
  <?php
  include 'index.tpl.php';
  ?>
    <section>
      <form  method="post" action="">
        <p>名前<input type="text" name="name" value=""></p>
        <p>本文<textarea name = "text" rows = "4"cols = "30" ></textarea></p>
        <button type="submit">投稿</button>
        <input type="hidden" name="token" value="<?=BBSclass::h(sha1(session_id())) ?>">
      </form>
    </section>
    <section>
      <h2>投稿一覧</h2>
      <?php if (!empty($rows)): ?>
          <ul>
      <?php foreach ($rows as $row): ?>
              <li><?= BBSclass::h($row[1]) ?> (<?= BBSClass::h($row[0]) ?>)</li>
      <?php endforeach; ?>
          </ul>
      <?php else: ?>
          <p>投稿はまだありません</p>
      <?php endif; ?>
    </section>
  </body>
</html>
