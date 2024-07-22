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
                                    <h5>Mailing List for Contract Signing</h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <form class="form-horizontal" method="POST" action="{{ route('sendmail_cselect') }}" accept-charset="utf-8" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Email</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Date</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Time</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Venue</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Instruction</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Action</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($mailslist as $app) :

                                        ?>
                                            <tr>
                                                <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->appID)->value('cid'); ?></td>
                                                <td style="font-size: 14px;"><?php echo App\Models\FundingApplication::where('id', $app->appID)->value('name'); ?></td>
                                                <td style="font-size: 14px;"><?php echo $email = App\Models\FundingApplication::where('id', $app->appID)->value('email'); ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->sign_date; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->sign_time; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->venue; ?></td>
                                                <td style="font-size: 14px;"><?php echo $app->instructions; ?></td>
                                                <td style="font-size: 14px;">
						                        @if($app->sent == '0')
                                                 <a href="{{ route('sendmail_c', array($email, $app->sign_date, $app->sign_time, $app->appID, $fid, $cohortopen, $no, $key))}}" class="btn btn-primary  btn-sm pull-right">Send Mail</a>

                                                 @endif
                                                 @if($app->sent == '1')
                                                 <font color = "red">Sent on {{$app->senton}}</font>
                                                 @endif
                                                </td>
                                                <td style="font-size: 14px;">
                                                <input type="checkbox" id="pmail" name="pmail[]" value="<?php echo $app->appID; ?>" multiple="multiple">
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                        <tr><td colspan="9"></td><td>
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

<div class="modal fade" id="addRoleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('mailattachment') }}" accept-charset="utf-8" enctype="multipart/form-data" >
          {{ csrf_field() }}
          <input type="hidden" name="cohortopen" value="{{ $cohortopen }}">
          <input type="hidden" name="cohortopenno" value="{{ $no }}">


                    <div class="form-group">
                        <label class="col-md-6 control-label">Attachment<font color="red">*</font></label>
                        <div class="col-md-6">
                            <input id="form_name" type="file" name="attachment[]" class="form-control" required>
                        </div>
                    </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

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

