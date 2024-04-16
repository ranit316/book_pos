{{-- <!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Order confirmation </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" /> --}}
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
<div id="main_bill">
    <div id="content_print">
        <!-- Header -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="">
            <tr>
                <td height="20"></td>
            </tr>
            <tr>
                <td>
                    <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff" style="">
                        <tr class="hiddenMobile">
                            <td height="40"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="30"></td>
                        </tr>

                        <tr>
                            <td>
                                <table width="650" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                    align="left" class="col">
                                                    <tbody>
                                                        {{-- <tr>
                                                  
                                                    <h5
                                                        style="margin-bottom:30px; font-size: 18px; font-weight: 500; color: #6b10f4; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: center;"
                                                       > <span
                                                            style="display: block; margin-bottom: 5px;"></span>
                                                        <strong>{{ $due_message }}</strong></h5>
                                                     
                                                </tr> --}}
                                                        <tr>

                                                            <td align="left"
                                                                style="font-size: 18px; font-weight: 500; color: #6b10f4; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;"
                                                                width="50%"> <span
                                                                    style="display: block; margin-bottom: 5px;">Sales
                                                                    Invoice</span>
                                                                <strong>#{{ $saledata->invoice_no }}</strong>
                                                            </td>

                                                            <td align="right"><img src={{ $logo->logo }}
                                                                    width="200">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="40"></td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                    align="right" class="col">
                                                    <tbody>
                                                        <tr class="visibleMobile">
                                                            <td height="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5"></td>
                                                        </tr>

                                                        <td>
                                                            <tr>
                                                                <td style="font-size: 14px; font-weight: 500; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top;"
                                                                    width="50%">
                                                                    <strong>Customer</strong>
                                                                </td>
                                                                <td style="font-size: 14px; font-weight: 500; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;"
                                                                    width="50%">
                                                                    <strong>Biller</strong>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                    <strong>{{ $saledata->customer->name }}</strong>
                                                                </td>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; text-align: right; line-height: 23px;">
                                                                    <strong>{{ $billing_header->store->store_name }}</strong>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                    @foreach ($addressLines as $addressLine)
                                                                        {{ $addressLine }}
                                                                    @endforeach
                                                                    <br>
                                                                    @foreach ($stateLine as $stateLine)
                                                                        {{ $stateLine }}
                                                                    @endforeach
                                                                </td>
                                                                <td width="100"
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; text-align: right; line-height: 23px;">
                                                                    {{ $billing_header->value }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                    {{ $saledata->customer->phone }}</td>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                    {{ $saledata->sale_date }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                    {{ $saledata->customer->email }}</td>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                    {{-- Due Date: 2023-11-03 --}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px;">
                                                                </td>
                                                                <td
                                                                    style="font-size: 13px; color: #1a1919; font-family: 'Open Sans', sans-serif; line-height: 23px; vertical-align: top; text-align: right;">
                                                                    Sale Agent:
                                                                    {{ $user->name }}({{ $user->id }})
                                                                </td>
                                                            </tr>
                                                        </td>


                                                    </tbody>
                                                </table>
                                            </td>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- /Header -->
        <!-- Order Details -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
            bgcolor="">
            <tbody>
                <tr>
                    <td>
                        <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullTable" bgcolor="#ffffff">
                            <tbody>
                                <tr>
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
                                                        <strong>Item</strong>
                                                    </th>
                                                    <th style="font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="center">
                                                        <strong>Qty</strong>
                                                    </th>
                                                    <th style="font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="right">
                                                        <strong>Rate</strong>
                                                    </th>
                                                    <th style="font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="right">
                                                        <strong>HSN Code</strong>
                                                    </th>
                                                    <th style="font-size: 13px; font-family: 'Open Sans', sans-serif; border-right: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; color: #1a1919; font-weight: normal; line-height: 1; vertical-align: top; padding: 8px 10px;"
                                                        align="right">
                                                        <strong>Amount</strong>
                                                    </th>
                                                </tr>
                                                @foreach ($saledata->saledetails as $sdata)
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
                                                            {{ $sdata->qty }}</td>
                                                        <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            align="right">{{ $sdata->product->price }}</td>
                                                        <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4;"
                                                            align="right">-</td>
                                                        <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-left: 1px solid #e4e4e4; border-right: 1px solid #e4e4e4;"
                                                            align="right">{{ $sdata->total_amount }}</td>

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
        <!-- /Order Details -->
        <!-- Total -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
            bgcolor="">
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
                                            style="border: 1px solid #e4e4e4; padding: 11px;">
                                            <tbody>
                                                <tr>
                                                    <td
                                                        style="font-weight: 500; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                        width="80">
                                                        <img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>{{ $saledata->sub_total }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Discount ({{ $discount->discount ?? '0' }}%)</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        -<img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>{{ $saledata->discount ?? '0.00' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Tax ({{ $tax->tax }})</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>{{ $saledata->total_tax }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <strong>Shipping Charge</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; ">
                                                        <img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>0.00
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; padding-bottom: 7px;">
                                                        <strong>Adjustment </strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 27px; vertical-align: top; text-align:right; padding-bottom: 7px;">
                                                        <img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>{{ $saledata->round_off ?? '0' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 31px; vertical-align: top; text-align:right; padding-right: 10px; padding-top: 7px; border-top: 1px solid #e4e4e4;">
                                                        <strong>Grand Total</strong>
                                                    </td>
                                                    <td
                                                        style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 31px; vertical-align: top; text-align:right; padding-top: 7px; border-top: 1px solid #e4e4e4;">
                                                        <strong> <img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>{{ $saledata->total }}</strong>
                                                    </td>
                                                </tr>
                                                <!--
                          <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #a94442; line-height: 22px; vertical-align: top; text-align:right; "><strong>Amount Due</strong></td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #a94442; line-height: 22px; vertical-align: top; text-align:right; ">
                                <img height="10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAZBAMAAAAlENikAAAAMFBMVEUAAAD///8fHx/39/cqKipiYmI9PT2VlZVwcHBXV1eBgYHLy8uqqqrm5ubr6+vf398JfM5GAAAAEHRSTlP/AP//////////////////0XJbHgAAAAlwSFlzAAAdhwAAHYcBj+XxZQAAAHhJREFUCNddzrENwgAMAMEPgoCo/ESR0gQYASQGCCuwARuQteiyAaNR2FVcXfO2ObGeQJ3YaaBeQINOuw+zQayDTaAazFl4416a2tryoNFg+L7Yam5pl9LT7Hv2Ja8spaApnak7+uNd6jmWsgk0m0Ad83vNJjVwMP6bZRHNoykkkgAAAABJRU5ErkJggg=="/>24,411.71
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
        <!-- /Total -->
        <!-- Information -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
            bgcolor="">
            <tbody>
                <tr>
                    <td>
                        <table width="750" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullTable" bgcolor="#ffffff">
                            <tbody>
                                <tr>
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
                                                        <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="left" class="col">

                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 1; vertical-align: top; ">
                                                                        <strong>Note:</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 20px; vertical-align: top; ">
                                                                        {{-- Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley of type and
                                                                scrambled it to make a type specimen book. It has
                                                                survived not only five centuries. --}}
                                                                        {{ $saledata->description }}
                                                                    </td>
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
                                                                    <td width="100%" height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 1; vertical-align: top; ">
                                                                        <strong>Terms & Conditions:</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 20px; vertical-align: top; ">
                                                                        <ul style="padding-inline-start: 17px;">
                                                                            <li>{!! $tnc->purchase_tnc !!}
                                                                            </li>
                                                                            {{-- <li>Lorem Ipsum is simply dummy text of the printing
                                                                    </li>
                                                                    <li>Lorem Ipsum is simply dummy text of the printing
                                                                    </li>
                                                                    <li>Lorem Ipsum is simply dummy text of the printing
                                                                    </li>
                                                                    <li>Lorem Ipsum is simply dummy text of the printing
                                                                    </li> --}}
                                                                        </ul>
                                                                    </td>

                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                        <table width="100%" border="0" cellpadding="0"
                                                            cellspacing="0" align="right" class="col">
                                                            <tbody>
                                                                <tr class="visibleMobile">
                                                                    <td height="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="40"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 1; vertical-align: top; ">
                                                                        <strong>Authorized
                                                                            Signature
                                                                        </strong><img
                                                                            src={{ $billing_header->store->signature }}
                                                                            width="100">
                                                                    </td>
                                                                </tr>

                                                        </table>
                                            </tbody>


                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>


                <tr class="hiddenMobile">
                    <td height="60"></td>
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
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
        <tbody>
            <tr class="visibleMobile">
                <td height="30"></td>
            </tr>
            <tr>
                <td width="100%" height="40"></td>
            </tr>

            <tr>
                <td>
                    <button type="button" class="btn btn-primary me-4 mt-5" id="cash_payment85225"
                        onclick="cash_sale();">Cash
                        Payment</button>
                    <button type="button" class="btn btn-success mt-5">Online
                        Payment</button>
                    <button type="button" class="btn btn-primary me-4 mt-5" id="" onclick="printthispage();">Print Bill</button>
                <td>
            </tr>
    </table>
</div>

<div id="cash_payment_form" style="display:none">
    <div class="container-fluid">

        <div class="row">
            <!-- end col -->

            <div class="col-xl-12">
                <div class="card card-h-100">

                    <div class="card-body">
                        <form class="needs-validation" action="{{ route('cashpayment.pos') }}" method="post"
                            enctype="multipart/form-data" novalidate="">
                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{ $saledata->invoice_no }}" name="invoice_no">
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">Amount</label>
                                        <input type="text" class="form-control" name="cash_amount"
                                            id="validationTooltip01" placeholder="Amount"
                                            value="{{ $saledata->total }}" readonly>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">Voucher No</label>
                                        <input type="text" class="form-control" name="voucher_no"
                                            id="validationTooltip02" placeholder="Last name" value=""
                                            required="">
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">Vouchar
                                            Image</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="validationTooltipUsername"
                                                name="sale_image" placeholder="Username"
                                                aria-describedby="validationTooltipUsernamePrepend" required="">
                                            <div class="invalid-tooltip">
                                                Please choose a unique and valid username.
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form><!-- end form -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div> <!-- end col -->
        </div><!-- end row -->

    </div>
</div>
{{-- <div class="modal fade" id="cash-payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
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
</div> --}}

{{-- <script
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
    </script> --}}

{{-- </html> --}}
