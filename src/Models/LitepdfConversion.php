<?php
namespace Azlanali076\Litepdf\Models;

use Illuminate\Http\UploadedFile;

class LitepdfConversion {

    private ?array $docFile = null;
    private ?string $docUrl = null;
    private ?string $platform = 'web';
    private ?string $format = 'docx';
    private ?int $background = 0;
    private ?string $password = null;

    public function __construct(?UploadedFile $docFile = null,?string $docUrl = null, ?string $platform = 'web', ?string $format = 'docx', ?int $background = 0, ?string $password = null){
        if($docFile){
            $this->docFile = [
                'filename' => $docFile->getClientOriginalName(),
                'contents' => $docFile->getContent()
            ];
        }
        if($docUrl){
            $this->docUrl = $docUrl;
        }
        if($platform){
            $this->platform = $platform;
        }
        if($format){
            $this->format = $format;
        }
        if($background){
            $this->background = $background;
        }
        if($password){
            $this->password = $password;
        }
    }

    /**
     * @return mixed|null
     */
    public function getDocFile()
    {
        return $this->docFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setDocFile(UploadedFile $docFile): void
    {
        $this->docFile = [
            'filename' => $docFile->getClientOriginalName(),
            'contents' => $docFile->getContent()
        ];
    }

    /**
     * @return string|null
     */
    public function getDocUrl(): ?string
    {
        return $this->docUrl;
    }

    /**
     * @param string $docUrl
     */
    public function setDocUrl(string $docUrl): void
    {
        $this->docUrl = $docUrl;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     */
    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }

    /**
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string|null $format
     */
    public function setFormat(?string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return int|null
     */
    public function getBackground(): ?int
    {
        return $this->background;
    }

    /**
     * @param int|null $background
     */
    public function setBackground(?int $background): void
    {
        $this->background = $background;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'url' => $this->docUrl,
            'platform' => $this->platform,
            'format' => $this->format,
            'background' => $this->background,
            'password' => $this->password
        ];
    }

    public function toMultipart(): array
    {
        $multipart = [];
        foreach ($this->toArray() as $k=>$v){
            if($k != 'url') {
                $multipart[] = [
                    'name' => $k,
                    'contents' => $v
                ];
            }
        }
        $multipart[] = [
            'name' => 'file',
            'contents' => $this->docFile['contents'],
            'filename' => $this->docFile['filename']
        ];
        return $multipart;
    }

}