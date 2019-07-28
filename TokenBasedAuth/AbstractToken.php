<?php


namespace HashAuth;


abstract class AbstractToken
{
    /**
     * @var string
     */
    protected $algorithm = "AES-256-CBC";
    /**
     * @var string
     */
    protected $data_line;
    /**
     * @var string
     */
    protected $hash_algorithm = "sha256";


    /**
     * @var string
     */
    protected $generated_token;
    /**
     * @var array
     */
    protected $request_data = [];


    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param string $algorithm
     */
    public function setAlgorithm(string $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    /**
     * @return string
     */
    public function getDataLine(): string
    {
        return $this->data_line;
    }

    /**
     * @param string $data_line
     */
    public function setDataLine(string $data_line)
    {
        $this->data_line = $data_line;
    }
}