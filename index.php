<?php
// 全エラー表示
ini_set( 'display_errors', 1 );
// セッションを開始
session_start();

// 外部PHPファイルの呼び出し
require 'header.php'; // ヘッダー
require 'form_data.php'; // フォームデータ

// エラーメッセージ
class ErrorMsg {
  public $err_name;
  public $err_email;
  public $err_msg;

  public function __construct() {
    $this->err_name = isset($_SESSION['err_name']) ? $_SESSION['err_name'] : '' ;
    $this->err_email = isset($_SESSION['err_email']) ? $_SESSION['err_email'] : '' ;
    $this->err_msg = isset($_SESSION['err_msg']) ? $_SESSION['err_msg'] : '' ;
  }
}
$error_msg = new ErrorMsg();

/* --- ここからHTML --- */
// ヘッダー
header_html();

?>
<!-- フォーム -->
<main class="container m-auto mt-4">
  <section>
    <h3><a href="./">お問い合わせ</a></h3>
    <p class="text-danger">※ 全て必須入力です</p>
    <form action="confirm.php" method="post" class="p-4 border border-primary">

      <label class="mb-1" class="form-label">お名前</label>
      <span class="ps-4 text-danger"><?php echo $error_msg->err_name; ?></span>
      <input type="text" name="user_name" value="<?php echo $_SESSION['name']; ?>" class="mb-4 form-control" placeholder="山田 太郎">
    
      <label class="mb-1" class="form-label">メールアドレス</label>
      <span class="ps-4 text-danger"><?php echo $error_msg->err_email; ?></span>
      <input type="email" name="email" value="<?php echo $_SESSION['email'] ; ?>" class="mb-4 form-control" placeholder="yamada@taro.com">
    
      <label class="mb-1" class="form-label">お問い合わせ内容(100文字以内)</label>
      <span class="ps-4 text-danger"><?php echo $error_msg->err_msg; ?></span>
      <textarea name="message" class="form-control" placeholder="お問い合わせ内容を入力してください"><?php $_SESSION['message']; ?></textarea>
    
      <div class="mt-4 text-center">
        <button type="submit" name="submit" value="確認する" class="me-4 btn btn-primary">確認する</button>
        <button type="reset" class="btn btn-primary">リセット</button>
      </div>
    </form>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php
// エラーメッセージがあれば初期化
if(!empty($_SESSION)) {
  // セッション変数を初期化
  $_SESSION = array();
  // セッションを終了
  session_destroy();
}
?>