<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class Employ extends Controller
{
    //
   // protected $filllable=['title','body'];
    //protected $dates=['created_at'];
    protected $fillable = [
        'name', 'address', 'dob','email','mobileno',
    ];
    public function index(){
        if(request()->ajax())
        {
            return datatables()->of(Employee::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                   
        }
        return view('employee');

       // $Employee=Employee::all();
        //dd($customermaster);
       
       // return view('index',compact('Employee'));
     }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
   
    public function getemploy(){
        

        $Employee=Employee::all();
        //dd($customermaster);

        return view('employee',compact('Employee'));
     }
     public function store(Request $request){
        // $form_data = array(
        //     'name'        =>  $request->name,
        //     'address'      =>  $request->address,
        //     'dob'           =>  date("Y-m-d", strtotime($request->dob)),
        //     'email'        =>  $request->email,
        //     'mobileno'         =>  $request->mobileno,
            
        // );

        $Employee = new Employee;
        $Employee->name = $request->name;
        $Employee->address = $request->address;
        $Employee->dob = date("Y-m-d", strtotime($request->dob));
        $Employee->email = $request->email;
        $Employee->mobileno = $request->mobileno;

       // dd($Employee);
        if (Employee::where('name',$request->name)->count() > 0) {
           return '100';
         }else if(Employee::where('mobileno',$request->mobileno)->count() > 0){
            return '200';
         }else { 
             if ($Employee->save()) {
            return $Employee->id;
        }
    }

        //Employee::create($form_data);
      //  return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);
        //return response()->json(['success' => 'Data Added successfully.']);
     
    }
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Employee::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }
    public function update(Request $request)
    {
        $form_data = array(
            'name'        =>  $request->name,
            'address'         =>  $request->address,
            'dob'             =>  date("Y-m-d", strtotime($request->dob)),
            'email'        =>  $request->email,
            'mobileno'         =>  $request->mobileno,
            
        );
       
        
        Employee::whereId($request->hidden_id)->update($form_data);



        return response()->json(['success' => 'Data is successfully updated']);
    }
    public function uploadingfile(Request $request){
       

       // $filename = $request->file('file');
    // dd($request->file('file'));
        $extension = $request->file('file')->getClientOriginalExtension();
      
        $dir = 'uploads/';
        $filename = uniqid() . '_' . time() . '.' . $extension;

       // echo  dd($filename); 
        $request->file('file')->move($dir, $filename);

        
        return $filename;
            
      
            
        
    // if ($request->file('file') == null) {
    //     $file = "";
    // }else{
      // $file = $request->file('file')->store('uploads');  
    //}
    // if ($_FILES["file"]["error"] == UPLOAD_ERR_OK)
    // {
    //     $file = $_FILES["file"]["tmp_name"];
    //     // now you have access to the file being uploaded
    //     //perform the upload operation.
    //     move_uploaded_file( $file, "uploads/" . $file);
    // }

   
    }
    public function destroy($id)
    {
        $data = Employee::findOrFail($id);
        $data->delete();
    }
}