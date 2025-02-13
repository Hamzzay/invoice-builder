<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Invoice</title>
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap'); */


        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url('{{ storage_path('fonts/Poppins-Regular.ttf') }}') format('truetype');
        }

        :root {
            --pumpkin: #F46D11;
            --white: white;
        }

        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .main-container {
            width: 100%;
            height: 100vh;
        }

        .inner-container {
            width: 100%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .heading {
            width: 100%;
        }

        table {
            width: 100%;
            padding: 1rem;
        }

        .invoice-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-wrap: wrap;
        }

        .invoice-logo {
            width: 100%;
        }

        .invoice-logo img {
            max-height: 100px;
            /* height: 50px; */
            object-fit: cover;
        }

        .invoice-detail {
            font-weight: 700;
        }

        .detail-value {
            text-align: right;
            font-weight: 400;
        }

        .invoice-bill-from {
            padding-top: 1rem;
            font-weight: 700;
            text-align: left;

        }

        .invoice-bill-from label {
            font-weight: 700;
        }

        .invoice-bill-from .detail-value {
            text-align: left;
            text-wrap: wrap;
        }

        .table {
            width: 100%;
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

        .table tbody tr:nth-of-type(odd) {
            background-color: #DEE1E4;
        }

        .bold {
            font-weight: 600;
        }

        .table thead tr .column {
            background-color: #f7c651;
            color: #000000;

        }

        .grand-total table tr {
            font-weight: 600;
        }

        .grand-total-count td {
            border-top: 2px solid #98999d;
            border-bottom: 2px solid #98999d;
            padding: 0px;
            padding-top: 5px;
            padding-bottom: 5px;
            color: #000000;
            font-weight: 600;
        }

        .payment-information {
            background-color: #0d213f;
            color: #FCFCFC;
            padding: 1rem;
        }

        .payment-information span {
            font-weight: 600;
        }

        .invoice-footer label {
            font-weight: 600;
        }

        .signatures {
            text-align: right;
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
                <table>
                    <thead>
                        <tr>
                            <td>
                                <div class="invoice-title">
                                    <h1>Invoice</h1>
                                </div>
                            </td>
                            <td>
                                <div class="invoice-logo">
                                    @if ($data['logo'])
                                        <img src="{{ public_path($data['logo']) }}" alt="logo">
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="invoice-bill-from">
                                    <h2>Bill From:</h2>
                                    <p class="pre-wrap">{{ $data['bill_from'] }}</p>
                                </div>

                            </td>
                            <td>
                                <div class="invoice-detail">
                                    <p><span>Invoice number: </span> <span
                                            class="detail-value">{{ $data['invoice_number'] }}</span></p>
                                    <p><span>Invoice Date: </span> <span class="detail-value">{{ $data['date'] }}</span>
                                    </p>
                                    <div class="invoice-bill-from">
                                        <h2>Bill To:</h2>
                                        <p class="pre-wrap">{{ $data['bill_to'] }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </section>
            <section class="service-detail">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="padding: 0px;">
                                <h2 style="text-align: left;">Service Detail:</h2>
                            </th>
                        </tr>
                        <tr>
                            <th class="column">Item</th>
                            <th class="column">Description of Service</th>
                            <th class="column">Quantity</th>
                            <th class="column">Rate per Hour ($)</th>
                            <th class="column">Total ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['invoiceItems'] as $item)
                            <tr>
                                <td class="bold">{{ $item['itemName'] }}</td>
                                <td>{{ $item['itemDescription'] }}</td>
                                <td>{{ $item['itemQuantity'] }}</td>
                                <td>{{ $item['itemPricePer'] }}</td>
                                <td>{{ $item['itemQuantity'] * $item['itemPricePer'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            <section class="invoice-other">
                <table>
                    <thead>
                        <tr>
                            <td>
                                <div class="terms-and-conditions">
                                    <h2>Payment Information</h2>
                                    <div class="condition-list">
                                        <p class="pre-wrap">{{ $data['payment_method'] }}</p>
                                        <p>
                                            <label for="">Due Date:</label> <span>{{ $data['dueDate'] }}</span>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
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
                                        <tr class="grand-total-count">
                                            <td>Total Amount Due</td>
                                            <td>{{ $data['grandTotal'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </section>
            <section class="invoice-footer">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>
                                <div class="signatures">
                                    <label for="">Date: </label><span>{{ $data['date'] }}</span>
                                    <div class="signatures-img">
                                        @if ($data['signaturePath'])
                                            <img src="{{ public_path($data['signaturePath']) }}" alt="signature"
                                                width="100px">
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </thead>
                </table>
            </section>
        </div>
    </div>
</body>

</html>
