<?php
class FormData {
  public $user_name;
  public $email;
  public $message;
  public $submit;
  public $errors;

  // フォームデータがあれば変数に格納
  public function __construct() {
    $this->user_name = isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : '' ;
    $this->email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ;
    $this->message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ;
    $this->submit = isset($_POST['submit']) ? htmlspecialchars($_POST['submit']) : '' ;
    $this->errors = [];
  }

  public function validation() {
     // お名前のバリデーション
    if (empty($this->user_name)) {
      $this->errors['name'] = '※ お名前が入力されていません';
    }

    // メールアドレスのバリデーション
    if (empty($this->email) ) {
      $this->errors['email'] = '※ メールアドレスが入力されていません';
    } elseif (!filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
      $this->errors['email'] = '※ メールアドレスの入力形式が正しくありません。';
    }

    // お問い合わせ内容のバリデーション
    if (empty($this->message) ) {
      $this->errors['message'] = '※ お問い合わせ内容が入力されていません';
    } elseif (mb_strlen($this->message) > 100) {
      $this->errors['message'] = '※ お問い合わせ内容が100文字を超えています。';
    }

    // 不正アクセスのバリデーション
    if (empty($this->submit) ) {
      $this->errors['submit'] = '※ 不正なアクセスです。';
    }

    return $this->errors;
  }
}
$form_data = new FormData();