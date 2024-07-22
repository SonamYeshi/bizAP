<x-app-layout>
    @include('top_nav_bar_applicant')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                        @include('flash-message')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Update Payment</h5>
                                </div>

                            <form class="row g-3" role="form" method="POST" action="{{ route('insertpayment') }}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                                  <input type="hidden" name="fundid" value="{{$fundid}}" />
                                  <input type="hidden" name="year" value="{{$year}}" />
                                  <input type="hidden" name="month" value="{{$month}}" />
                                  <input type="hidden" name="emi" value="{{$emi}}" />
                                  <input type="hidden" name="duedate" value="{{$ddate}}" />
                                  <?php foreach ($allapplication as $app) :?>

                                  <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Payment Amount:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="PaymentAmount" value="{{$emi}}" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Payment Mode:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                <select class='form-control' required name="PaymentMode">
                                    <option value="Deposit to Bank" <?php if($app->payment_mode == "Deposit to Bank") { ?> selected <?php } ?> >Deposit to Bank</option>
                                    <option value="mBOB" <?php if($app->payment_mode == "mBOB") { ?> selected <?php } ?>>mBOB</option>
                                    <option value="mPay" <?php if($app->payment_mode == "mPay") { ?> selected <?php } ?>>mPay</option>
                                    <option value="Inter Bank Transfer" <?php if($app->payment_mode == "Inter Bank Transfer") { ?> selected <?php } ?>>Inter Bank Transfer</option>
                                    <option value="Cheque Deposit" <?php if($app->payment_mode == "Cheque Deposit") { ?> selected <?php } ?>>Cheque Deposit</option>
                                </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Date of Deposit:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="DateofDeposit" value="{{$app->date_of_deposit}}" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Cheque Date:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="ChequeDate" value="{{$app->cheque_date}}" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Cheque Number:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" value="{{$app->cheque_number}}" name="ChequeNumber" >
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Reference No / Transaction No.:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$app->reference_no_transaction_no}}" name="ReferenceNo">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Attach Proof:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                <?php $pathid = App\Models\PaymentDocs::where('paymentid', $pid)->value('doc_path'); ?>
                                @if($pathid != '')
                                <a href="{{ asset("storage/$pathid") }}" target="_blank"><i class="bi bi-file-pdf"></i>view Proof Document</a>
                                @else
                                No Document
                                @endif
                                <input type="file" class="form-control" id="customFile" name="proof[]" />
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Apply ?")'>Submit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                            </form>
                            <br><br>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
