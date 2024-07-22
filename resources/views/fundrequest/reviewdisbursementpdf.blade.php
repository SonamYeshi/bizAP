<html>

<head>
</head>

<body>
<img class="img-responsive" src="headd.JPG" style="margin-left: -100px; marging-top: 25px;">
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex-shrink-0 flex items-center" >

		</div>
 <hr>
                <div class="container">
                    <div class="row">
                        <div class="flex-shrink-0 flex items-center">
                        <h5><b><center>Disbursement Order</center></b></h5>
                        </div>
<p>
    DHI/DOI/7/<?php echo date('Y'); ?>/
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    Date:
</p>

<p>Head,<br>

Credit Operations,<br>

Bank of Bhutan Limited,<br>

Thimphu.</p>


<p><strong>Subject: Disbursement order for the DHI Business Acceleration Fund.</strong></p>



<p>Dear Madam / Sir,</p>



<p>With reference to the agreement signed and the DHI Business Acceleration Fund managed by Bank of Bhutan, kindly maintain a Financing account and make a disbursement with the following details.</p>



<table>
<tbody>
<?php foreach($allapplication as $app): ?>
    <tr>
<td style="width: 36.4421%;">&nbsp;FDO No. 1:</td>
<td style="width: 55.4404%;">&nbsp;<b>DHI Business Acceleration Fund account no: 201669417</b></td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Name of Entrepreneur:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->name}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;CID No:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->cid}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Financing Account No.:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->financing_account_no}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Mobile No.:</td>
<td style="width: 55.4404%;">&nbsp;{{$app->mobileno}}</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Total Approved Amount.:</td>
<td style="width: 55.4404%;">&nbsp;&nbsp;Nu.
<?php echo number_format($app->total_disbursed, 0);?>
/- (Five Lakhs) only
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Tranche: (Figure and Words)</td>
<td style="width: 55.4404%;">&nbsp;&nbsp;Nu.
<?php echo number_format($app->actual_disbursed, 0);?>/-
(Nu. <?php echo App\Models\FundRequest::where('id', $id)->value('tranche');?>)
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Entrepreneur (Fund Release to (Business Name  / License No):</td>
<td style="width: 55.4404%;">&nbsp;
{{$app->name}} &nbsp; ({{$app->business_name}}) <br>&nbsp; {{$app->business_licence_no}}
</td>
</tr>
<tr>
<td style="width: 36.4421%;">&nbsp;Entrepreneur (Fund Release bank account details):</td>
<td style="width: 55.4404%;">&nbsp; {{$app->bank_account_no}},&nbsp;{{$app->bank}}
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<p>The above may kindly be debited to our DHI Business Acceleration Fund A/c No. 201669417 maintained<br>
with Bank of Bhutan, Thimphu. <br>You are requested to arrange the above at the earliest.</p>

<p>Thanking you,</p>

<p>Yours sincerely,</p>
<p>&nbsp;</p>
<p>({{ $ad }})&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;


    &nbsp; &nbsp;  &nbsp; &nbsp;({{ $accounthead }})<br>
     Associate Director&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      Head of Accounts<br>

     DOI, DHI&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

     DOF, DHI</p>
</div>
                </div>
            </div>
        </div>
    </div>
<hr>
    <center>
<p style="font-size:12px; color: #808080;">P.O.Box 1127 Motithang, Thimphu: Bhutan Tel: +975 2 336257/58 Fax: +975 2 336259
<br><u>www.dhi.bt</u></p></center>
</body>

</html>
<style>
    table {
    border-collapse: collapse;
}

td, th {
    border: 1px solid black;
    padding: 3px;
}
</style>




