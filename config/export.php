<?php

return [
    'exporters' => [
        'json' => \Crm\Customer\Services\Export\JsonExport::class,
        'html' => \Crm\Customer\Services\Export\HtmlExport::class,
        'pdf' => \Crm\Customer\Services\Export\pdfExport::class,
        'excel' => \Crm\Customer\Services\Export\ExcelExport::class,
    ]
];
