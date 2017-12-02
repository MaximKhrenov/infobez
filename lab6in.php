<?php
$password = crypt('MyPassword', 'max'); 
echo "DES " .$password;
echo "<br> ХЕШ " . md5('MyPassword');
$privkey = openssl_pkey_new(array(
"private_key_bits" => 2048,
"private_key_type" => OPENSSL_KEYTYPE_RSA,));
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = openssl_random_pseudo_bytes($ivlen);
echo '<br>Ассиметричное шифрование: '.openssl_encrypt('MyPassword', 'aes-192-ofb', $privkey,$options=OPENSSL_RAW_DATA, $iv);


$pub = <<<SOMEDATA777
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mq
aH9/GnWjGavZM02fos4lc2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQ==
-----END PUBLIC KEY-----
SOMEDATA777;
$data = "MyPassword";
$pk  = openssl_get_publickey($pub);
openssl_public_encrypt($data, $encrypted, $pk);
echo '<br>Цифровая подпись: '.chunk_split(base64_encode($encrypted));
?>