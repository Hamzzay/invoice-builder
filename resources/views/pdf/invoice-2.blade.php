<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --pumpkin: #F46D11;
            --white: white;
            --jet-black: #000000;
        }

        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .main-container {
            width: 100%;
        }

        .inner-container {
            width: 90%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .heading {
            width: 100%;
        }

        .border-bar {
            height: 30px;
            background-color: #000000;
        }

        table {
            width: 100%;
        }

        .invoice-title {
            padding: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: right;
            text-wrap: wrap;
        }

        .invoice-intro {
            padding: 1rem;
        }

        .invoice-intro p {
            font-size: 14px;
            font-weight: 500;
        }

        .bill-to {
            margin-top: 2.5rem;
            width: 200px;
        }

        .invoice-logo {
            width: 100%;
        }

        .invoice-logo img {
            width: 200px;
        }

        .invoice-detail {
            font-weight: 700;
            text-align: right;
        }

        .detail-value {
            text-align: right;
            font-weight: 400;
        }

        .invoice-bill-from {
            padding-top: 1rem;
            font-weight: 700;
            text-align: left;
            width: 250px;
        }

        .invoice-bill-from .detail-value {
            text-align: left;
            text-wrap: wrap;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            vertical-align: top;
            border-color: black;
            border-spacing: 0px;
        }

        .table thead tr th {
            text-align: left;
            padding: 0.5rem;

        }

        .table tr td {
            text-align: left;
            padding-left: 1rem;
            padding-right: 1rem;
        }



        .table thead tr .column {
            background-color: #000000;
            border-top: 2px solid #000000;
            padding-top: 1rem;
            color: #fff;
            padding-bottom: 1rem;
            font-size: 20px;
            text-transform: uppercase;
        }

        .tbody-spacing:before {
            content: "-";
            display: block;
            line-height: 1em;
            color: transparent;
        }

        .tbody-spacing tr:nth-of-type(odd) {
            background-color: #eef0f7;
        }

        .tbody-spacing td:nth-of-type(odd) {
            padding: 1rem;
        }

        .grand-total table tr {
            font-weight: 600;
            color: #000000;
            width: 100%;

        }

        .grand-total-count td {
            border-top: 2px solid #98999d;
            background: #eef0f7;
            color: #000000;
            font-weight: 600;
            width: 100%;
        }

        .payment-information {
            /* padding-left: 1rem;
            padding-right: 1rem;
            margin-top: 0.5rem; */
            /* white-space: pre; */
        }

        .payment-information pre {

            white-space: pre;
        }

        .payment-information span {
            font-weight: 600;
        }

        .company-logo img {
            max-height: 100px;
            object-fit: cover;
        }

        .pre-wrap {
            font-weight: 400;
            width: 350px;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="inner-container">
            <section class="heading">
                <div class="border-bar"></div>
                <div class="invoice-intro">
                    <table>
                        <tr>
                            <td>
                                <h1 class="">Invoice</h1>
                                <p>Invoice Number: {{ $data['invoice_number'] }}
                                </p>
                                <p>Date: {{ $data['date'] }}</p>
                                <p>Due Date: {{ $data['dueDate'] }}</p>
                            </td>
                            <td>
                                <div style="text-align: right;" class="company-logo">
                                    @if ($data['logo'])
                                        <img src="{{ public_path($data['logo']) }}" alt="logo">
                                    @endif
                                    <p style="white-space: pre-wrap">
                                        {{ $data['bill_from'] }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="bill-to">
                                    <h1 class="">Bill To</h1>
                                    <p>{{ $data['bill_to'] }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
            <section class="service-detail">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="column">Item</th>
                            <th class="column">Name</th>
                            <th class="column">Description</th>
                            <th class="column">Quantity</th>
                            <th class="column">Price</th>
                            <th class="column">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-spacing">
                        @foreach ($data['invoiceItems'] as $index => $invoiceItem)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $invoiceItem['itemName'] }}</td>
                                <td>{{ $invoiceItem['itemDescription'] }}</td>
                                <td>{{ $invoiceItem['itemQuantity'] }}</td>
                                <td>{{ $invoiceItem['itemPricePer'] }}</td>
                                <td>{{ $invoiceItem['itemQuantity'] * $invoiceItem['itemPricePer'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            <section class="invoice-other">
                <table>
                    <thead>
                        <tr style="width: 100%;">
                            <td>
                                <div class="payment-information">
                                    <h2>PAYMENT INFORMATION:</h2>
                                    <p class="pre-wrap">{{ $data['payment_method'] }}</p>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div class="grand-total">
                                    <table style="border-spacing: 0px;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>{{ $data['subTotal'] }}</td>
                                        </tr>
                                        @php
                                            $discount = $data['discount'];
                                        @endphp
                                        @if ($discount['discountType'] == 'amount')
                                            <tr>
                                                <td>Discount ({{ $discount['discountName'] }})</td>
                                                <td>({{ $discount['amount'] }})</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>Discount ({{ $discount['discountName'] }})</td>
                                                <td>%({{ $discount['amount'] }})</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>shipping ({{ $data['shipping']['methodName'] }})</td>
                                            <td>({{ $data['shipping']['amount'] }})</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $data['tax']['taxName'] }}</td>
                                            <td>({{ $data['tax']['rate'] }}%)</td>
                                        </tr>
                                        <tr>
                                            <td>T O T A L :</td>
                                            <td>{{ $data['grandTotal'] }}</td>
                                        </tr>
                                        <tr>
                                            <div class="signatures" style="text-align: right">
                                                {{-- <label for="">Date: </label><span>{{ $data['date'] }}</span> --}}
                                                <div class="signatures-img">
                                                    @if ($data['signaturePath'])
                                                        <img src="{{ public_path($data['signaturePath']) }}"
                                                            alt="signature" width="100px">
                                                    @endif
                                                </div>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                <div class="payment-information">
                                    <h2>PAYMENT INFORMATION:</h2>
                                    <p><span>Bank:</span> Borcelle Bank</p>
                                    <p><span>Name:</span> Margarita Perez</p>
                                    <p><span>Account:</span> 01234 4567 8901</p>
                                </div>
                            </td>

                        </tr> --}}
                    </thead>
                </table>
            </section>
            <div class="border-bar"></div>
        </div>
    </div>
</body>

</html>
