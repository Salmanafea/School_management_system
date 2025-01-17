<?php


namespace App\Repository;
use App\Models\Student;
use App\Models\PaymentStudent;
use App\Models\StudentAccount;
use App\Models\FundAccount;
use Illuminate\Support\Facades\DB;
class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.Payment.index',compact('payment_students'));

    }

    public function show($id){
        $student = Student::findorfail($id);
        return view('pages.Payment.add',compact('student'));

    }

    public function edit($id){
        $payment_student = PaymentStudent::findorfail($id);
        return view('pages.Payment.edit',compact('payment_student'));
    }

    public function store($request){

        DB::beginTransaction();

   try{

        $payment_students = new PaymentStudent();
        $payment_students->date = date('Y-m-d');
        $payment_students->student_id =$request->student_id;
        $payment_students->amount =$request->Debit;
        $payment_students->description =$request->description;
        $payment_students->save();


        $fund_accounts=new FundAccount();
        $fund_accounts->date = date('Y-m-d');
        $fund_accounts->payment_id =$payment_students->id;
        $fund_accounts->Debit=0.00;
        $fund_accounts->credit=$request->Debit;;
        $fund_accounts->description=$request->description;
        $fund_accounts->save();

        $students_accounts = new StudentAccount();
        $students_accounts->date = date('Y-m-d');
        $students_accounts->type = 'Payment';
        $students_accounts->student_id = $request->student_id;
        $students_accounts->payment_id = $payment_students->id;
        $students_accounts->Debit = $request->Debit;
        $students_accounts->credit = 0.00;
        $students_accounts->description = $request->description;
        $students_accounts->save();

        DB::commit();
        toastr()->success(trans('message.success'));
        return redirect()->route('Payment_students.index');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }


    public function update($request){

        DB::beginTransaction();
        try{

            $payment_students = PaymentStudent::findorfail($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id =$request->student_id;
            $payment_students->amount =$request->Debit;
            $payment_students->description =$request->description;
            $payment_students->save();


            $fund_accounts= FundAccount::where('payment_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id =$payment_students->id;
            $fund_accounts->Debit=0.00;
            $fund_accounts->credit=$request->Debit;;
            $fund_accounts->description=$request->description;
            $fund_accounts->save();


            $students_accounts = StudentAccount::where('payment_id',$request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'Payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            toastr()->success(trans('message.Update'));
            return redirect()->route('Payment_students.index');


    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    public function destroy($request){
        try{

        PaymentStudent::destroy($request->id);
        toastr()->success(trans('message.Delete'));
        return redirect()->route('Payment_students.index');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }






}
