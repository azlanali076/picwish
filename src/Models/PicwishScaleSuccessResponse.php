<?php
namespace Azlanali076\Picwish\Models;

class PicwishScaleSuccessResponse {

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

    public function getImage(): string
    {
        return $this->data['image'];
    }

    public function getProcessedAt(): int
    {
        return $this->data['processed_at'];
    }

    public function getProgress(): int
    {
        return $this->data['progress'];
    }

    public function getReturnType(): int
    {
        return $this->data['return_type'];
    }

    public function getState(): int
    {
        return $this->data['state'];
    }

    public function getTaskId(): string
    {
        return $this->data['task_id'];
    }

    public function getType(): string
    {
        return $this->data['type'];
    }

    public function getStatus(): int
    {
        return $this->status;
    }

}