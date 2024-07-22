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
                                    <h5>Update Information</h5>
                                </div>

                            <form class="row g-3" role="form" method="POST" action="{{ route('postupdate') }}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                                  <input type="hidden" name="userid" value="{{$userid}}" />
                                  <input type="hidden" name="fundid" value="{{$fundappid}}" />
                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Business License Number:<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="blno" placeholder="Enter Business License Number" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Bank:<font color="red">*</font></label>
                                <div class="col-sm-10">
                                <select name="bank" class="form-control" required>
                                   <option>--select--</option>
                                      <option value="BOBL">BOBL</option>
                                       <option value="BNBL">BNBL</option>
                                       <option value="BDBL">BDBL</option>
                                        </select>
                                  </div>
                            </div>
                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Bank Account Number:<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="bano" placeholder="Enter Bank Account Number" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="{{$email}}" name="email">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Phone Number:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="{{$mobileno}}" name="mobileno">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Apply ?")'>Submit</button>
                               <a  href="{{ route('dashboard') }}"><button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button></a>
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
