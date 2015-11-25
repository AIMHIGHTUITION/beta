<?php
include('mpdf.php');
$mpdf=new mPDF();
$mpdf->Bookmark('Start of the document');

$mpdf->WriteHTML("<!DOCTYPE html><html lang='en'>  <head>	<!--<base href='http://reyvillamar.info/demo/slvprice/responsive//demo/responsive-tables/'>--><!--[if lte IE 6]></base><![endif]-->    <meta charset='utf-8'>
    <title>Responsive Tables Demo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='A demo of some techniques for developing responsive tables.'>
    <link href='http://reyvillamar.info/demo/slvprice/responsive/assets/css/bootstrap.min.css' rel='stylesheet'>
	<style>body { padding-top: 60px; }
	  table { width: 100%; }
	  td, th {text-align: left; white-space: nowrap;}
	  td.numeric, th.numeric { text-align: right; }
	  h2, h3 {margin-top: 1em;}
	  section {padding-top: 40px;}
    </style>
    <link href='http://reyvillamar.info/demo/slvprice/responsive/assets/css/bootstrap-responsive.min.css' rel='stylesheet'>
	<link href='http://reyvillamar.info/demo/slvprice/responsive/assets/css/unseen.css' rel='stylesheet'>
	<link href='http://reyvillamar.info/demo/slvprice/responsive/assets/css/flip-scroll.css' rel='stylesheet'>
	<link href='http://reyvillamar.info/demo/slvprice/responsive/assets/css/no-more-tables.css' rel='stylesheet'>
	<link href='http://reyvillamar.info/demo/slvprice/responsive/assets/css/prettify.css' rel='stylesheet'>
	
    <!--[if lt IE 9]>
      <script src='//html5shim.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->
  </head>
  <body style='margin-left:50px;margin-right:50px;margin-top:-30px;'>
   	  <section id='no-more-tables'>
   	  <img src='http://reyvillamar.info/demo/slvprice/images/rey_header.png' style='width:100%;' />
	
		  <br/><br/>
Warm greetings from SLV Digital Solution Co.!
<br/><br/>

It is our great joy to present to you our products/services for your organization. As per your requirements, please see the quotation below for your satisfaction. Our group is always ready to extend its full flexibility to meet the demands of our client for better and excellent service.

</p>
		  <table class='table-bordered table-striped table-condensed cf'>
			  <thead class='cf'>
				  <tr>
					    <th>Particular</th>
					  <th class='numeric'>Quantity</th>
					  <th class='numeric'>Price</th>
					  <th class='numeric'>Total</th>                                             
				  </tr>
			  </thead>
				<tbody>
					
				 </table>
<p>		  
<br/>

Should you find our offer attractive and merit your consideration, we are willing to make actual presentation of sample and our terms of contract. If you also want other services, we are willing to make quotation as you request us to do so.
<br/>
<br/>


Thank you for giving us opportunity to offer our services and express our passion for excellence. We’re waiting for your favorable response.
Sincerely Yours,
<br/>
<br/>

Rey Villamar
<hr>
<br/>

Terms and conditions upon agreed:
<br/><br/>
1. SLV Digital Solution Co. shall provide a detailed Services Agreement and the Client shall forward a Purchased Order.
<br/><br/>
2. Once the Client orders the Products/Services and agrees on the terms and conditions provided by the Supplier, payment shall be given for the 50% of the total amount of the Products/Services, then the remaining 50% as complete payment shall be given upon the delivery of the Products/Services.
<br/>
<br/>

<p style='color: red;'>
SLV BANK ACCOUNT:<br/>
BANK: BDO SM VALENZUELA<br/>
ACCOUNT NAME: SLV DIGITAL SOLUTION CO.<br/>
ACCOUNT NUMBER: 002090418229<br/>
</p>
3.  The Supplier shall deliver the Products/Services within a maximum of 15 working days (Saturdays and Sundays not included) upon giving the down payment.

</p>
<img src='http://reyvillamar.info/demo/slvprice/images/total_quality_service.png' style='height:100px;' />
	  </section>
    </div> <!-- /container -->

    <script src='assets/js/jquery-1.7.1.min.js'></script>
    <script src='assets/js/bootstrap.min.js'></script>
	<script src='assets/js/prettify.js'></script>
	<script>
		$(function(){
			prettyPrint();
		});
	</script>
	

	<script type='text/javascript'>
	<!--//--><![CDATA[//><!--
	try {var pageTracker = _gat._getTracker('UA-55411-1');pageTracker._trackPageview();} catch(e) {}
	//--><!]]>
	</script>
	
  </body>
</html>");

$mpdf->Output();

?>