<?php
class Util{
  //XSS対策のためのHTMLエスケープ
  public static function es($data,$charset = "UTF-8"){
    //$dataが配列の時
    if(is_array($data)){
      //再帰呼び出し
      $ret = [];
      foreach($data as $key => $value){
        $ret[$key] = self::es($value,$charset);
      }
      return $ret;
//      $charsetArray = [$charset];
//      return array_map(__METHOD__,$data,$charsetArray);
    }else {
      //HTMLエスケープを行う
      return htmlspecialchars($data,ENT_QUOTES,$charset);
    }
  }
  //配列の文字エンコードのチェックを行う
  public static function cken(array $data){
    $result = true;
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        //含まれている値が配列の時文字列に連結する
        $value = implode("",$value);
      }
      if(!mb_check_encoding($value)){
        //文字エンコードが一致しない時
        $result = false;
        //foreachでの走査をブレイクする
        break;
      }
    }
    return $result;
  }
}
