<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: "Open sans", sans-serif;
            margin: 0px;
            padding: 0px;
            font-size: 14px;
        }

        .main-section {
            border-left: 10px solid #049BDB;
            padding: 2rem;
        }



        .invoice-heading {
            font-size: 1.5rem;
            overflow: hidden;
            font-weight: 500;
        }

        .invoice-heading:after {
            content: "";
            display: inline-block;
            height: 0.5em;
            vertical-align: bottom;
            width: 100%;
            margin-right: -100%;
            margin-left: 10px;
            border-top: 1px solid black;
        }

        .header-detail {
            width: 100%;
        }

        table {
            width: 100%;
        }

        /* .header-detail-table thead tr td {
            padding: 0px 15px;
        } */

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: none;
        }

        .bill-to {
            text-align: right;

        }

        .bill-to label {
            font-weight: 600;
        }

        .right-align {
            text-align: right;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        p {
            font-weight: 500;
        }

        .invoice-detail {
            border-top: 1px solid #98999d;
            border-bottom: 1px solid #98999d;
            color: rgb(56, 49, 49);

        }

        .invoice-values {
            font-size: 20px;
            font-weight: 600;
        }

        .bg-blue {
            background-color: #a2ddf7;
        }

        .invoice-items {
            margin-top: 1rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        /* .invoice-items table thead {
            text-align: left;
        } */

        .invoice-items table {
            border-spacing: 10px;
            text-align: center;
        }

        .invoice-grand-total label {
            font-weight: 600;
        }

        .subtotal {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .item-flex {
            display: flex;
            gap: 24px;
            justify-content: end;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .border-top {
            border-top: 1px solid #98999d;
        }

        .discountName {
            font-size: 10px;
        }

        .company-logo img {
            max-height: 100px;
            object-fit: cover;
        }

        .signatures-img {
            margin-top: 0.5rem;
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
    <section class="main-section">
        <div class="invoice-heading">
            <span>INVOICE</span>
        </div>
        <div class="header-detail">
            <table class="header-detail-table">
                <thead>
                    <tr>
                        <td class="">
                        </td>
                        <td class="bill-to">
                            <label for="">BILL TO:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="company-logo">
                                @if ($data['logo'])
                                    <img src="{{ public_path($data['logo']) }}" alt="logo">
                                @endif
                            </div>
                            <p style="white-space: pre-wrap">{{ $data['bill_from'] }}</p>
                        </td>
                        <td class="right-align mb-1">
                            <p style="white-space: pre-wrap">{{ $data['bill_to'] }}</p>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="invoice-detail">
            <table>
                <thead>
                    <tr>
                        <td>
                            <label for="">INVOICE #</label>
                            <div class="invoice-values">{{ $data['invoice_number'] }}</div>
                        </td>
                        <td>
                            <label for="">DATE</label>
                            <div class="invoice-values">{{ $data['date'] }}</div>
                        </td>
                        <td>
                            <label for="">Due Date #</label>
                            <div class="invoice-values">{{ $data['dueDate'] }}</div>
                        </td>
                        <td class="right-align bg-blue">
                            <label for="">AMOUNT DUE</label>
                            <div class="invoice-values">{{ $data['grandTotal'] }}</div>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="invoice-items">
            <table>
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th class="right-align">Amount</th>
                    </tr>
                <tbody>
                    @foreach ($data['invoiceItems'] as $index => $invoiceItem)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $invoiceItem['itemName'] }}</td>
                            <td>{{ $invoiceItem['itemDescription'] }}</td>
                            <td>{{ $invoiceItem['itemQuantity'] }}</td>
                            <td>{{ $invoiceItem['itemPricePer'] }}</td>
                            <td class="right-align">{{ $invoiceItem['itemQuantity'] * $invoiceItem['itemPricePer'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>
        <div class="invoice-grand-total">
            <table>
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <div>
                                <label for="">NOTES:</label>
                                <p>{{ $data['comment'] }}</p>
                            </div>
                            <div>
                                <label for="">Payment Information:</label>
                                <p class="pre-wrap">{{ $data['payment_method'] }}</p>
                            </div>
                        </td>
                        <td>
                            @php
                                $discount = $data['discount'];
                            @endphp
                            <div class="subtotal">
                                <div class="right-align item-flex">
                                    <label for="">SUB-TOTAL</label>
                                    <span>{{ $data['subTotal'] }}</span>
                                </div>
                                @if ($discount['discountType'] == 'amount')
                                    <div class="right-align item-flex">
                                        <div class="item-flex flex-column">
                                            <label for="">Discount</label>
                                            <span class="discountName">({{ $discount['discountName'] }})</span>
                                            <span>({{ $discount['amount'] }})</span>
                                        </div>

                                    </div>
                                @else
                                    <div class="right-align item-flex">
                                        <label for="">Discount ({{ $discount['discountName'] }})</label>
                                        <span>(%{{ $discount['amount'] }})</span>
                                    </div>
                                @endif
                                <div class="right-align item-flex">
                                    <label for="">shipping</label>
                                    <span class="discountName">({{ $data['shipping']['methodName'] }})</span>
                                    <span>({{ $data['shipping']['amount'] }})</span>
                                </div>
                                <div class="right-align item-flex">
                                    <label for="">Tax </label> <span
                                        class="discountName">({{ $data['tax']['taxName'] }})</span>
                                    <span>({{ $data['tax']['rate'] }}%)</span>
                                </div>
                                <div class="right-align item-flex border-top">
                                    <label for="">TOTAL</label>
                                    <span>{{ $data['grandTotal'] }}</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="signatures-img">
                                @if ($data['signaturePath'])
                                    <img src="{{ public_path($data['signaturePath']) }}" alt="signature"
                                        width="100px">
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
