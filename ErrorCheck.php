<?php
class ErrorCheck{
  //エラー内容格納
  public $errors = array(
    "name" => "",
    "tel" => "",
    "staff" => "",
    "address" => "",
    "pass" => ""
  );

  //エラーチェック
  public static function validation($data,$type){
     $errors;
    if(!isset($data['name']) || ($data['name']=="")){
      $errors['name'] = "名前を入力してください";
    }
    if(!isset($data['tel']) || ($data['tel']=="")){
      $errors['tel'] = "電話番号を入力してください";
    }
    if(!preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,5}$/",$data['tel'])){
        $errors['tel'] = "電話番号の形式で入力してください";
    }
    if($type == "company"){
      if(!isset($data['staff']) || ($data['staff']=="")){
        $errors['staff'] = "担当者氏名を入力してください";
      }
    }
    if(!isset($data['address']) || ($data['address']=="")){
      $errors['address'] = "メールアドレスを入力してください。";
    }
    if(!filter_var($data['address'],FILTER_VALIDATE_EMAIL)){
        $errors['address'] = "メールアドレスの形式で入力してください";
    }
    if(!isset($data['pass']) || ($data['pass']=="")){
      $errors['pass'] = "パスワードを入力してください。";
    }
    if(!preg_match("/^[A-Za-z0-9]{6,12}$/", $data['pass'])){
        $errors['pass'] = "パスワードは半角英数で6文字以上12文字以内で入力してください";
    }

    if(isset($errors)){
      return $errors;
    }
    else {
      $errors=NULL;
      return $errors;
    }
  }//function
}
 ?>
