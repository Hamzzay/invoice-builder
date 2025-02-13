<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    use CommonTrait;
    public function generateInvoice(Request $request)
    {
        $invoice = new Invoice();
        $subTotal =  $request->input('sub_total');
        $grandTotal = $request->input('grand_total');
        $formValues = json_decode($request->input('formValues'), true);
        info($formValues);
        info($request->logo);
        $logoPath = null;
        $signaturePath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $this->addFile($request->logo, 'uploads/images/');
            $invoice->logo = $logoPath;
        }
        if ($request->hasFile('signature')) {
            $signaturePath = $this->addFile($request->signature, 'uploads/images/');
            $invoice->sign = $signaturePath;
        }




        $invoice->type =  $formValues['invoiceType'];
        $invoice->invoice_number = $formValues['invoiceNumber'];
        $invoice->bill_from = $formValues['from'];
        $invoice->bill_to = $formValues['to'];
        $invoice->date = Carbon::parse($formValues['date'])->format('Y-m-d');
        $invoice->due_date =  Carbon::parse($formValues['dueDate'])->format('Y-m-d');

        $invoice->discount_reason = $formValues['discount']['discountName'];
        $invoice->discount_type = $formValues['discount']['discountType'];
        $invoice->discount = $formValues['discount']['amount'];

        $invoice->shipping = $formValues['shipping']['amount'];
        $invoice->shipping_method = $formValues['shipping']['methodName'];

        $invoice->tax = $formValues['tax']['rate'];
        $invoice->tax_name = $formValues['tax']['taxName'];

        $invoice->notes = $formValues['comment'];
        $invoice->payment_method = $formValues['payment_method'];

        $invoice->items = json_encode($formValues['invoiceItems']);

        $invoice->subtotal = $subTotal;
        $invoice->total = $grandTotal;

        $invoice->save();

        $data = $this->dataArray($logoPath, $signaturePath, $formValues, $subTotal, $grandTotal);
        $pdfSample = $this->checkInvoiceSample($formValues['invoiceSampleValue']);

        $pdf = Pdf::loadView($pdfSample, compact('data'))->setPaper("A4", 'portrait')
            ->setOption([
                'fontDir' => storage_path('/fonts'),
                'fontCache' => storage_path('/fonts'),
                'defaultFont' => 'Poppins'
            ]);
        return $pdf->download('document.pdf');
    }

    public function preview(Request $request)
    {
        $subTotal =  $request->input('sub_total');
        $grandTotal = $request->input('grand_total');
        $formValues = json_decode($request->input('formValues'), true);
        $logoPath = null;
        $signaturePath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $this->addFile($request->logo, 'uploads/images/');
        }
        if ($request->hasFile('signature')) {
            $signaturePath = $this->addFile($request->signature, 'uploads/images/');
        }
        $data = $this->dataArray($logoPath, $signaturePath, $formValues, $subTotal, $grandTotal);
        $invoiceSample = $formValues['invoiceSampleValue'];
        $pdfSample = $this->checkInvoiceSample($formValues['invoiceSampleValue']);
        $pdf = Pdf::loadView($pdfSample, compact('data'))->setPaper("A4", 'portrait')
            ->setOption([
                'fontDir' => storage_path('/fonts'),
                'fontCache' => storage_path('/fonts'),
                'defaultFont' => 'Poppins'
            ]);
        return $pdf->stream();
    }
    public function dataArray($logoPath, $signaturePath, $formValues, $subTotal, $grandTotal)
    {
        return [
            'logo' => $logoPath,
            'signaturePath' => $signaturePath,
            'bill_to' => $formValues['to'],
            'bill_from' => $formValues['from'],
            'invoice_number' => $formValues['invoiceNumber'],
            'date' => Carbon::parse($formValues['date'])->format('d F Y'),
            'dueDate' => Carbon::parse($formValues['dueDate'])->format('d F Y'),
            'invoiceItems' => $formValues['invoiceItems'],
            'tax' => $formValues['tax'],
            'shipping' => $formValues['shipping'],
            'discount' => $formValues['discount'],
            'subTotal' => $subTotal,
            'grandTotal' => $grandTotal,
            'payment_method' => $formValues['payment_method'],
            'comment' => $formValues['comment'],
            'invoice_type' => $formValues['invoiceType'],
        ];
    }

    public function checkInvoiceSample($sample = 1)
    {
        switch ($sample) {
            case 1:
                return "pdf.invoice";
                break;
            case 2:
                return "pdf.invoice-2";
                break;
            case 3:
                return  "pdf.invoice-3";
                break;
            default:
                return "pdf.invoice";
        }
    }
}
