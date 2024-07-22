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

                            <form class="row g-3" role="form" method="POST" action="{{ route('insertpaymentdhi') }}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                                  <input type="hidden" name="fundid" value="{{$fundid}}" />
                                  <input type="hidden" name="cid" value="{{$cid}}" />
                                  <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">EMI Amount:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="PaymentAmount" value="{{ $emi }}" required >
                                    <?php if($penalty != '0'){ ?><font color = 'red'>Penalty: {{ $penalty }}</font> <?php }?>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Payment Mode:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                <select class='form-control' required name="PaymentMode">
                                    <option value="Deposit to Bank" >Deposit to Bank</option>
                                    <option value="mBOB" >mBOB</option>
                                    <option value="mPay" >mPay</option>
                                    <option value="Inter Bank Transfer" >Inter Bank Transfer</option>
                                    <option value="Cheque Deposit" >Cheque Deposit</option>
                                </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Date of Payment/Deposit:<font color="red">*</font></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="DateofDeposit" placeholder="Enter Date of Deposit" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Cheque Date:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="ChequeDate" placeholder="Enter Cheque Date" >
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Cheque Number:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" placeholder="Enter Cheque Number" name="ChequeNumber" >
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Reference No / Transaction No.:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="" name="ReferenceNo">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Attach Proof:</label>
                                <div class="col-sm-8">
                                <input type="file" class="form-control" id="customFile" name="proof[]" />
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Submit ?")'>Submit</button>
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
