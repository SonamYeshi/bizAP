<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                    <nav class="navbar navbar-light bg-light">
                    <strong>Mentoring Session Details Form</strong>
                    </nav>
                        <form class="row g-3" role="form" method="POST" action="{{ route('addmentoring') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Support Type<font color="red">*</font></strong></label>
                                <select class='form-control' name="SupportType" required >
                                <option value="Option one" selected>-- Selec one --</option>
                                    <option value="Mentoring" >Mentoring</option>
                                    <option value="Training" >Training</option>
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Start Date<font color="red">*</font></strong></label>
                                <input id="form_name" type="date" name="StartDate" class="form-control" >
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>End Date<font color="red">*</font></strong></label>
                                <input id="form_name" type="date" name="EndDate" class="form-control" >
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Mentor<font color="red">*</font></strong></label>
                                <input id="form_name" type="text" name="Mentor" class="form-control" >
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>No. of Partipants<font color="red">*</font></strong></label>
                                <input id="form_name" type="number" name="NoofPartipants" class="form-control" >
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Objective<font color="red">*</font></strong></label>
                                <textarea class="form-control" id="challenge" name="Objective" rows="3"></textarea>
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Requirements<font color="red">*</font></strong></label>
                                <textarea class="form-control" id="challenge" name="Requirements" rows="3"></textarea>
                            </div>

                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>CV of the Mentor</strong></label>
                                <input type="file" class="form-control" id="customFile" name="CVoftheMentor[]"/>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")'>Save</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Add Site Visit Date and Time</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('sitevisitadd') }}" enctype="multipart/form-data">

      {{ csrf_field() }}
      <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Mode<font color="red">*</font></label>
        <div class="col-xs-6">
        <select id = "ddlPassport" onchange = "ShowHideDiv()" class="form-control form-control-sm" name="mode" required>
         <option value="">-- Select One --</option>
         <option value="virtual">Virtual</option>
         <option value="inperson">In person</option>
        </select>
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Date<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="date" class="form-control form-control-sm" id="pptdate" name="svdate" />
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Time<font color="red">*</font></label>
        <div class="col-xs-6">
        <input type="time" class="form-control form-control-sm" id="ppttime" name="svtime" >
        </div>
        </div>
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Agenda</label>
        <div class="col-xs-6">
        <textarea id="form_message" name="Agencda" class="form-control form-control-sm" rows="4" ></textarea>
        </div>
        </div>
        <div id="dvPassport" style="display: none">
        <div class="form-group">
        <label for="description" class="col-xs-4 control-label">Site Visit Virtual Form</label>
        <div class="col-xs-6">
        <input type="file" class="form-control form-control-sm" id="contract" name="SiteVisitVirtualForm[]" />
        </div>
        </div>
        </div>
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")' >Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
</div>
</div>
</div>
<script type="text/javascript">
    function ShowHideDiv() {
        var ddlPassport = document.getElementById("ddlPassport");
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = ddlPassport.value == "virtual" ? "block" : "none";
    }
</script>

