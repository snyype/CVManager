<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cv;
use App\Models\Interviewer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;


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
        $data = CV::where('status','!=','Hired')->get();

       return view('cvlists',compact('data'));
    }


    public function Hiredcvlists()
    {
        $data = CV::where('status','Hired')->get();

       return view('hiredcv',compact('data'));
    }


    public function indcv($id)
    {
        $data0 = interviewer::where('status','available')->get();
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

        

        if ($file = $request->file('task')) {
            $request->validate([
                'task' =>'mimes:jpg,jpeg,png,bmp,docx,pdf'
            ]);
            $image = $request->file('task');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = $request->name.".".time().".".$imgExt;
            $result = $image->storeAs('images/task',$fullname);
            }
    
            else{
                $fullname = 'image.png';
            }
            // dd($data->task);
    
        $data = CV::find($id);
        $data2 = interviewer::find($request->interviewer);
        if($request->status == NULL){ $data->status = $data->status;}
        $data->interviewer = $request->interviewer;
        $data->datetime = $request->datetime;  
        $data->task = $fullname; 
        $data->save();

    
        
        


     if (!empty($request->task)) {
            $details = [
                'user' => $data->name,
                'technology' => $data->tech,
                'task' =>$data->task,
            ];
        
            Mail::to($data->email)
                ->send(new \App\Mail\TaskMail($details));
                
        }
    
if(!empty($request->status))
{

     if($data->status == "Hired")
        {
            
            $details = [

            'user' => $data->name,
            'datetime' => $data->datetime,
            'interviewer' => $data->interviewer,
            'status' => $data->status,
            'technology' =>$data->tech,

           ];

           Mail::to($data->email)->send(new \App\Mail\Mail($details));

        }

        if($data->status == "Rejected")
        {
           
            $details = [

                'user' => $data->name,
                'status' => $data->status,
               
    
               ];

               Mail::to($data->email)->send(new \App\Mail\RejectedMail($details));
        }
    }

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


    public function apiCvLists()
    {
        
        $cvs = Cv::all();

        $response = [
            [
                "vdata" => "I",
                "success" => true,
            ],
            [
                "vdata" => $cvs->toArray(),
                "message" => "Cv list retrieved successfully.",
                "status" => 200,
                "statusText" => "OK"
            ]
        ];
    
        return response()->json($response);
        
    }

    public function apiIndCvLists($id)
    {
        
        $cvs = Cv::find($id);

        $response = [
            [
                "vdata" => "I",
                "success" => true,
            ],
            [
                "vdata" => $cvs->toArray(),
                "message" => "Cv of $cvs->name retrieved successfully.",
                "status" => 200,
                "statusText" => "OK"
            ]
        ];
    
        return response()->json($response);
        
    }

    public function apiUserLists()
    {
        
        $user = User::all();

        $response = [
            [
                "vdata" => "I",
                "success" => true,
            ],
            [
                "vdata" => $user->toArray(),
                "message" => "Users list retrieved successfully.",
                "status" => 200,
                "statusText" => "OK"
            ]
        ];
    
        return response()->json($response);
        
    }

    public function apiSearchQuery(Request $request)
    {
       $result = Cv::where('name', 'LIKE',$request->query('query').'%')->orWhere('tech', 'LIKE', '%'.$request->query('query').'%')->get();


       $response = [
        [
            "vdata" => "I",
            "success" => true,
        ],
        [
            "vdata" => $result->toArray(),
            "message" => "Search list retrieved successfully.",
            "status" => 200,
            "statusText" => "OK"
        ]
    ];
    return response()->json($response);

    }


    public function apiv1Endpoints()
    {
        $response = [
            [    "vdata" => "I",
                "success" => true,
            ],
            [
            
                "status" => 200,
                "statusText" => "OK",
                "messages" => [
                    "Users Lists, http://192.168.1.80:8000/api/users , Method : GET",
                    "Cv Lists, http://192.168.1.80:8000/api/cvlists , Method : GET",
                    "Indivisual Cv Lists, http://192.168.1.80:8000/api/cvlists/{id}, Method : GET",
                    "Search , http://192.168.1.80:8000/api/search , Method : POST // Pass value to query filed",
                    "Interviewer List , http://192.168.1.80:8000/api/intlists , Method : GET",
                    "Add Interviewer , http://192.168.1.80:8000/api/store-interviewer , Method : POST",
                    "Sign Up , http://192.168.1.80:8000/api/signup , Method : POST, Fields: name | email | password | password_confirmation",
                    "Log In , http://192.168.1.80:8000/api/login , Method : POST, Fields: email | password",
                    "Add CV , http://192.168.1.80:8000/api/store/cv , Method : POST, Fileds : name | tech | level | salaryexp | exp | number | email | ref | image  ",
                    "Update CV , http://192.168.1.80:8000/api/update/cv/{id} , Method : POST, Fileds : name | tech | level | salaryexp | exp | number | email | ref | image  ",
                    "Delete CV , http://192.168.1.80:8000/api/delete/cv/{id} ",
                    "Change Status, http://192.168.1.80:8000/api/change/status/{id} , Method : POST",
                    "Assign Task, http://192.168.1.80:8000/api/assign/task/{id} , Method : POST",

                ]
            ]
        ];
        return response()->json($response);
    }

    public function apiAddInterviewer(Request $request)
    {
        
        $request->validate([
            'name'=> 'required',
            'position'=> 'required',
           
          ]);
          
    
          $data = new interviewer();
          $data->name = $request->name;
          $data->position = $request->position;
          $data->save();

          return response()->json([
            'status' => 'success',
            'message' => 'Interviewer data added successfully',
            'data' => $data
        ], 200);
          
    }

    public function sign_up(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user->createToken('apiToken')->plainTextToken;
        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, 201);

    }
    

    public function apiStoreCv(Request $request)
    {

       

        $data = new Cv();
        $data->name = $request->name;
        $data->tech = $request->tech;
        $data->level = $request->level;
        $data->salaryexp = $request->salaryexp;
        $data->exp = $request->exp;
        $data->number = $request->number;
        $data->email = $request->email;
        $data->ref = $request->ref;
        $data->image = $request->image;
        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'CV data added successfully',
            'data' => $data
        ], 200);

    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response($res, 201);
    }


    public function apiStatusChange(Request $request, $id)
    {
     
        $data = Cv::find($id);

        $data->status = $request->status;
        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status Changed successfully',
            
        ], 200);

    }

    public function apiAssignTask(Request $request, $id)
    {
        
        if ($file = $request->file('task')) {
            $request->validate([
                'task' =>'mimes:jpg,jpeg,png,bmp,docx,pdf'
            ]);
            $image = $request->file('task');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = $request->name.".".time().".".$imgExt;
            $result = $image->storeAs('images/task',$fullname);
            }
    
            else{
                $fullname = 'image.png';
            }
        
        $data = Cv::find($id);
      $status =  $data->task = $fullname;
        $data->save();

        
        return response()->json([
            'status' => 'success',
            'message' => 'Task Assigned successfully',
            'data' => $status
        ], 200);

    }

    public function apiUpdateCv(Request $request, $id)
    {
        $data =  Cv::find($id);

        $data->name = $request->name;
        $data->tech = $request->tech;
        $data->level = $request->level;
        $data->salaryexp = $request->salaryexp;
        $data->exp = $request->exp;
        $data->number = $request->number;
        $data->email = $request->email;
        $data->ref = $request->ref;
        $data->image = $request->image;
        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'CV data Updated successfully',
            'data' => $data
        ], 200);

    }

    public function apiDeleteCv($id)
    {

        Cv::where('id',$id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cv data deleted successfully'
        ]);

    }
}
