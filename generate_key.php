<?php
    $private_key = openssl_pkey_new();
    $public_key_pem = openssl_pkey_get_details($private_key)['key'];
    echo $public_key_pem;
    $public_key = openssl_pkey_get_public($public_key_pem);

    // ------------------------------------------------------------

    // Generate key pair
    $keyPair = openssl_pkey_new(array(
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ));

    // Get private key
    openssl_pkey_export($keyPair, $privateKey);

    // Get public key
    $publicKeyDetails = openssl_pkey_get_details($keyPair);
    $publicKey = $publicKeyDetails['key'];

    // Encryption using public key
    $plaintext = 'Hello, World!';
    openssl_public_encrypt($plaintext, $encrypted, $publicKey);

    // Decryption using private key
    openssl_private_decrypt($encrypted, $decrypted, $privateKey);

    echo "Original: $plaintext\n";
    echo "Encrypted: " . base64_encode($encrypted) . "\n";
    echo "Decrypted: $decrypted\n";
?>