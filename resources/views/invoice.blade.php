<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INVOICE</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: justify;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: justify;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <h1>BELANJAPARTS</h1>
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                Code Transaksi: {{ $transactions[0]->transaction_code }}<br>
                                Tanggal Order: {{ $transactions[0]->created_at }}<br>
                                Metode Pembayaran:{{ $transactionsDetail->paymentOption->name ?? '-' }}<br>
                                Diterbitkan Atas Nama: {{ $transactions[0]->store->user->name ?? '-' }}<br>
                                Toko : {{ $transactions[0]->store->name }}<br>
                                Bank : {{ $transactions[0]->store->user->bank_name }}
                                ({{ $transactions[0]->store->user->card_number }})
                            </td>
                            <td>
                                Tujuan Pengiriman <br>
                                Kepada : {{ $transactions[0]->user->name }}<br>
                                Email : {{ $transactions[0]->user->email }}<br>
                                Alamat : {{ $transactions[0]->user->address ?? '-' }}<br>
                                No WA : {{ $transactions[0]->user->phone ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td>
                    Nama Product
                </td>
                <td>
                    SKU
                </td>
                <td>
                    Qty
                </td>
                <td>
                    Harga / Unit
                </td>
                <td>
                    Sub total
                </td>

            </tr>

            @foreach ($transactions as $transaction)
                <tr class="item">
                    <td>
                        {{ $transaction->product->name ?? '' }}
                    </td>
                    <td>
                        {{ $transaction->product->SKU }}
                    </td>
                    <td>
                        {{ $transaction->requested_qty }}
                    </td>
                    </td>
                    <td>
                        {{ number_format($transaction->price, 2, ',', '.') }}
                    </td>
                    <td>
                        {{ number_format($transaction->total_price, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach

            <tr class="total">
                <td style="font-weight: bold">Total</td>
                <td></td>
                <td></td>
                <td></td>

                <td style="font-weight: bold">
                    @php
                        $totalPrice = 0;
                        foreach ($transactions as $transaction) {
                            $totalPrice += $transaction->total_price;
                        }
                        echo number_format($totalPrice, 2, ',', '.');
                    @endphp
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
