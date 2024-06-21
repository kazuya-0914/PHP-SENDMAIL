<?php
// 全エラー表示
ini_set( 'display_errors', 1 );
// セッションを開始
session_start();

// 外部PHPファイルの呼び出し
require 'header.php'; // ヘッダー
require 'sendmail.php'; // メール送信

$submit = isset($_POST['submit']) ? htmlspecialchars($_POST['submit']) : '';
$token = isset($_POST['token']) ? $_POST['token'] : '';

header_html();
?>
  <main class="container m-auto mt-4">
    <section>
      <?php
        // 不正アクセスチェック（CSRF対策も含む）
        if (empty($submit) || $token !== $_SESSION['token']) {
          // 不正アクセスであれば
          echo "<p>※ 不正なアクセスです。</p>";
    
          // セッション変数を初期化
          $_SESSION = array();

          // セッションを終了
          session_destroy();
        } else {
          // メール送信実行
          echo $sendmail->sendmail();
        }
      ?>
      <div class="text-center">
        <button id="btn-back" class="mt-4 btn btn-primary">トップに戻る</button>
      </div>
    </section>
  </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>