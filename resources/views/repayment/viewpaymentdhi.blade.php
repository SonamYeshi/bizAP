<x-app-layout>
    @include('top_nav_bar')
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

                            <form class="row g-3" role="form" method="POST" action="{{ route('paymentreview') }}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             <input type="hidden" name="pid" value="{{$pid}}" />
                             <input type="hidden" name="fundid" value="{{$fundid}}" />
                             <input type="hidden" name="cid" value="{{$cid}}" />
                             <input type="hidden" name="key" value="{{$key}}" />
                                   <?php foreach ($allapplication as $app) :?>

                                  <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Payment Amount:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="PaymentAmount" value="{{ $app->emi_amount }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Payment Mode:</label>
                                <div class="col-sm-8">
                                <select class='form-control' required name="PaymentMode" disabled>
                                    <option value="Deposit to Bank" <?php if($app->payment_mode == "Deposit to Bank") { ?> selected <?php } ?> >Deposit to Bank</option>
                                    <option value="mBOB" <?php if($app->payment_mode == "mBOB") { ?> selected <?php } ?>>mBOB</option>
                                    <option value="mPay" <?php if($app->payment_mode == "mPay") { ?> selected <?php } ?>>mPay</option>
                                    <option value="Inter Bank Transfer" <?php if($app->payment_mode == "Inter Bank Transfer") { ?> selected <?php } ?>>Inter Bank Transfer</option>
                                    <option value="Cheque Deposit" <?php if($app->payment_mode == "Cheque Deposit") { ?> selected <?php } ?>>Cheque Deposit</option>
                                </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Date of Deposit:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="DateofDeposit" value="{{ $app->payment_date }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Cheque Date:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="ChequeDate" value="{{$app->cheque_date}}" disabled>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Cheque Number:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" value="{{$app->cheque_number}}" name="ChequeNumber" disabled >
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Reference No / Transaction No.:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$app->reference_no_transaction_no}}" name="ReferenceNo" disabled>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Attach Proof:</label>
                                <div class="col-sm-8">
                                <?php

                            $docs = App\Models\PaymentDocs::where('paymentid', $pid)->get();
                            $dcount = count(App\Models\PaymentDocs::where('paymentid', $pid)->get()); ?>
                            @if($dcount == 0)
                            <font color="red">No Documents Found </font>
                            @else
                            <?php $did = 1; ?>
                            @foreach($docs as $d)
                            <?php $filename = $d->file_name; ?>
                            <a href="{{ url('/uploads/paymentsdocs/'.$filename) }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                            @endforeach
                            @endif
                                </div>
                            </div>
                            <hr>
                            <center><h5>Review Details</h5></center>
                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Review Status<font color="red">*</font></label>
                                <div class="col-sm-8">
                                <select class='form-control' required name="ReviewStatus" >
                                    <option value="" >Select one</option>
                                    <option value="1" >Accepted</option>
                                    <option value="2" >Rejected</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Remarks</label>
                                <div class="col-sm-8">
                                <textarea class="form-control" id="challenge" name="remarks" rows="3"></textarea>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")'>Save</button>
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
