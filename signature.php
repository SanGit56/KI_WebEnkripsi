<?php
    require_once('phpseclib/Crypt/RSA.php');
    require_once('phpseclib/Math/BigInteger.php');
    require_once('phpseclib/Crypt/Hash.php');
    require_once('phpseclib/Crypt/Random.php');
    use phpseclib\Crypt\RSA;

    //import private key user
    $privsan = 'lyInbg69+4sGDiu9wDKKO7lrKkj58PrsN8VdxY+174PzuWSap+C/q4DPMdWP7JMmaXxQ88J29SAzBDic7geNgZhbERAODdkbMpc8yyXhIxA2j6EiQgxTE3aMShsEnfwPTCWXtlSZQBYFyKrJrR63bLPPMMqvKlor0XJVC/RDdV8=';
    $privkey = $privsan;
    $todayDate = date('Y-m-d');
    $file = file_get_contents("Cheatsheet.pdf");
    $lastm = filemtime($file);
    $hash = hash('sha256', $file);
    $rsa = new RSA();
    $rsa->loadKey($privkey);
    $header="====BEGIN_SIGNATURE====\n";
    $signature = base64_encode($rsa->encrypt($hash));
    $isi="Issuer        : San \n
          Date          : $todayDate \n
          Last Modified : $lastm \n";
    file_put_contents("Cheatsheett.pdf",$file."\n".$header.$signature.$isi);
    
