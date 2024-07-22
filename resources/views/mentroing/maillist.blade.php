<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-5">
			          @include('flash-message')
                        @include('sweetalert::alert')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5>Mailing List for Mentoring</h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <form class="form-horizontal" method="POST" action="{{ route('sendmail_mselect') }}" accept-charset="utf-8" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>CID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                            <th>Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($allapplication as $app) :
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $app->cid; ?></td>
                                                <td><?php echo $app->name; ?></td>
                                                <td><?php echo $email = $app->email; ?></td>
                                                <td>

						                        @if($sent == '0')
                                                 <a href="{{ route('sendmail_m', array($mid, $email))}}" class="btn btn-success btn-sm">Send Mail</a>
                                                 @endif
                                                 @if($sent == '1')
                                                 <font color = "red">Sent</font>
                                                 @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" name="mid" value="{{$mid}}">
                                                 <input type="checkbox" id="pmail" name="pmail[]" value="<?php echo $app->id; ?>" multiple="multiple">
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                        <tr><td colspan="5"></td><td>
                                        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure Send the mails ?")'>Send</button>
                                        </td></tr>
                                    </tbody>
                                </table>
                            </form>
                            </div>
                           </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script src="jquery.js"></script>
<script src="jquery_tables.js"></script>
<link href="{{ asset('css/app_tables.css') }}" rel="stylesheet">
<script>
     $(document).ready(function() {
    $('#example').DataTable();
} );
$(window).load(function(){
   setTimeout(function(){ $('.alert-success').fadeOut() }, 5000);
});
</script>

