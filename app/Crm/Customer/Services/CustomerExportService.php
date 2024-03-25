<?php

namespace Crm\Customer\Services;

use Crm\Customer\Exceptions\InvalidExportFormat;
use Crm\Customer\Repositories\CustomerRepository;
use Crm\Customer\Services\Export\ExportInterface;
use Crm\Customer\Services\Export\HtmlExport;
use Crm\Customer\Services\Export\JsonExport;
use Crm\Customer\Services\Export\pdfExport;

class CustomerExportService
{
    private CustomerRepository $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function export(string $format)
    {
        $customers = $this->customerRepository->all();
        $handler = config('export.exporters')[$format] ?? null;


        if (!$handler){
            throw new InvalidExportFormat(sprintf("format %s is not Supported", $format));
        }
        $exporter = new $handler;
        if ($exporter instanceof ExportInterface){
            $exporter->export($customers->toArray());
        }

    }

}
