<x-app-layout>
    @include('top_nav_bar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">

                    @include('flash-message')

                   <nav class="navbar navbar-light bg-light">
                    <strong>Update Expenses</strong>
                    </nav>
                        <form class="row g-3" role="form" method="POST" action="{{ route('update_expdetails') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="budgetdetailid" value="{{$budgetdetailid}}" />
                            <?php foreach($BudgetDetails as $bh): ?>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Financial Year</strong></label>
                                <input id="form_name" type="text" disabled class="form-control" value="<?php echo $bh->FinancialYear;?>">
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Budget Head</strong></label>
                                <input id="form_name" type="text" name="EndDate" disabled class="form-control"
                                 value="<?php echo App\Models\BudgetHead::where('id', $bh->BudgetHeadID)->value('HeadName');?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Activity</strong></label>
                                <textarea class="form-control" disabled name="Requirements" rows="3"><?php echo $bh->Activity;?></textarea>
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Available Budget Amount</strong></label>
                                <input id="form_name" type="number" disabled class="form-control" value="<?php echo $bh->BudgetAmount;?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Expense Amount<font color="red">*</font></strong></label>
                                <input id="form_name" type="number" class="form-control" value="" name="ExpenseAmount" required>
                            </div>
                             <br>
                            <div class="form-group col-md-5">
                                <label for="name" class="form-label"><strong>Description<font color="red">*</font></strong></label>
                                <textarea class="form-control" id="challenge" name="Description" rows="3" required></textarea>
                            </div>

                             <?php endforeach; ?>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm" onclick='return confirm("Are you sure to Save ?")'>Update</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Back</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive">
            <table id="example" class="table table-bordered table-sm table-striped">
               <thead class="thead-dark">
                <tr>
                    <th>Sl.No</th>
                    <th>Budget Head</th>
                    <th>Activity</th>
                    <th>Budget Amount</th>
                    <th>Expense Amount</th>
                    <th>Expense Description</th>
                    <th style='width:15%'>Date</th>
                </tr>
               </thead>
               <tbody>
               <?php $i = 1; foreach($ExpenseDetails as $bh): ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php $BudgetHeadID =  App\Models\BudgetDetails::where('id', $budgetdetailid)->value('BudgetHeadID');
                              echo App\Models\BudgetHead::where('id', $BudgetHeadID)->value('HeadName');
                    ?></td>
                    <td><?php echo App\Models\BudgetDetails::where('id', $budgetdetailid)->value('Activity');?></td>
                    <td><?php echo number_format(App\Models\BudgetDetails::where('id', $budgetdetailid)->value('BudgetAmount'), 2); ?></td>
                    <td><?php echo number_format($bh->ExpenseAmount, 2); ?></td>
                    <td><?php echo $bh->Description; ?></td>
                    <td><?php echo $bh->created_on; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('deleteExpDetail', array($bh->id, $budgetdetailid)) }}" onclick='return confirm("Are you sure to Remove ?")'>
                    <font color="red"><i class="fa fa-trash" aria-hidden="true"></i></font></a>
                    </td>
                    </tr>
                    <?php $i++; endforeach; ?>
               </tbody>
             </table>
             </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
