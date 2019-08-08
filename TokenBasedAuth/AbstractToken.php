<?php


namespace HashAuth;


abstract class AbstractToken
{
    /**
     * @var string
     */
    protected $data_line;
    /**
     * @var string
     */
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
    public function getDataLine(): string
    {
        return $this->data_line;
    }

    /**
     * @param string $data_line
     */
    public function setDataLine(string $data_line)
    {
        $this->data_line = json_encode($data_line);
    }
}