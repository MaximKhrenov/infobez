<?php
$pass = crypt('PHP is my secret love.', 'max');
echo "DES-шифрование : " .$pass;
echo "<br> Хеширование: " . md5('PHP is my secret love.');

$config = array(
"private_key_type"=>OPENSSL_KEYTYPE_RSA,
"private_key_bits"=>512
);
$res = openssl_pkey_new($config);
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = openssl_random_pseudo_bytes($ivlen);
echo '<br>Ассиметричное шифрование: '.openssl_encrypt('MyPassword', 'aes-192-ofb', $res,$options=OPENSSL_RAW_DATA, $iv);


$pub = <<<SOMEDATA777
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mq
aH9/GnWjGavZM02fos4lc2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQ==
-----END PUBLIC KEY-----
SOMEDATA777;
$data = "PHP is my secret love.";
$pk  = openssl_get_publickey($pub);
openssl_public_encrypt($data, $encrypted, $pk);
echo '<br>Цифровая подпись: '.chunk_split(base64_encode($encrypted));

//Decode
$key = <<<SOMEDATA777
-----BEGIN RSA PRIVATE KEY-----
MIIBPQIBAAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mqaH9/GnWjGavZM02fos4l
c2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQJBAKn6O+tFFDt4MtBsNcDz
GDsYDjQbCubNW+yvKbn4PJ0UZoEebwmvH1ouKaUuacJcsiQkKzTHleu4krYGUGO1
mEECIQD0dUhj71vb1rN1pmTOhQOGB9GN1mygcxaIFOWW8znLRwIhAMNqlfLijUs6
rY+h1pJa/3Fh1HTSOCCCCWA0NRFnMANhAiEAwddKGqxPO6goz26s2rHQlHQYr47K
vgPkZu2jDCo7trsCIQC/PSfRsnSkEqCX18GtKPCjfSH10WSsK5YRWAY3KcyLAQIh
AL70wdUu5jMm2ex5cZGkZLRB50yE6rBiHCd5W1WdTFoe
-----END RSA PRIVATE KEY-----
SOMEDATA777;
$data = "JutBa0GLHzGrlygxwWr66cizw4W4za+DbzZweNM0iloCD7xEP9LclL013lcksJL5XhjW44U+oxpq cX1ZSLhWuA==";
$pk  = openssl_get_privatekey($key);
openssl_private_decrypt(base64_decode($data), $out, $pk);
echo '<br>DECODE : ' . $out;
