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
                                    <h5>Disbursement List</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Sl</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">CID</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Name</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Mobile</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Business</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Approved Fund</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Disbursed On</th>
                                            <th style="color:#0553a1;font-weight: 500;font-size: 15px;">Document</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($allapplication as $app) :  ?>
                                                <tr>
                                                <td style="font-size: 14px;"><?php echo $i; ?></td>
                                                    <td style="font-size: 14px;">{{ $app->cid }}</td>
                                                    <td style="font-size: 14px;">{{ $app->name }}</td>
                                                    <td style="font-size: 14px;">{{ $app->mobileno }}</td>
                                                    <td style="font-size: 14px;">{{ $app->business_name }}</td>
                                                    <td style="font-size: 14px;"><?php echo $app->total_disbursed; ?></td>
                                                    <td style="font-size: 14px;">
                                                      <font color="red">{{ $app->disbursed_date }} </font>
                                                    </td>
                                                    <td style="font-size: 14px;">
                                                    <?php
                                                          $docs = App\Models\DisbursementDocs::where('appid', $app->id)->get();
                                                          $dcount = count(App\Models\DisbursementDocs::where('appid', $app->id)->get()); ?>

                                                    <?php $did = 1; ?>
                                                          @foreach($docs as $d)
                                                          <?php $pathid = $d->doc_path;
                                                          $filename = $d->file_name;
                                                          ?>
                                                          <a href="{{ url('/uploads/contractdocs/'.$filename) }}" target="_blank" ><i class="bi bi-file-pdf"></i><?php echo $d->file_name; ?></a><br>
                                                           @endforeach

                                                    </td>
                                                    </tr>
                                        <?php
                                            $i++;
                                        endforeach;

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

