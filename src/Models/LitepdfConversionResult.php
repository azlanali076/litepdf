<?php
namespace Azlanali076\Litepdf\Models;

class LitepdfConversionResult {

    private ?int $status;
    private ?array $data;
    public function __construct(?int $status, ?array $data){
        $this->status = $status;
        $this->data = $data;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getProgress(): ?int
    {
        return $this->data['progress'];
    }

    public function getState(): ?int
    {
        return $this->data['state'];
    }

}