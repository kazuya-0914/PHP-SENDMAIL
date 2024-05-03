<?php

class Components{
  private $name;
  private $email;
  private $message;

  // セッションがあれば変数に格納
  public function __construct() {
    $this->name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $this->email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $this->message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
  }

  // フォームHTML
  public function form($errors) {
    // エラーチェック
    $error_name = isset($errors['name']) ? $errors['name'] : '' ;
    $error_email = isset($errors['email']) ? $errors['email'] : '' ;
    $error_message = isset($errors['message']) ? $errors['message'] : '' ;
    
echo <<< EOM
  <main class="container m-auto mt-4">
    <section>
      <h3>お問い合わせ</h3>
      <p class="text-danger">※ 全て必須入力です</p>
      <form action="confirm.php" method="post" class="p-4 border border-primary">

        <label class="mb-1" class="form-label">お名前</label>
        <span class="ps-4 text-danger">{$error_name}</span>
        <input type="text" name="user_name" value="{$this->name}" class="mb-4 form-control" placeholder="山田 太郎">
        
        <label class="mb-1" class="form-label">メールアドレス</label>
        <span class="ps-4 text-danger">{$error_email}</span>
        <input type="email" name="email" value="{$this->email}" class="mb-4 form-control" placeholder="yamada@taro.com">
        
        <label class="mb-1" class="form-label">お問い合わせ内容(100文字以内)</label>
        <span class="ps-4 text-danger">{$error_message}</span>
        <textarea name="message" class="form-control" placeholder="お問い合わせ内容を入力してください">{$this->message}</textarea>
        
        <div class="mt-4 text-center">
          <button type="submit" name="submit" value="確認する" class="me-4 btn btn-primary">確認する</button>
          <button type="reset" class="btn btn-primary">リセット</button>
        </div>
      </form>
    </section>
  </main>
EOM;

  }

  public function confirm($session) {

echo <<< EOM
  <main class="container m-auto mt-4">
    <section>
      <h3>入力内容をご確認ください</h3>
      <p>問題なければ「送信する」、修正する場合は「キャンセル」をクリックしてください</p>
      <form action="complete.php" method="post" class="p-4 m-auto border border-primary">
        <input type="hidden" name="token" value="{$session['token']}">
        <div class="mb-4">
          <label class="me-4 p-2 border-bottom border-secondary">お名前</label>
          <span class="p-2 border-bottom border-info">{$session['name']}</span>
        </div>

        <div class="mb-4">
          <label class="me-4 p-2 border-bottom border-secondary">メールアドレス</label>
          <span class="p-2 border-bottom border-info">{$session['email']}</span>
        </div>

        <div>
          <label class="mb-1">お問い合わせ内容</label>
          <div class="p-2 border border-info">{$session['message']}</div>
        </div>
        
        <div class="text-center">
          <button type="submit" name="submit" value="送信する" class="mt-4 btn btn-primary">送信する</button>
          <button id="btn-back" class="mt-4 btn btn-primary">キャンセル</button>
        </div>
      </form>
    </section>
  </main>
EOM;

  }
}
$components = new Components();