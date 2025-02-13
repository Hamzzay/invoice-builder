<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;
use App\Models\InvoiceTemplate;
use Illuminate\Http\Request;

class InvoiceTemplateController extends Controller
{
    use CommonTrait;
    public function InvoiceTemplates()
    {
        $invoiceTemplates = InvoiceTemplate::all();
        return $this->sendSuccess("Invoice Template Fetched Successfully", $invoiceTemplates);
    }
}
