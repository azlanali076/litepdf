<?php
namespace Azlanali076\Litepdf\Models;

class LitepdfConversionSuccessResponse {

    private ?int $status;
    private ?array $data;

    public function __construct(array $response){
        $this->status = $response['status'];
        $this->data = $response['data'];
    }

    public function getCompletedAt(): int
    {
        return $this->data['completed_at'];
    }

    public function getCreatedAt(): int
    {
        return $this->data['created_at'];
    }

    public function getFile(): string
    {
        return $this->data['file'];
    }

    public function getProcessedAt(): int
    {
        return $this->data['processed_at'];
    }

    public function getType(): int
    {
        return $this->data['type'];
    }

    public function getState(): int
    {
        return $this->data['state'];
    }

    public function getTaskId(): string
    {
        return $this->data['task_id'];
    }

    public function getStatus(): int
    {
        return $this->status;
    }

}