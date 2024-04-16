<!-- <!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Order confirmation </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" /> -->
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    body {
        margin: 0;
        padding: 0;
        background: #e1e1e1;
    }

    div,
    p,
    a,
    li,
    td {
        -webkit-text-size-adjust: none;
    }

    .ReadMsgBody {
        width: 100%;
        background-color: #ffffff;
    }

    .ExternalClass {
        width: 100%;
        background-color: #ffffff;
    }

    body {
        width: 100%;
        height: 100%;
        background-color: #e1e1e1;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
    }

    html {
        width: 100%;
    }

    p {
        padding: 0 !important;
        margin-top: 0 !important;
        margin-right: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 0 !important;
    }

    .visibleMobile {
        display: none;
    }

    .hiddenMobile {
        display: block;
    }

    @media only screen and (max-width: 600px) {
        body {
            width: auto !important;
        }

        table[class=fullTable] {
            width: 96% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 45% !important;
        }

        .erase {
            display: none;
        }
    }

    @media only screen and (max-width: 420px) {
        table[class=fullTable] {
            width: 100% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 100% !important;
            clear: both;
        }

        table[class=col] td {
            text-align: left !important;
        }

        .erase {
            display: none;
            font-size: 0;
            max-height: 0;
            line-height: 0;
            padding: 0;
        }

        .visibleMobile {
            display: block !important;
        }

        .hiddenMobile {
            display: none !important;
        }
    }
