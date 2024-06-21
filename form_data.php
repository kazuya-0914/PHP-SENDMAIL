<?php
// 全エラー表示
ini_set( 'display_errors', 1 );

// フォームデータ
class FormData {
  public $user_name;
  public $email;
  public $message;
  public $submit;

  // フォームデータがあればセッションに格納
  public function __construct() {
    $this->user_name = isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : '' ;
    $this->email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ;
    $this->message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ;
    // 不正アクセスチェック
    $this->submit = isset($_POST['submit']) ? htmlspecialchars($_POST['submit']) : '' ;

    if ($this->submit) {
      $_SESSION['name'] = !empty($this->user_name) ? $this->user_name : '';
      $_SESSION['email'] = !empty($this->email) ? $this->email : '';
      $_SESSION['message'] = !empty($this->message) ? $this->message : '';
    } else {
      $_SESSION['name'] = !empty($_SESSION['name']) ? $_SESSION['name'] : '';
      $_SESSION['email'] = !empty($_SESSION['email']) ? $_SESSION['email'] : '';
      $_SESSION['message'] = !empty($_SESSION['message']) ? $_SESSION['message'] : '';
    }
  }

  // バリデーション（エラーメッセージをセッションに格納）
  public function validation() {
     // お名前のバリデーション
    if (empty($this->user_name)) {
      $_SESSION['err_name'] = '※ お名前が入力されていません';
    } else {
      $_SESSION['err_name'] = '';
    }

    // メールアドレスのバリデーション
    if (empty($this->email) ) {
      $_SESSION['err_email'] = '※ メールアドレスが入力されていません';
    } elseif (!filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
      $_SESSION['err_email'] = '※ メールアドレスの入力形式が正しくありません。';
    } else {
      $_SESSION['err_email'] = '';
    }

    // お問い合わせ内容のバリデーション
    if (empty($this->message) ) {
      $_SESSION['err_msg'] = '※ お問い合わせ内容が入力されていません';
    } elseif (mb_strlen($this->message) > 100) {
      $_SESSION['err_msg'] = '※ お問い合わせ内容が100文字を超えています。';
    } else {
      $_SESSION['err_msg'] = '';
    }
  }
}
$form_data = new FormData();