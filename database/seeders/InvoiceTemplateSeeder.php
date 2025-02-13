<?php

namespace Database\Seeders;

use App\Models\InvoiceTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        InvoiceTemplate::query()->truncate();
        DB::table('invoice_templates')->insert([
            [
                "name" => "Graphic Design Invoice",
                'preview' => '/asset/images/invoice-samples/sample-1.png',
                'path' => 'pdf.invoice',
            ],
            [
                "name" => "Black and White Clean Modern Invoice",
                'preview' => '/asset/images/invoice-samples/sample-2.png',
                'path' => 'pdf.invoice-2',
            ],
            [
                "name" => "Wave Invoice",
                'preview' => '/asset/images/invoice-samples/sample-3.png',
                'path' => 'pdf.invoice-3',
            ],
        ]);
    }
}
