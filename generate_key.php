<?php
    require_once('phpseclib/Crypt/RSA.php');
    require_once('phpseclib/Math/BigInteger.php');
    require_once('phpseclib/Crypt/Hash.php');
    require_once('phpseclib/Crypt/Random.php');
    use phpseclib\Crypt\RSA;
    $rsa = new RSA();
    $pair = $rsa->createKey();
    $private_key = $pair['privatekey'];
    $public_key = $pair['publickey'];

    $plaintext = 'admin';
    $rsa->loadKey($private_key);
    $enc = base64_encode($rsa->encrypt($plaintext));
    echo $enc;
    echo "\n";
    $rsa->loadKey($public_key);
    $dec = $rsa->decrypt(base64_decode($enc));
    echo $dec;
    ?>
