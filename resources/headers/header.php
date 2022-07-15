<?php

if ($_SESSION['logged-in'] == 'true') {
  echo '';
} else {
  echo '<script>window.location.href = "../../../../../login";</script>';
}

function getString($length = 12)
{
  return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function clear($inp)
{
  if (is_array($inp))
    return array_map(__METHOD__, $inp);

  if (!empty($inp) && is_string($inp)) {
    return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
  }

  return $inp;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <noscript>
    <meta http-equiv="refresh" content="0; url=../../../../../page?a=js" />
  </noscript>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4962881017613723" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <meta name="google-site-verification" content="p6Z7ZfPlKeBYYYrRpu-xFjRlQsnCkLNNyVLF9IERuU" />
  <meta name="description" content="Eglo Cloud, free storage, funded by ads." />
  <meta name="google" content="nositelinkssearchbox" />
  <meta charset="utf-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Phonix</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="../../../../../resources/favicon.png" />
  <link href="../../../../../resources/styles/1.css" rel="stylesheet" />
</head>