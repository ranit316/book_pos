<html lang="en"><head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Customer Order has been placed</title>
  <style media="all" type="text/css">
@media all {
.btn-primary table td:hover {
  background-color: #ec0867 !important;
}

.btn-primary a:hover {
  background-color: #ec0867 !important;
  border-color: #ec0867 !important;
}
}
@media only screen and (max-width: 640px) {
.main p,
.main td,
.main span {
  font-size: 16px !important;
}

.wrapper {
  padding: 8px !important;
}

.content {
  padding: 0 !important;
}

.container {
  padding: 0 !important;
  padding-top: 8px !important;
  width: 100% !important;
}

.main {
  border-left-width: 0 !important;
  border-radius: 0 !important;
  border-right-width: 0 !important;
}

.btn table {
  max-width: 100% !important;
  width: 100% !important;
}

.btn a {
  font-size: 16px !important;
  max-width: 100% !important;
  width: 100% !important;
}
}
@media all {
.ExternalClass {
  width: 100%;
}

.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}

.apple-link a {
  color: inherit !important;
  font-family: inherit !important;
  font-size: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
  text-decoration: none !important;
}

#MessageViewBody a {
  color: inherit;
  text-decoration: none;
  font-size: inherit;
  font-family: inherit;
  font-weight: inherit;
  line-height: inherit;
}
}
</style>
</head>
<body style="font-family: Helvetica, sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.3; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #e1e1e1; margin: 0; padding: 0;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: transparent; width: 100%; " width="100%">
    <tbody><tr>
      <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
      <td class="container" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; max-width: 600px; padding: 0; padding-top: 24px; width: 600px; margin: 0 auto;" width="600" valign="top">
        <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 600px; padding: 0;">

         
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border: 1px solid #eaebed; border-radius: 16px; width: 100%; padding: 24px;" width="100%">

            <!-- START MAIN CONTENT AREA -->
            <tbody><tr>
              <td class="wrapper" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding-bottom: 15px; border-bottom: 1px solid #e4e4e4;" valign="top">
                  <img src="https://www.prestorewardsapp.com/ica_book_pos/public/assets/images/logo-lg.svg" width="200">
                
                <a href="#" target="_blank" style="float: right; margin-top: 12px;"> www.ica-bookstore.gov.in </a>
                
              </td>
                <td class="wrapper" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding-bottom: 15px; border-bottom: 1px solid #e4e4e4;" valign="top">
                
                
               
                
              </td>
            </tr>
               <tr>
                  <td height="30"></td>
              </tr>
              <tr>
                  <td tyle="padding-bottom: 15px; border-top: 1px solid #e4e4e4;">
                    <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px;">Dear {{$maildata['name']}},</p>
                      <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px; margin-top: 10px;">Thank you for your recent purchase at I&CA Book Store. We're excited to confirm that your order has been successfully processed. Below are the details:
                        {{$maildata['title']}}</p>
                  </td>
              </tr>
              <tr>
                  <td height="20"></td>
              </tr>
              <tr>
                  
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                <tbody>
                  <tr>
                    <td height="10" colspan="4"></td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Order Id :</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['invoice_no']}}</td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Date :</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['sale_date']}}</td>
                  </tr>
                    <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Total Amount :</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['total']}}</td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Store Name :</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right"></td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Mode of Payment :</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['sale_mode']}}</td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
              
               <tr>
                  <td height="20"></td>
              </tr>
              
                <tr>
                  <td>
                      <p>Please find your invoice attached for your reference.</p>
                      <p>If you have any questions or concerns regarding your order, feel free to contact us at support@wbicabooks.com. We're here to ensure your satisfaction.</p>
                      <p>We would also greatly appreciate your feedback on your shopping experience. Please take a moment to share your thoughts by clicking https://www.wbicabooks.com/share-feedback?orderid[orderno].</p>
                      <p>Thank you for choosing I&CA Book Store</p>
                  </td>
              </tr>
              <tr>
                <td>
                    <p>Best Regards,</p>
                    <p>I&amp;CA Department, <br> Govt. of West Bengal</p>
                </td>
              </tr>
              
              
              {{-- <tr>
                  <td style="text-align: center;">
                      <a href="#" style="text-align: center;
                              display: inline-block;
                              background: #1877f2;
                              padding: 10px 16px;
                              color: #fff;
                              border-radius: 5px;
                              text-decoration: none;
                              margin-top: 25px;">Get More Details</a> 
                  </td>
              </tr> --}}
              
              <tr>
                  <td height="40"></td>
              </tr>
              
              <tr>
                  <td style="padding-top: 15px; border-top: 1px solid #e4e4e4; text-align: center;">
                  <span style="padding-right:12px;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif">Contact Us:</span>
                  <span style="color:#141823;font-size:14px;font-weight:normal;line-height:24px;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif"><a style="color:#1b74e4;text-decoration:none" href="">E: support.ica.govt@gmail.com</a></span>
                  <span style="padding:0 12px;color:#c9ccd1;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif"> | </span>
                  <span style="color:#141823;font-size:14px;font-weight:normal;line-height:24px;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif"><a style="color:#1b74e4;text-decoration:none" href=""></a></span>
                  </td>
              </tr>
              
         

            <!-- END MAIN CONTENT AREA -->
            </tbody></table>

          <!-- START FOOTER -->
          <div class="footer" style="clear: both; padding-top: 24px; text-align: center; width: 100%;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
              <tbody><tr>
                <td class="content-block" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; padding-bottom: 10px; font-size: 16px; text-align: center;" valign="top" align="center">
                  <span class="apple-link" style="color: #9a9ea6; font-size: 15px; text-align: center;">© All Rights Reserved by I&amp;CA Department, Govt. of West Bengal</span>
                  
                </td>
              </tr>
              <tr>
                <td class="content-block powered-by" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center; margin-top: 20px;" valign="top" align="center">
                  
                  <a href="" class="text-small" target="_blank" style="color: #9a9ea6; font-size: 15px; text-align: center; text-decoration: none;">Privacy Policy</a> | 
                  
                  <a href="" class="text-small" target="_blank" style="color: #9a9ea6; font-size: 15px; text-align: center; text-decoration: none;">Terms &amp; Conditions</a> |
                   
                  <a href="" class="text-small" target="_blank" style="color: #9a9ea6; font-size: 15px; text-align: center; text-decoration: none;">Unsubscribe Us</a>
                  
                    
                </td>
              </tr>
            </tbody></table>
          </div>

          <!-- END FOOTER -->
          
<!-- END CENTERED WHITE CONTAINER --></div>
      </td>
      <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
    </tr>
  </tbody></table>


</body></html>