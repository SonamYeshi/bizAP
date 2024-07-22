<?php
namespace App\Http\Controllers\Budget;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\user;
use App\Models\BudgetHead;
use App\Models\ExpenseHead;
use App\Models\BudgetDetails;
use App\Models\ExpenseDetails;
use DB;

class BudgetController extends Controller
{
    public function index()
    {
        $BudgetHead = BudgetHead::all();
        return view('budget.budget', compact('BudgetHead'));
    }

    public function budgetheadadd(Request $request)
    {
        $budget = new BudgetHead;
        $budget->HeadName = $request->HeadName;
        $budget->HeadCode = $request->HeadCode;
        $budget->HeadDescription = $request->HeadDescription;
        $budget->created_by = Auth::user()->id;
        $budget->created_on = date('Y-m-d');
        $budget->save();
        return redirect()->route('budgethead')->with('success','Budget Head Added Successfully!');
    }

    public function editview(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = BudgetHead::find($id);
            return response()->json($info);
        }
    }

    public function update_bhead(Request $request)
    {
        $id = $request->edit_id;
        $user = new BudgetHead;
        $user::where('id', $id)
            ->update([
                'HeadName' => $request->HeadName,
                'HeadCode' => $request->HeadCode,
                'HeadDescription' => $request->HeadDescription,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('budgethead')->with('success','Budget Head Updated Successfully!');
    }

    public function deleteBhead($id)
    {
        $fund = new BudgetHead;
        $fund::where('id', $id)->delete();
        return redirect()->route('budgethead')->with('success','Budget Head Removed Successfully!');
    }

    public function expensehead()
    {
        $ExpenseHead = ExpenseHead::all();
        return view('budget.expense', compact('ExpenseHead'));
    }

    public function expheadadd(Request $request)
    {
        $Expense = new ExpenseHead;
        $Expense->BudgetHeadID = $request->BHeadName;
        $Expense->ExpenseHeadName = $request->HeadName;
        $Expense->ExpenseHeadCode = $request->HeadCode;
        $Expense->ExpenseHeadDescription = $request->HeadDescription;
        $Expense->created_by = Auth::user()->id;
        $Expense->created_on = date('Y-m-d');
        $Expense->save();
        return redirect()->route('expenseheads')->with('success','Expense Head Updated Successfully!');
    }

    public function editviewexpense(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = ExpenseHead::find($id);
            return response()->json($info);
        }
    }

    public function update_exphead(Request $request)
    {
        $id = $request->edit_id;
        $user = new ExpenseHead;
        $user::where('id', $id)
            ->update([
                'BudgetHeadID' => $request->BHeadName,
                'ExpenseHeadName' => $request->HeadName,
                'ExpenseHeadCode' => $request->HeadCode,
                'ExpenseHeadDescription' => $request->HeadDescription,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('expenseheads')->with('success','Expense Head Updated Successfully!');
    }

    public function deleteExphead($id)
    {
        $fund = new ExpenseHead;
        $fund::where('id', $id)->delete();
        return redirect()->route('expenseheads')->with('success','Expense Head Removed Successfully!');
    }

    public function budgetdetails()
    {
        $BudgetDetails = BudgetDetails::all();
        return view('budget.budgetdetails', compact('BudgetDetails'));
    }

    public function searchbudget(Request $request)
    {
        $year = $request->budgetyear;
        $BudgetDetails = BudgetDetails::where('FinancialYear', $year)->get();
        return view('budget.budgetdetails', compact('BudgetDetails'));
    }

    public function budgetdetailadd(Request $request)
    {
        $Expense = new BudgetDetails;
        $Expense->FinancialYear = $request->FinancialYear;
        $Expense->BudgetHeadID = $request->BHeadName;
        $Expense->Activity = $request->Activity;
        $Expense->BudgetAmount = $request->BudgetAmount;
        $Expense->created_by = Auth::user()->id;
        $Expense->created_on = date('Y-m-d');
        $Expense->save();
        return redirect()->route('budgetdetails')->with('success','Budget Detail Added Successfully!');
    }

    public function editviewbgdetail(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = BudgetDetails::find($id);
            return response()->json($info);
        }
    }

    public function update_budgetdetails(Request $request)
    {
        $id = $request->edit_id;
        $user = new BudgetDetails;
        $user::where('id', $id)
            ->update([
                'FinancialYear' => $request->FinancialYear,
                'BudgetHeadID' => $request->BHeadName,
                'Activity' => $request->Activity,
                'BudgetAmount' => $request->BudgetAmount,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('budgetdetails')->with('success','Budget Detail Updated Successfully!');
    }

    public function deleteBudgetDetail($id)
    {
        $fund = new BudgetDetails;
        $fund::where('id', $id)->delete();
        return redirect()->route('budgetdetails')->with('success','Budget Detail Removed Successfully!');
    }

    public function expensedetails()
    {
        $ExpenseDetails = BudgetDetails::all();
        return view('budget.expensedetails', compact('ExpenseDetails'));
    }

    public function searcexpenses(Request $request)
    {
        $year = $request->budgetyear;
        $ExpenseDetails = BudgetDetails::where('FinancialYear', $year)->get();
        return view('budget.expensedetails', compact('ExpenseDetails'));
    }

    public function updateexpensedetails($budgetdetailid)
    {
        $BudgetDetails = BudgetDetails::where('id', $budgetdetailid)->get();
        $ExpenseDetails = ExpenseDetails::where('BudgetDetailsID', $budgetdetailid)->get();
        return view('budget.updateexpensedetails', compact('BudgetDetails', 'ExpenseDetails', 'budgetdetailid'));
    }

    public function update_expdetails(Request $request)
    {
        $Expense = new ExpenseDetails;
        $budgetdetailid = $request->budgetdetailid;
        $Expense->BudgetDetailsID = $request->budgetdetailid;
        $Expense->ExpenseAmount = $request->ExpenseAmount;
        $Expense->Description = $request->Description;
        $Expense->created_by = Auth::user()->id;
        $Expense->created_on = date('Y-m-d');
        $Expense->save();

        return redirect()->route('updateexpensedetails', ['budgetdetailid' => $budgetdetailid])->with('success','Item created successfully!');;
    }

    public function deleteExpDetail($id, $budgetdetailid)
    {
        $exp = new ExpenseDetails;
        $exp::where('id', $id)->delete();
        Session::flash('message', 'Expense Removed Successfully !');
        Session::flash('class', 'success'); //you can replace success by [info,warning,danger]
        return redirect()->route('updateexpensedetails', ['budgetdetailid' => $budgetdetailid])->with('success','here your success message');;
    }


}
