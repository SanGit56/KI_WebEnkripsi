<?php
    require_once('phpseclib/Crypt/RSA.php');
    require_once('phpseclib/Math/BigInteger.php');
    require_once('phpseclib/Crypt/Hash.php');
    require_once('phpseclib/Crypt/Random.php');
    use phpseclib\Crypt\RSA;

// import pubkey dari user di db
$san = 'kbKudmOUJD4R4EhqfiMNP5i8SHe7jy1uIAEKMomfftlnTijmY8+m5q2hjevwGn9/SH4K9o89ESSA/xMRltJ3hSl9vKrZuNvAIJmpH0SO3L6HCL58KT5y/+wMeBEdx4AtpAV5hvPd/mU+PZvEvSv8zpoLYvxaea5NANxp9gLUBa8=';
$pubkey = $san;//hasil ambil dari db
$rsa = new RSA();
$rsa->loadKey($pubkey);
$file = file_get_contents('Cheatsheett.pdf');
$blocks = explode('\n====BEGIN_SIGNATURE====\n',"Cheatsheett.pdf");
$originalfile = $blocks[0];
$signaturePart = $blocks[1];
$fileHash = trim(hash('sha256',$originalfile),"\n");
$signatureHash = $rsa->decrypt(base64_decode($signaturePart));
if(strcmp($signatureHash, $fileHash) == 0){
    return [
        "hash" => $fileHash,
        "status" => "true",
    ];
}else{
    return ["status"=>"false"];
}
