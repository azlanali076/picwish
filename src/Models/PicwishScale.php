<?php
namespace Azlanali076\Picwish\Models;

use Illuminate\Http\UploadedFile;

class PicwishScale {

    private ?array $imageFile = null;
    private ?string $imageUrl = null;
    private ?string $imageBase64 = null;
    private ?string $type = 'face';
    private ?int $scaleFactor = null;
    private ?int $fixFaceOnly = 0;
    private ?int $returnType = 1;
    private ?int $sync = 0;

    public function __construct(?UploadedFile $imageFile = null,?string $imageUrl = null, ?string $imageBase64 = null, ?string $type = null,?int $scaleFactor = null,?int $fixFaceOnly = null,?int $returnType = null,?int $sync = null){
        if($imageFile){
            $this->imageFile = [
                'filename' => $imageFile->getClientOriginalName(),
                'contents' => $imageFile->getContent()
            ];
        }
        if($imageUrl){
            $this->imageUrl = $imageUrl;
        }
        if($imageBase64){
            $this->imageBase64 = $imageBase64;
        }
        if($type){
            $this->type = $type;
        }
        if($scaleFactor){
            $this->scaleFactor = $scaleFactor;
        }
        if($fixFaceOnly){
            $this->fixFaceOnly = $fixFaceOnly;
        }
        if($returnType){
            $this->returnType = $returnType;
        }
        if($sync){
            $this->sync = $sync;
        }
    }

    /**
     * @return mixed|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile(UploadedFile $imageFile): void
    {
        $this->imageFile = [
            'filename' => $imageFile->getClientOriginalName(),
            'contents' => $imageFile->getContent()
        ];
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string|null
     */
    public function getImageBase64(): ?string
    {
        return $this->imageBase64;
    }

    /**
     * @param string $imageBase64
     */
    public function setImageBase64(string $imageBase64): void
    {
        $this->imageBase64 = $imageBase64;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getScaleFactor(): ?int
    {
        return $this->scaleFactor;
    }

    /**
     * @param int|null $scaleFactor
     */
    public function setScaleFactor(?int $scaleFactor): void
    {
        $this->scaleFactor = $scaleFactor;
    }

    /**
     * @return int|null
     */
    public function getFixFaceOnly(): ?int
    {
        return $this->fixFaceOnly;
    }

    /**
     * @param int|null $fixFaceOnly
     */
    public function setFixFaceOnly(?int $fixFaceOnly): void
    {
        $this->fixFaceOnly = $fixFaceOnly;
    }

    /**
     * @return int|null
     */
    public function getReturnType(): ?int
    {
        return $this->returnType;
    }

    /**
     * @param int|null $returnType
     */
    public function setReturnType(?int $returnType): void
    {
        $this->returnType = $returnType;
    }

    /**
     * @return int|null
     */
    public function getSync(): ?int
    {
        return $this->sync;
    }

    /**
     * @param int|null $sync
     */
    public function setSync(?int $sync): void
    {
        $this->sync = $sync;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $toArray = [
            'type' => $this->type,
            'fix_face_only' => $this->fixFaceOnly,
            'return_type' => $this->returnType,
            'sync' => $this->sync
        ];
        if($this->imageUrl){
            $toArray['image_url'] = $this->imageUrl;
        }
        if($this->imageBase64){
            $toArray['image_base64'] = $this->imageBase64;
        }
        if($this->scaleFactor){
            $toArray['scale_factor'] = $this->scaleFactor;
        }
        return $toArray;
    }

    public function toMultipart(): array
    {
        $multipart = [];
        foreach ($this->toArray() as $k=>$v){
            $multipart[] = [
                'name' => $k,
                'contents' => $v
            ];
        }
        $multipart[] = [
            'name' => 'image_file',
            'contents' => $this->imageFile['contents'],
            'filename' => $this->imageFile['filename']
        ];
        return $multipart;
    }

}