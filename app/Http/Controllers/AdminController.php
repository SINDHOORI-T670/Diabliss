<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use App\User;
use App\models\Profile;
use File;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\models\Branch;
use App\models\BranchOrderSetting;
use App\models\BranchWorkingHour;
use App\models\BranchLocation;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index(){
        // dd("Hello Admin");
        return view('backEnd.admin.dashboard');
    }
    public function myProfile(Request $request){
        $data = User::find(Auth::User()->id);
        // dd($data);
        return view('backEnd.admin.profile',compact('data'));
    }
    public function updateProfile(Request $request){
        // dd($request->all());
        $id = Auth::User()->id;
        $validator = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'phone' => 'unique:profiles,phone,'.$id,
                    'email' => 'required|email|max:255'
                ],[
                    'name.required' => 'Please enter name',
                    'email.required' => 'Please enter email',
                ]);
        if ($validator->fails()) {

            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput();

        } else  {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            User::where('id',Auth::user()->id)->update($data);
            $fileName = "";
            $check = Profile::where('user_id',Auth::User()->id)->first();
            if ($request->file('image') != "") {

                $file = $request->file('image');

                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                $file->move('admin/gallery/', $fileName);

                // $fileName = 'uploads/profiles/' . $fileName;
                $fileName = $request->root().'/admin/gallery/'.$fileName;
                

            }else{
                $fileName = $check->image;
            }

            
            if(isset($check)){
                
                $profile = [
                    'user_id' => Auth::User()->id,
                    'phone' => $request->phone,
                    'lang' => $request->language,
                    'image' => $fileName
                ];
                Profile::where('user_id',Auth::User()->id)->update($profile);
            }else{
                $new = new Profile();
                $new->user_id = Auth::User()->id;
                $new->phone = $request->phone;
                $new->lang = $request->language;
                $new->save();
            }
            
            return redirect()->back()->with('message-success','Details are updated successfully.');
        }
        
    }
    public function changePassword(){
        return view('backEnd.admin.changepassword');
    }
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(),
        [
            'password' => 'min:6|required_with:confpassword|same:confpassword',
            'confpassword' => 'required|min:6'
        ],[
            'password.same' => 'The password and confirm password must match.',
            'confpassword.required' => 'Please enter confirm passowrd',
            'password.required_with'=>'Please enter password ',
            'password.min' => 'The password must be atleast 6 characters',
            'confpassword.min'=>'The Confirm password must be atleast 6 characters'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = [
                'password' => Hash::make($request->password),
            ];
            User::where('id',Auth::User()->id)->update($data);
            return redirect()->back()->with('message-success','Password updated successfully.');
        }
    }
    public function listBranches(){
        $list = Branch::orderBy('created_at','desc')->latest()->get();
        return view('backEnd.admin.branch.list',compact('list'));
    }
    public function addBranchDetails(){
        // $BranchCode = $this->getBranchId();
        return view('backend.admin.branch.pages.detail');
    }
    public function SaveBranchDetails(Request $request){
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'titlear' => 'required',
            'address' => 'required',
            'addressar' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ],[
            'title.required' => 'Please enter branch title [English]',
            'titlear.required' => 'Please enter branch title [Arabic]',
            'address.required' => 'Please add branch address details [English]',
            'addressar.required' => 'Please add branch address details [Arabic]',
            'phone.required' => 'Please add customer service phone number',
            'email.required' => 'Please add e-mail address'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $id = IdGenerator::generate(['table' => 'branches', 'length' => 6, 'prefix' => 'B-']);
            
                $branch = new Branch();
                $branch->id = $id;
                $branch->title = $request->title;
                $branch->title_ar = $request->titlear;
                $branch->address = $request->address;
                $branch->address_ar = $request->addressar;
                $branch->phone = $request->phone;
                $branch->email = $request->email;
                $branch->status = ($request->status=="on") ? "on" : "off";
                $branch->save();
                return redirect()->route('branch_order_setting',['id'=>$branch->id])->with('message-success','Branch Details added successfully.');
        }
    }
    public function addBranchOrderSettings($id){
        $branch = Branch::find($id);
        return view('backEnd.admin.branch.pages.ordersetting',compact('branch'));
    }
    public function SaveBranchOrderSettings(Request $request){
        $validator = Validator::make($request->all(),
        [
            'max_period' => 'required',
            'type' => 'required|in:Minute,Hours,Days',
        ],[
            'max_period.required' => 'Please add max order fulfillment Period',
            'type.required' => 'Please select max order fulfillment type',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $new = new BranchOrderSetting();
            $new->branch_id = $request->bid;
            $new->busy = ($request->busy=="0") ? "0":"1";
            $new->pickup = ($request->pickup=="0") ? "0":"1";
            $new->schedule = ($request->schedule=="0") ? "0":"1";
            $new->delivery = ($request->delivery=="0") ? "0":"1";
            $new->max_order_period = $request->max_period;
            $new->max_type = $request->type;
            $new->save();
            return redirect()->route('branch_working_hours',['id'=>$request->bid])->with('message-success','Branch Order Setting Details added successfully.');

        }
    }
    public function addBranchWorkingHours($id){
        $branch = Branch::find($id);
        $Days = [
            'ALL' => 'Everyday',
            'SUN' => 'Sunday',
            'MON' => 'Monday',
            'TUE' => 'Tuesday',
            'WED' => 'Wednesday',
            'THU' => 'Thursday',
            'FRI' => 'Friday',
            'SAT' => 'Saturday'
        ];
        return view('backEnd.admin.branch.pages.workinghour',compact('branch','Days'));
    }
    public function SaveBranchWorkingHours(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'day' => 'required|array',
            // 'hours_opening.*' => 'date_format:H:i',
            // 'hours_closing.*' => 'date_format:H:i',
            // 'break_opening.*' => 'date_format:H:i',
            // 'break_closing.*' => 'date_format:H:i',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            if($request->has('day')) {
                $Hours_start_time = $request->hours_opening;
                $Hours_end_time = $request->hours_closing;
                $Break_start_time = $request->break_opening;
                $Break_end_time = $request->break_closing;
                foreach($request->day as $key => $day) 
                {  
                    $timing[] = [
                        'work_start_time' => $Hours_start_time[$day],
                        'work_end_time' => $Hours_end_time[$day],
                        'break_start_time' => $Break_start_time[$day],
                        'break_end_time' => $Break_end_time[$day],
                        'branch_id' => $request->bid,
                        'day' => $day
                    ];
                    BranchWorkingHour::insert($timing); 
                }
                
            }
            return redirect()->route('branch_location',['id'=>$request->bid])->with('message-success','Branch working hours  added successfully.');

        }
    }
    public function addBranchLocation($id){
        $branch = Branch::find($id);
        return view('backEnd.admin.branch.pages.location',compact('branch'));
    }
    public function SaveBranchLocation(Request $request){
        $validator = Validator::make($request->all(),
        [
            'latitude' => 'required',
            'longitude' => 'required',
        ],[
            'latitude.required' => 'Please add latitude',
            'longitude.required' => 'Please add longitude',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $new = new BranchLocation();
            $new->branch_id = $request->bid;
            $new->latitude = $request->latitude;
            $new->longitude = $request->longitude;
            $new->save();
            return redirect()->route('Branches')->with('message-success','Branch Location Details added successfully.');

        }
    }
    public function editBranchDetails($id){
        $branch = Branch::find($id);
        return view('backend.admin.branch.editpages.edit_detail',compact('branch'));
    }
    public function UpdateBranchDetails(Request $request){
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'titlear' => 'required',
            'address' => 'required',
            'addressar' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ],[
            'title.required' => 'Please enter branch title [English]',
            'titlear.required' => 'Please enter branch title [Arabic]',
            'address.required' => 'Please add branch address details [English]',
            'addressar.required' => 'Please add branch address details [Arabic]',
            'phone.required' => 'Please add customer service phone number',
            'email.required' => 'Please add e-mail address'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
        
                $branch =[
                'title' => $request->title,
                'title_ar' => $request->titlear,
                'address' => $request->address,
                'address_ar' => $request->addressar,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => ($request->status=="on") ? "on" : "off" 
            ];
            // dd($branch);
                $id = Branch::where('id',$request->bid)->update($branch);
                if(isset($id)){
                    return redirect()->back()->with('message-success','Branch Details updated successfully.');
                }else{
                    return redirect()->back()->with('message-danger','Branch Details not updated,Someting went wrong.');
                }
                
        }
    }
    public function editBranchOrderSettings($id){
        $branch = BranchOrderSetting::where('branch_id',$id)->first();
        $bid = $id;
        return view('backEnd.admin.branch.editpages.edit_ordersetting',compact('branch','bid'));
    }
    public function updateBranchOrderSettings(Request $request){
        $validator = Validator::make($request->all(),
        [
            'max_period' => 'required',
            'type' => 'required|in:Minute,Hours,Days',
        ],[
            'max_period.required' => 'Please add max order fulfillment Period',
            'type.required' => 'Please select max order fulfillment type',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $setting = BranchOrderSetting::where('branch_id',$request->bid)->first();
            if($setting){
                $update = [
                    'busy' => ($request->busy=="0") ? "0":"1",
                    'pickup'=> ($request->pickup=="0") ? "0":"1",
                    'schedule' => ($request->schedule=="0") ? "0":"1",
                    'delivery' => ($request->delivery=="0") ? "0":"1",
                    'max_order_period' => $request->max_period,
                    'max_type' => $request->type];
                    BranchOrderSetting::where('branch_id',$request->bid)->update($update);
            }else{
                // dd($request->all());
                $new = new BranchOrderSetting();
                $new->branch_id = $request->bid;
                $new->busy = ($request->busy=="0") ? "0":"1";
                $new->pickup = ($request->pickup=="0") ? "0":"1";
                $new->schedule = ($request->schedule=="0") ? "0":"1";
                $new->delivery = ($request->delivery=="0") ? "0":"1";
                $new->max_order_period = $request->max_period;
                $new->max_type = $request->type;
                $new->save();
    
            }
            return redirect()->back()->with('message-success','Branch Order Setting Details updated successfully.');

        }
    }
    public function editBranchWorkingHours($id){
        $branch = BranchWorkingHour::where('branch_id',$id)->get();
        $Days = [
            'ALL' => 'Everyday',
            'SUN' => 'Sunday',
            'MON' => 'Monday',
            'TUE' => 'Tuesday',
            'WED' => 'Wednesday',
            'THU' => 'Thursday',
            'FRI' => 'Friday',
            'SAT' => 'Saturday'
        ];
        return view('backEnd.admin.branch.editpages.edit_workinghour',compact('branch','Days'));
    }
    public function UpdateBranchWorkingHours(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'day' => 'required|array',
            // 'hours_opening.*' => 'date_format:H:i',
            // 'hours_closing.*' => 'date_format:H:i',
            // 'hours_opening.*' => 'date_format:H:i',
            // 'hours_closing.*' => 'date_format:H:i',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            if($request->has('day')) {
                $Hours_start_time = $request->hours_opening;
                $Hours_end_time = $request->hours_closing;
                $Break_start_time = $request->break_opening;
                $Break_end_time = $request->break_closing;
                DB::table('branch_working_hours')->where('branch_id',$request->bid)->delete();
                foreach($request->day as $key => $day) 
                {  
                    $timing[] = [
                        'work_start_time' => $Hours_start_time[$day],
                        'work_end_time' => $Hours_end_time[$day],
                        'break_start_time' => $Break_start_time[$day],
                        'break_end_time' => $Break_end_time[$day],
                        'branch_id' => $request->bid,
                        'day' => $day
                    ];
                }
                BranchWorkingHour::insert($timing); 
            }
            return redirect()->back()->with('message-success','Branch working hours  updated successfully.');

        }
    }
    public function editBranchLocation($id){
        $branch = BranchLocation::where('branch_id',$id)->first();
        $b=$id;
        return view('backEnd.admin.branch.editpages.edit_location',compact('branch','b'));
    }
    public function updateBranchLocation(Request $request){
        $validator = Validator::make($request->all(),
        [
            'latitude' => 'required',
            'longitude' => 'required',
        ],[
            'latitude.required' => 'Please add latitude',
            'longitude.required' => 'Please add longitude',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $check = BranchLocation::where('branch_id',$request->bid)->first();
            if($check){
                $input = [
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ];
                BranchLocation::where('branch_id',$request->bid)->update($input);
            }else{
                $new = new BranchLocation();
                $new->branch_id = $request->bid;
                $new->latitude = $request->latitude;
                $new->longitude = $request->longitude;
                $new->save();
                
            }
            return redirect()->back()->with('message-success','Branch Location Details updated successfully.');

        }
    }
    public function logout(Request $request)
    {
        Auth::logout();Session::flush();
        return redirect('admin/login');

    }
}