</style>
<div id="main_bill1">
    <div id="content_print">



        <table style="background-color: transparent;" width="100%" border="0" cellpadding="0" cellspacing="0"
            align="center" class="fullTable" bgcolor="#e1e1e1">

            <tbody>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td>
                        <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullTable" bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                            <tbody>
                                <tr class="hiddenMobile">
                                    <td height="40"></td>
                                </tr>
                                <tr class="visibleMobile">
                                    <td height="30"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table width="650" border="0" cellpadding="0" cellspacing="0"
                                            align="center" class="fullPadding">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="left" class="col">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="font-size: 18px; font-weight: 500; color: #6b10f4; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;"
                                                                        width="50%"> <span
                                                                            style="display: block; margin-bottom: 5px;">Good Receve Note(Manual)
                                                                            </span>
                                                                        <strong>{{$fetch_data->grn_no}}</strong>
                                                                        <br />
                                                                        <span
                                                                            style="padding: 0.25em 0.6em; color:#fff; border-radius:0.25rem; background-color:#0f75d1; font-size: 13px;
                                                            margin-top: 10px;
                                                            display: inline-block;">
                                                                            {{ $fetch_data->status}}</span>
                                                                    </td>

                                                                    <td align="right"><img src={{ $logo->logo }}
                                                                            style="max-height: 60px; max-width: 200px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="40"></td>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                        <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="right" class="col">
                                                            <tbody>
                                                                <tr class="visibleMobile">
                                                                    <td height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="5"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-size: 14px; font-weight: 500; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top;"
                                                                        width="50%">
                                                                        <strong>Receiver</strong>
                                                                    </td>
                                                                    <td style="font-size: 14px; font-weight: 500; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;"
                                                                        width="50%">
                                                                        <strong>Supplier</strong>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td
                                                                        style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                        <strong>{{$fetch_data->store->store_name }}</strong>
                                                                    </td>
                                                                    <td
                                                                        style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; text-align: right; line-height: 23px;">
                                                                        <strong>{{$data->store_name}}</strong>
                                                                    </td>
                                                                </tr>

                                                           
                                                           
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                        GRN Date: {{ $fetch_data->grn_date }}</td>
                                                                    <td
                                                                        style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                        Recive Date: {{$fetch_data->recieved_date }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                    </td>
                                                                    {{-- <td
                                                                        style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                        Sale Agent:
                                                                        {{ $user->name }}({{ $user->id }})
                                                                    </td> --}}
                                                                </tr>



                                                            </tbody>
                                                        </table>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>


        <table style="background-color: transparent;" width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
            <tbody>
                <tr>
                    <td>
                        <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullTable" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                </tr>
                                <tr class="hiddenMobile">
                                    <td height="40"></td>
                                </tr>
                                <tr class="visibleMobile">
                                    <td height="40"></td>
                                </tr>
                                <tr>
                                    <td>
                                         <table width="650" border="0" cellpadding="0" cellspacing="0"
                                            align="center" class="fullPadding">
                                            <tbody>
                                                <tr style="border: 1px solid #e4e4e4;">
                                                    <th style="font-size: 13px; font-family: 'Open Sans', sans-serif; border: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        width="5%" align="left">
                                                        <strong>#</strong>
                                                    </th>
                                                    <th style="font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        width="45%" align="left">
                                                        <strong>Products</strong>
                                                    </th>
                                                    <th style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="center">
                                                        <strong>Quantity</strong>
                                                    </th>
                                                    <th style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="right">
                                                        <strong>Price</strong>
                                                    </th>
                                                    <th style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                    align="right">
                                                    <strong>Purchase Price</strong>
                                                </th>
                                                    <th style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="right">
                                                        <strong>Total Amount</strong>
                                                    </th>
                                                </tr>
                                                @foreach ($fetch_data->grn_details as $sdata)
                                                    <tr>
                                                        <td style="font-size: 13px; text-align: center; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            class="article">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            class="article">
                                                            {{ $sdata->product->title }}
                                                        </td>
                                                        <td
                                                            style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; text-align: center; border-left: 1px solid #e4e4e4;">
                                                            {{ $sdata->received_qty}}</td>
                                                        <td style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            align="right">{{ $sdata->price}}</td>
                                                            <td style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            align="right">{{ $sdata->purchase_price}}</td>
                                                        <td style="text-align: center; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            align="right"> {{ $sdata->request_qty * $sdata->purchase_price }}</td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="background-color: transparent;" width="100%" border="0" cellpadding="0" cellspacing="0"
            align="center" class="fullTable" bgcolor="#e1e1e1">
            <tbody>
                <tr>
                    <td>
                        <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullTable" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td>

                                        <!-- Table Total -->
                                        <table width="650" border="0" cellpadding="0" cellspacing="0"
                                            align="center" class="fullPadding"
                                            style="border: 1px solid #e4e4e4; padding: 11px;border-collapse: separate;">
                                            <tbody>
                                                <tr>
                                                    <td
                                                        style="font-weight: 500; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                        width="80">
                                                        ₹{{ $fetch_data->grn_details[0]->purchase_price }}
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Discount ({{ $discount->discount ?? '0' }}%)</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        -₹{{ $saledata->discount ?? '0.00' }}
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Tax ({{ $tax->tax }})</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        ₹{{ $fetch_data->tax_amount }}
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>CGST (9.00%)</strong></td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        ₹2,597.22
                                                    </td>
                                                </tr> --}}
                                                {{-- <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; padding-bottom: 7px;">
                                                        <strong>Adjustment </strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; padding-bottom: 7px;">
                                                        ₹{{ $saledata->round_off ?? '0' }}
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td
                                                        style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 31px; vertical-align: top; text-align:right; padding-right: 10px; padding-top: 7px; border-top: 1px solid #e4e4e4;">
                                                        <strong>Grand Total</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 31px; vertical-align: top; text-align:right; padding-top: 7px; border-top: 1px solid #e4e4e4;">
                                                        <strong> ₹{{ $fetch_data->total_amount }}</strong>
                                                    </td>
                                                </tr>
                                                <!--
                                <tr>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #a94442; line-height: 22px; vertical-align: top; text-align:right; "><strong>Amount Due</strong></td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #a94442; line-height: 22px; vertical-align: top; text-align:right; ">
                                      ₹24,411.71
                                  </td>
                                </tr>
          -->
                                            </tbody>
                                        </table>
                                        <!-- /Table Total -->

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="background-color: transparent;" width="100%" border="0" cellpadding="0" cellspacing="0"
            align="center" class="fullTable" bgcolor="#e1e1e1">
            <tbody>
                <tr>
                    <td>
                        <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullTable" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                </tr>
                                <tr class="hiddenMobile">
                                    <td height="60"></td>
                                </tr>
                                <tr class="visibleMobile">
                                    <td height="40"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="650" border="0" cellpadding="0" cellspacing="0"
                                            align="center" class="fullPadding">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <!-- <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="left" class="col">

                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 1; vertical-align: top; ">
                                                                        Note:
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 20px; vertical-align: top; ">
                                                                        {{-- Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book. It has survived not only five centuries. --}}
                                                                        {{-- {{ $saledata->description }} --}}
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table> -->


                                                        <!-- <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="right" class="col">
                                                            <tbody>
                                                                <tr class="visibleMobile">
                                                                    <td height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 1; vertical-align: top; ">
                                                                        Terms &amp; Conditions:
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 20px; vertical-align: top; ">
                                                                        <ul style="padding-inline-start: 17px;">
                                                                            {{-- <li>Lorem Ipsum is simply dummy text of the
                                                                                printing text of the </li>
                                                                            <li>Lorem Ipsum is simply dummy text of the
                                                                                printing text of the </li>
                                                                            <li>Lorem Ipsum is simply dummy text of the
                                                                                printing text of the </li>
                                                                            <li>Lorem Ipsum is simply dummy text of the
                                                                                printing text of the </li>
                                                                            <li>Lorem Ipsum is simply dummy text of the
                                                                                printing text of the </li> --}}
                                                                            {{-- <li>{!! $tnc->sale_tnc !!} --}}
                                                                            </li>
                                                                        </ul>
                                                                    </td>

                                                                </tr>

                                                            </tbody>
                                                        </table> -->
                                                        <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="right" class="col">
                                                            <tbody>
                                                                <tr class="visibleMobile">
                                                                    <td height="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="text-align: right; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 1; vertical-align: top; ">
                                                                        <img src={{ $data->signature }}
                                                                            alt="" style="max-width: 150px">
                                                                        <br /> <strong
                                                                            style="display: inline-block;
                                                                            margin-top: 10px;">Authorized
                                                                            Signature</strong>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr class="hiddenMobile">
                                    <td height="40"></td>
                                </tr>
                                <tr class="visibleMobile">
                                    <td height="30"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>



    </div>


</div>

{{-- <div id="cash_payment_form" style="display:none">
    <div class="container-fluid">

        <div class="row">
            <!-- end col -->

            <div class="col-xl-12">
                <div class="card card-h-100">

                    <div class="card-body">



                        <h3 id="confirm_payament">Cash Payment Form</h3>
                        <div class="text-center" id="extra_content">

                        </div>

                        <form class="needs-validation" id="offline_data" action="{{ route('cashpayment.pos') }}"
                            method="post" enctype="multipart/form-data" novalidate="">

                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{ $saledata->invoice_no }}" name="invoice_no">
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">Amount to be paid</label>
                                        <input type="text" class="form-control" name="cash_amount"
                                            id="validationTooltip01" placeholder="Amount"
                                            value="{{ $saledata->total }}" readonly>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">



                                        <label class="form-label required" for="voucher_no">Voucher/Transaction
                                            No</label>
                                        <input required type="text" class="form-control" name="voucher_no"
                                            id="voucher_no" placeholder="Voucher/Transaction No" value="">


                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="mb-3 position-relative">
                                            <label class="required" for="paymentmode">Payment Mode</label>
                                            <select class="form-select" required name="payament_mode"
                                                id="payamentmode">
                                                <option value="">Select Payment Mode</option>

                                                <option value="Cash">Cash</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                                <option value="Cheques">Cheque</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationTooltipUsername">Voucher
                                                Photocopy</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control"
                                                    id="validationTooltipUsername" name="sale_image"
                                                    placeholder="Username"
                                                    aria-describedby="validationTooltipUsernamePrepend">
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid username.
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->

                                <button class="btn btn-success"
                                    onclick="ajaxcallnoredirect_javascript('offline_data')" type="button">Update
                                    Payment</button>
                        </form><!-- end form -->


                    </div><!-- end card body -->
                </div><!-- end card -->
            </div> <!-- end col -->
        </div><!-- end row -->

    </div>
</div> --}}
<!-- <div class="modal fade" id="cash-payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=""></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="">
            </div>
        </div>
    </div>
</div>  -->

 <!-- <script
src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
crossorigin="anonymous"></script>
<script>
  
    jQuery(document).ready(function () {
        alert("test");
        jQuery("#cash_payment852").click(function() {
            //console.log("hiiii");
            alert('hiiii');
            //$('#cash-payment').show();

        });
    });
    </script> -->
 </html> 
<script>
    window.print();
</script>
