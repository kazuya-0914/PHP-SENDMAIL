<?php
// 外部PHPファイルの呼び出し
require 'header.php'; // ヘッダー
require 'form_data.php'; // フォームデータ
require 'components.php'; // 部品

// エラーメッセージ
$errors = $form_data->errors;
/* --- ここからHTML --- */
// ヘッダー
header_html();

// フォーム部品
$components->form($errors);

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>