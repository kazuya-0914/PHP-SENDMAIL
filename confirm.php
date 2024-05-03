<?php
// セッションを開始
session_start();

// 外部PHPファイルの呼び出し
require 'header.php'; // ヘッダー
require 'form_data.php'; // フォームデータ
require 'components.php'; // 部品

/* --- ここからHTML --- */
// ヘッダー
header_html();

// バリデーション
$errors = $form_data->validation();

// エラーメッセージの有無確認
if (!empty($errors)) {
  // 不正アクセスチェック
  if (empty($errors['submit'])) {
    // フォーム部品
    $components->form($errors);
  } else {
    // 不正アクセスであれば
echo <<< EOM
  <p>{$errors['submit']}</p>
  <div class="text-center">
    <button id="btn-back" class="mt-4 btn btn-primary">トップに戻る</button>
  </div>
EOM;
    
    // セッション変数を初期化
    $_SESSION = array();

    // セッションを終了
    session_destroy();
  }
} else {
  // CSRF対策用トークン発行
  $token = bin2hex(random_bytes(32));

  // セッション発行
  $_SESSION['name'] = $form_data->user_name;
  $_SESSION['email'] = $form_data->email;
  $_SESSION['message'] = $form_data->message;
  $_SESSION['token'] = $token;

  // 確認画面
  $components->confirm($_SESSION);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>