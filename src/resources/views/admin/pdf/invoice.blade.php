<!DOCTYPE  html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>TAX INVOICE</title>
    <meta name="author" content="ssscientific"/>
    <style type="text/css">
        /** {margin:0; padding:0; text-indent:0; }*/
        p {
            color: black;
            text-decoration: none;
            font-size: 10pt;
            margin: 0pt;
            padding-left:5pt;
            line-height: 1.6;
        }
        h1 {
            color: black;
            text-decoration: none;
            font-size: 13pt;
        }
        .s1 {
            color: black;
            text-decoration: none;
            font-size: 10pt;
        }
        .s2 {
            color: black;
            text-decoration: none;
            font-size: 10pt;
        }
        td, th{
            width:10%;
            padding-left:5pt;
            font-size: 10pt;
        }
        .table-quotation, th, td {
            border: 1px solid black;
            border-spacing:0;
        }
        .no-border{
            border:0px;
        }
        .left-align{
            text-align:left;
            padding-left:5pt;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        /*table, tbody {vertical-align: top; overflow: visible; }*/
    </style>
</head>
<body>
<p style="text-indent: 0pt;text-align: left;">
    <span>
        <table cellspacing="0" cellpadding="0" class='center'>
            <tr>
                <td style="border: none;">
                    <p style="padding-top: 4pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">SS Scientific</p>
                    <p style="padding-left: 7pt;text-indent: 0pt;line-height: 109%;text-align: left;">Shop No. 11, Jamal
                        Mansion, Dr,<br> Meisheri Road, Dongri, Mumbai - 400 009.</p>
                    <p style="padding-left: 7pt;text-indent: 0pt;line-height: 109%;text-align: left;">Maharashtra, India</p>
                    <p style="padding-left: 7pt;text-indent: 0pt;line-height: 9pt;text-align: left;">GST: 27AYQPS9651P1Z2</p>
                </td>
            </tr>
        </table>
    </span>
</p>
<h1 style="padding-top: 1pt;text-align:center; font-size:13pt">INVOICE</h1>
<p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">
<p style="text-indent: 0pt;text-align: left;"><br/></p>
<table class='center table-quotation'>
    <tr>
        <th colspan='4' class='left-align'>BILL TO</th>
        <th colspan='4' class='left-align'>SHIP TO</th>
    </tr>

    <tr>
        <td colspan='4'>
            <p>
                {{ $invoice->invoice_no }} <br />
                Date: {{date('d-m-Y', strtotime($invoice->created_at)) }} <br />
                GST NO: {{ $invoice->gst_no  }} <br />
            </p>
        </td>
        <td colspan='4'>
            <p>P.O. No.: {{ $invoice->purchaseOrder->po_no }}</p>
            <p>Place of Supply: {{ $model->property_address }}</p>
            <p>CUSTOMER GST NO.: XYZ00021</p>
        </td>
    </tr>


    <tr>
        <td class='no-border left-align' colspan='8' style=" font-size: 15px; line-height: 38px; ">CONTACT PERSON: {{ $model->user->full_name }}</td>
    </tr>
    <tr>
        <td  class='no-border left-align' colspan='8' style=" font-size: 15px; line-height: 38px; ">MOBILE: {{ $model->user->phone_number }}<span style="padding-right: 120px"></span> Email:{{ $model->user->email }}</td>
    </tr>
    <tr>
        <th>S/N</th>
        <th>P/N</th>
        <th>HSN Code</th>
        <th colspan='2'>Description of goods</th>
        <th>Qty</th>
        <th>Unit {{ $model->currency_type }}</th>
        <th>Amount {{ $model->currency_type }}</th>
    </tr>

    <!-- Repeatable -->
    @if($model && $model->items)
        @foreach($model->items as $item)
            <tr>
                <td width="10px">S/N</td>
                <td>P/N</td>
                <td>HSN Code</td>
                <td colspan='2'>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->asset_value }}</td>
                <td>{{ $item->asset_value }}</td>
            </tr>
        @endforeach
    @endif
    <!-- repeatable -->

    <tr>
        <td colspan='8'>
            <p>Bank Account Details<br>
                UNION BANK OF INDIA<br>
                WADALA (EAST) BRANCH<br>
                JUPITER BLDG., WADALA (EAST)<br>
                SHANKARMISTRY ROAD,<br>
                MUMBAI - 400037<br>
                A/C No.: 583505080000001<br>
                IFSC: UBIN0558354<br>
            </p>
        </td>
    </tr>

    <tr>
        <td colspan='4'>
            Terms & Conditions
        </td>
        <td colspan='4'>
            <table style="text-align: right;height: 154px;">
                <tr>
                    <td colspan='6' class='no-border' >Payment Terms: Ex-Warehouse</td>
                    <td colspan='2'></td>
                </tr>
                <tr>
                    <td colspan='6' class='no-border' >Delivery Period: IGST 18%</td>
                    <td colspan='2'></td>
                </tr>
                <tr>
                    <td colspan='6' class='no-border' >Installation: CGST</td>
                    <td colspan='2'></td>
                </tr>
                <tr>
                    <td colspan='6' class='no-border' >Freight: SGST</td>
                    <td colspan='2'></td>
                </tr>
                <tr>
                    <td colspan='6' class='no-border' >Validity - 90 Days TOTAL FOR, DESTINATION</td>
                    <td colspan='2'></td>
                </tr>
            </table>
        </td>
    </tr>


{{--    <tr>--}}
{{--        <td colspan='8' class='left-align no-border'>--}}
{{--            <br>--}}
{{--            For, S. S SCIENTIFIC</br>--}}
{{--            <img width="130" height="85" src="{{ public_path('images/proposal-pdf/stamp.png') }}"/></br>--}}
{{--            AUTHORIZED SIGNATORY--}}
{{--        </td>--}}
{{--    </tr>--}}
</table>
</span>
</p>
<style>
    @page {
        size: A4;
        margin: 0px !important;
        padding: 0 !important
    }
    @font-face {
        font-family: 'Poppins';
        font-weight: normal;
        src: url({{ storage_path('fonts/poppins/poppins.ttf') }}) format("truetype");
    }
    @font-face {
        font-family: 'Poppins Light';
        font-weight: normal;
        src: url({{ storage_path('fonts/poppins/Poppins-Light.ttf') }}) format("truetype");
    }
    @font-face {
        font-family: 'Poppins Medium';
        font-weight: 500;
        src: url({{ storage_path('fonts/poppins/poppins-medium.ttf') }}) format("truetype");
    }
    @font-face {
        font-family: 'Poppins SemiBold';
        font-weight: 600;
        src: url({{ storage_path('fonts/poppins/Poppins-SemiBold.ttf') }}) format("truetype");
    }
    @font-face {
        font-family: 'Poppins Bold';
        font-weight: 700;
        src: url({{ storage_path('fonts/poppins/Poppins-Bold.ttf') }}) format("truetype");
    }
    @font-face {
        font-family: 'Poppins ExtraBold';
        font-weight: 800;
        src: url({{ storage_path('fonts/poppins/poppins-extra-bold.ttf') }}) format("truetype");
    }
    body {
        font-size: 10px;
        background-image: url({{ public_path('images/proposal-pdf/sss.png') }});
        /* height: 100%;
        width: 100%; */
        background-size: cover;
        padding: 90px 0;
        z-index: 11;
    }
    table {
        width: 90%;
    }
</style>
</body>
</html>
