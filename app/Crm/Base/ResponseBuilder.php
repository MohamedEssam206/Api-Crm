<?php

namespace Crm\Base;

use Illuminate\Http\JsonResponse;
use function Symfony\Component\String\s;

class ResponseBuilder
{
    private int $statusCode = 200;
    private $data = null;
    private array $error = [];
    private string $status = 'success';
    private array $meta = [];

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getError(): array
    {
        return $this->error;
    }

    public function setError(array $error): self
    {
        $this->error = $error;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }


    public function response()
    {
        $response = [];

        if ($this->getStatusCode() >= 400){
            $this->setStatus(self::STATUS_ERROR);
        }

        $response['Status'] = $this->getStatus();

        if ($this->getStatus() !== JsonResponse::HTTP_OK && !empty($this->getError()))  {
            $response['error'] = $this->getError();
        }

        if ($this->getStatus() === self::STATUS_SUCCESS) {
            $response['data'] = $this->getData();
        }


        return response()->json($response, $this->getStatusCode());
    }


}
