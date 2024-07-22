<x-app-layout>
    @include('top_nav_bar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                    <nav class="navbar navbar-light bg-light">
                    <strong>Mentoring Session Details</strong>
                    </nav>
                        <form class="row g-3" role="form" method="POST" action="{{route('updatementoring')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="edit_id" value="{{$id}}" />
                            <?php foreach ($allapplication as $app) :?>
                            <div class="form-group col-md-10">
                                <label for="name" class="form-label"><strong>Support Type<font color="red">*</font></strong></label>
                                <select class='form-control' name="SupportType" required >
                                <option value="Option one" selected>-- Selec one --</option>
                                <option value="Mentoring" <?php if($app->SupportType=='Mentoring') { ?> selected <?php } ?>>Mentoring</option>
                                <option value="Training" <?php if($app->SupportType=='Training') { ?> selected <?php } ?>>Training</option>
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Start Date<font color="red">*</font></strong></label>
                                <input id="form_name" type="date" name="StartDate" class="form-control" value="{{$app->StartDate}}">
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>End Date<font color="red">*</font></strong></label>
                                <input id="form_name" type="date" name="EndDate" class="form-control" value="{{$app->EndDate}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Mentor<font color="red">*</font></strong></label>
                                <input id="form_name" type="text" name="Mentor" class="form-control" value="{{$app->Mentor}}">
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>No. of Partipants<font color="red">*</font></strong></label>
                                <input id="form_name" type="number" name="NoofPartipants" class="form-control" value="{{$app->NoofPartipants}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Objective<font color="red">*</font></strong></label>
                                <textarea class="form-control" id="challenge" name="Objective" rows="3">{{$app->Objective}}</textarea>
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Requirements<font color="red">*</font></strong></label>
                                <textarea class="form-control" id="challenge" name="Requirements" rows="3">{{$app->Requirements}}</textarea>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Eligible Cohorts<font color="red">*</font></strong></label>
                                <select class='form-control' required name="EligibleCohorts" >
                                <option value="Option one" selected>-- Selec one --</option>
                                    <option value="Cohorts one" <?php if($app->EligibleCohorts=='Cohorts one') { ?> selected <?php } ?>>Cohorts one</option>
                                    <option value="Cohorts two" <?php if($app->EligibleCohorts=='"Cohorts two') { ?> selected <?php } ?>>Cohorts two</option>
                                </select>
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>CV of the Mentor</strong></label>
                                <input type="file" class="form-control" id="customFile" name="CVoftheMentor[]"/>
                                <?php $pathid = App\Models\MentroingDocs::where('mentoringid', $app->id)->value('doc_path');
                                $filename = App\Models\MentroingDocs::where('mentoringid', $app->id)->value('file_name');
                                ?>
                                @if($pathid != '')
                                <a href="{{ asset("storage/$pathid") }}" target="_blank"><i class="bi bi-file-pdf"></i><?php echo $filename; ?></a>
                                @else
                                No Document
                                @endif
                            </div>
                            <?php endforeach; ?>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")'>Update</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
