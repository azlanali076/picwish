<?php
namespace Azlanali076\Picwish\Models;

class PicwishScaleAsyncResponse {

    private ?int $status;
    private ?array $data;

    public function __construct(?int $status, ?array $data){
        $this->status = $status;
        $this->data = $data;
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
    public function getTaskId(): ?string
    {
        return $this->data['task_id'];
    }



}