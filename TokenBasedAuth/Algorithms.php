<?php


namespace HashAuth;


class Algorithms
{
    const HASH_SHA256 = "SHA256";
    const HASH_SHA512 = "SHA512";
    const HASH_MD5 = "md5";
    const HASH_MD4 = "md4";

    const ENCRYPT_AES_256_CBC = "AES-256-CBC";
    const ENCRYPT_AES_256_CTR = "AES-256-CTR";
    const ENCRYPT_AES_256_XTS = "AES-256-XTS";

    const ENCRYPT_AES_192_CBC = "AES-192-CBC";
    const ENCRYPT_AES_192_CTR = "AES-192-CTR";
    const ENCRYPT_AES_192_XTS = "AES-192-XTS";

    const ENCRYPT_AES_128_CBC = "AES-128-CBC";
    const ENCRYPT_AES_128_CTR = "AES-128-CTR";
    const ENCRYPT_AES_128_XTS = "AES-128-XTS";
}