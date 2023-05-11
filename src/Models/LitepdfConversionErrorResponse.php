<?php
namespace Azlanali076\Litepdf\Models;

class LitepdfConversionErrorResponse {

    private ?int $status;
    private ?string $message;

    public function __construct($status,$message){
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }



}