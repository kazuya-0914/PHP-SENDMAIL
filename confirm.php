<?php
// 全エラー表示
ini_set( 'display_errors', 1 );
// セッションを開始
session_start();

// 外部PHPファイルの呼び出し
require 'header.php'; // ヘッダー
require 'form_data.php'; // フォームデータ

/* --- ここからHTML --- */
// ヘッダー
header_html();

// 送信ボタンを押した場合
if (!empty($form_data->submit)) {
  // バリデーション
  $form_data->validation();
} else {
  // 不正アクセスであれば
  echo <<< EOM
  <p>{$_SESSION['err_sub']}</p>
  <div class="text-center">
    <button id="btn-back" class="mt-4 btn btn-primary">トップに戻る</button>
  </div>
  EOM;

  // セッション変数を初期化
  $_SESSION = array();
  // セッションを終了
  session_destroy();
}

// エラーメッセージの有無確認
if (!empty($_SESSION['err_name'] || $_SESSION['err_email'] || $_SESSION['err_msg'])) {
  // エラーががあればトップページにリダイレクト
  header('Location: index.php');
} else {
  // CSRF対策用トークン発行
  $token = bin2hex(random_bytes(32));
  $_SESSION['token'] = $token;
}

/* --- ここからHTML --- */
?>
<?php if (!empty($form_data->submit)) : ?> 
  <main class="container m-auto mt-4">
    <section>
      <h3>入力内容をご確認ください</h3>
      <p>問題なければ「送信する」、修正する場合は「キャンセル」をクリックしてください</p>
      <form action="complete.php" method="post" class="p-4 m-auto border border-primary">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <div class="mb-4">
          <label class="me-4 p-2 border-bottom border-secondary">お名前</label>
          <span class="p-2 border-bottom border-info"><?php echo $_SESSION['name']; ?></span>
        </div>

        <div class="mb-4">
          <label class="me-4 p-2 border-bottom border-secondary">メールアドレス</label>
          <span class="p-2 border-bottom border-info"><?php echo $_SESSION['email']; ?></span>
        </div>

        <div>
          <label class="mb-1">お問い合わせ内容</label>
          <div class="p-2 border border-info"><?php echo $_SESSION['message']; ?></div>
        </div>
        
        <div class="text-center">
          <button type="submit" name="submit" value="送信する" class="mt-4 btn btn-primary">送信する</button>
          <button id="btn-back" class="mt-4 btn btn-primary">キャンセル</button>
        </div>
      </form>
    </section>
  </main>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>