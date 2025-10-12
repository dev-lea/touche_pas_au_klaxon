<?php
namespace App\Core;
final class Flash {
  public static function set(string $type, string $msg): void { $_SESSION['flash'][]=['type'=>$type,'msg'=>$msg]; }
  public static function get(): array { $f=$_SESSION['flash']??[]; unset($_SESSION['flash']); return $f; }
}
