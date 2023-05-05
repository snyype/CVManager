<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cv;
use App\Models\Interviewer;

class CVController extends Controller
{
    
    public function store(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'tech' => 'required',
            'level' => 'required',
            'salaryexp' => 'required',
            'exp' => 'required',
            'number' => 'required',
            'email' => 'required',
            'ref' => 'required',
           
            
        ]);

        if ($file = $request->file('image')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp,docx,pdf'
            ]);
            $image = $request->file('image');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = $request->name.".".time().".".$imgExt;
            $result = $image->storeAs('images/cv',$fullname);
            }
    
            else{
                $fullname = 'image.png';
            }

        
     
            $data = new Cv();
            $data->name = $request->name;
            $data->tech = $request->tech;
            $data->level = $request->level;
            $data->salaryexp = $request->salaryexp;
            $data->exp = $request->exp;
            $data->number = $request->number;
            $data->email = $request->email;
            $data->ref = $request->ref;
            $data->image = $fullname;
            $data->save();


        if($data->save()){
            //Redirect with Flash message
            return redirect('/')->with('status', 'Success!');
        }
        else{
            return redirect('/')->with('status', 'There was an error!');
        }

    }

    public function cvlists()
    {
        $data = CV::all();

       return view('cvlists',compact('data'));
    }


    public function indcv($id)
    {
        $data0 = interviewer::where('status','available');
        $data = CV::find($id);
        return view('indcv',compact('data','data0'));
    }


    public function cvstatuschangeview($id)
    {
        $data0 = interviewer::where('status','available')->get();
        $data = CV::find($id);
        return view('statuschange',compact('data','data0'));
    }


    public function changestatus(Request $request, $id)
    {
    
        $data = CV::find($id);
        $data2 = interviewer::find($request->interviewer);
        $data->status = $request->status;
        $data->interviewer = $request->interviewer;
        $data->datetime = $request->datetime;
        $data->save();

        return redirect(url()->previous());

    }

    public function intlists()
    {
        $data = interviewer::all();
        return view('interviewerslist',compact('data'));
    }


    public function addintview()
    {
        return view('addinterviewer');
    }

    public function addInterviewer(Request $request)
    {
    
      $request ->validate([
        'name'=> 'required',
        'position'=> 'required',
        'datetime'=> 'required',
      ]);

      $data = new interviewer();
      $data->name = $request->name;
      $data->position = $request->position;
      $data->datetime = $request->datetime;
      $data->save();

      if($data->save()){
        return redirect('/admin/intlists');
      }
      else{
        return redirect('/admin/intlists');
      }
    }

}
