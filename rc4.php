<?php
    function rc4_initialize($key_rc4) {
        $s = range(0, 255);
        $j = 0;
        $keyLength = strlen($key_rc4);
    
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($key_rc4[$i % $keyLength])) % 256;
            list($s[$i], $s[$j]) = array($s[$j], $s[$i]);
        }
    
        return implode(',', $s);
    }
    
    function rc4_encrypt($plaintext, $s) {
        $s = explode(',', $s);
        $ciphertext = '';
        $i = 0;
        $j = 0;
    
        for ($k = 0; $k < strlen($plaintext); $k++) {
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;
            list($s[$i], $s[$j]) = array($s[$j], $s[$i]);
            $cipherByte = ord($plaintext[$k]) ^ $s[($s[$i] + $s[$j]) % 256];
            $ciphertext .= chr($cipherByte);
        }
    
        return $ciphertext;
    }
    
    function rc4_decrypt($ciphertext, $s) {
        return rc4_encrypt($ciphertext, $s);
    }
?>