<?php
/**
 * Created by PhpStorm.
 * User: chaishuai
 * Date: 2020/11/17
 * Time: 8:56
 */
class cryptRsa
{
    const DIGEST_ALG = 'sha512';
    const PRIVATE_KEY_BITS = 4096;
    const PRIVATE_KEY_TYPE = OPENSSL_KEYTYPE_RSA;
    
    protected $public_key = '';
    protected $private_key = '';
    protected $key_len = '';
    public function __construct($pub_key, $pri_key)
    {
        $this->public_key = $pub_key;
        $this->private_key = $pri_key;
    }
    
    //创建公钥密钥
    public static function createKeys()
    {
        $config = array(
            "digest_alg" => self::DIGEST_ALG,
            "private_key_bits" => self::PRIVATE_KEY_BITS,
            "private_key_type" => self::PRIVATE_KEY_TYPE,
        );

// Create the private and public key
        $res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
        openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
        $details = openssl_pkey_get_details($res);
        $pubKey = $details["key"];
        
        return ['privateKey' => $privKey, 'publicKey' => $pubKey];
    }
    
    /**
     * 公钥加密
     * chaishuai
     * @param string $data
     *
     * @return mixed
     * 2020/11/17 9:17
     */
    public function publicEncrypt($data)
    {
        openssl_public_encrypt($data, $encrypted_data, $this->public_key);
        
        return $encrypted_data;
    }
    /**
     * 公钥解密
     * chaishuai
     * @param string $data
     *
     * @return mixed
     * 2020/11/17 9:17
     */
    public function publicDecrypt($data)
    {
        openssl_public_decrypt ($data,  $decrypted_data, $this->public_key);
        
        return $decrypted_data;
    }
    /**
     * 私钥加密
     * chaishuai
     * @param string $data
     *
     * @return mixed
     * 2020/11/17 9:17
     */
    public function privateEncrypt($data)
    {
     openssl_private_encrypt($data, $encrypted_data, $this->private_key);
     
     return $encrypted_data;
    }
    /**
     * 私钥解密
     * chaishuai
     * @param string $data
     *
     * @return mixed
     * 2020/11/17 9:17
     */
    public function privateDecrypt($data)
    {
        openssl_private_decrypt($data, $decrypted_data, $this->private_key);
    
        return $decrypted_data;
    }
}
$privateKey = "-----BEGIN PRIVATE KEY-----
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
D0sww6uFWHDIxf42Ab4yQwG2fhuc+A==
-----END PRIVATE KEY-----
";
$publicKey = "-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA31YpVk28/LQWArFw27GP
ryxev/JoU6sMsIl1zSvuGxDlX3eeSdy7OvWbOPqWnhCii/w+3hGT6+/f0IYAoVmj
8gbluf55QA7c9vB8Vzlng9x4TAwRsn+WJLMWUdgH9sgP6yaJBmKNWHS9E+sWRr7O
C1J119ngC8cm3952aG1bpZfP1MG+HlK3ZuY/LWM1hIb3cEvmO2QsEaZJQpAIdcrc
F8FB9L2YwD1FlnBZCde6rn8oLdVPtpCELQrl5Y6X6E1SYlS0Q7gV+xziZO0MhB/4
4GNK9weLsl6QXt64NDV/o87N5Syhdmghs4TxxgV152Mz//YHzsOBZeuQhXF/zO/p
twTnqnSNNWOc8fv+pnSVhNYcF+sHiNULf6W/ANr4lNje1AixgpmpEhdklOJuM1ag
YuNDvyFZJQmd9bpkqaS7dkCYIJ6PRieq8ct6MQWZlugzu8UXAZQ2AudoK5zmv523
JXl3dc/ICp49Cn4i5/BMWEWILweFE9V274yiDZbphm4ysd97IHS8qgQGU2MCRNnM
YYtJWDCiNpf/Yp982Vk37rKq9dNilWyAEfHpi6d0dCju67sOGx5Dc27F6mILHsn8
4dtgP69a1BZ+5i8luHFHtgTG0vHNA9SbdfAmC0CjJcUPmEC1q3jnSGGY6TLH4g93
PwKfzA1e2tmbvOkUszUuCwcCAwEAAQ==
-----END PUBLIC KEY-----
";

$rsa = new cryptRsa($publicKey, $privateKey);
//$keys = $rsa::createKeys();
$data = 'hi my name is jack';
//公钥加密
$publicE = $rsa->publicEncrypt($data);
//私钥解密
$publicE = base64_encode($publicE);
$privateD = $rsa->privateDecrypt(base64_decode($publicE));
var_dump($publicE);
var_dump($privateD);
//私钥加密
$privateE = $rsa -> privateEncrypt($data);
$privateE = base64_encode($privateE);
//公钥解密
$publicD = $rsa -> publicDecrypt(base64_decode($privateE));
var_dump($privateE);
var_dump($publicD);