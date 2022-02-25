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
use App\models\Country;
use App\models\City;
use App\models\Area;
use App\models\DeliveryZone;
use App\models\DeliveryZoneArea;
use App\models\DeliveryZoneWorkingHour;
use App\models\Category;
use App\models\SubCategory;
use App\models\Product;
use App\models\ProductImage;
use App\models\ProductBusiness;
use App\models\ProductCustomerChoice;
use App\models\ProductBranches;
use App\models\ProductTags;

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
    public function listCountry(){
        $list = Country::latest()->get();
        return view('backEnd.admin.settings.country.listcountry',compact('list'));
    }
    public function saveNewCountry(Request $request){
        $validator = Validator::make($request->all(),
        [
            'country' => 'required'
        ],[
            'country.required' => 'Please enter country name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $new = new Country();
            $new->name = $request->country;
            $new->status = 0 ;
            $new->save();
            return redirect()->back()->with('message-success','Country added successfully .');
        }
    }
    public function EditCountry($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'country' => 'required'
        ],[
            'country.required' => 'Please enter country name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = [
                'name' => $request->country,
                'status' => $request->status
            ];
            Country::where('id',$id)->update($data);
            return redirect()->back()->with('message-success','Country details updated successfully . ');
        }
    }
    public function deleteCountry($id){
        $cities = City::where('id',$id)->delete();
        $country = Country::find($id);
        $country->delete();
        return redirect()->back()->with('message-success','Country deleted successfully .');
    }
    public function listCity($id){
        $country = Country::find($id);
        $list = City::where('country_id',$id)->latest()->get();
        return view('backEnd.admin.settings.country.listcities',compact('list','country'));
    }
    public function saveNewCity(Request $request){
        $validator = Validator::make($request->all(),
        [
            'city' => 'required'
        ],[
            'city.required' => 'Please enter city name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $new = new City();
            $new->name = $request->city;
            $new->country_id = $request->country;
            $new->status = 0 ;
            $new->save();
            return redirect()->back()->with('message-success','City added successfully .');
        }
    }
    public function EditCity($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'city' => 'required'
        ],[
            'city.required' => 'Please enter city name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = [
                'name' => $request->country,
                'status' => $request->status
            ];
            City::where('id',$id)->update($data);
            return redirect()->back()->with('message-success','City details updated successfully . ');
        }
    }
    public function deleteCity($id){
        $city = City::find($id);
        $city->delete();
        return redirect()->back()->with('message-success','City deleted successfully .');
    }
    public function listArea($id){
        $city = City::find($id);
        $list = Area::where('city_id',$id)->latest()->get();
        return view('backEnd.admin.settings.country.listareas',compact('list','city'));
    }
    public function saveNewArea(Request $request){
        $validator = Validator::make($request->all(),
        [
            'area' => 'required'
        ],[
            'area.required' => 'Please enter area name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            // dd(explode(",", $request->area));
            foreach(explode(',',$request->area) as $item){
                $new = new Area();
                $new->name = $item;
                $new->city_id = $request->city;
                $new->status = 0 ;
                $new->save();
            }
            
            return redirect()->back()->with('message-success','Area added successfully .');
        }
    }
    public function EditArea($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'area' => 'required'
        ],[
            'area.required' => 'Please enter area name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = [
                'name' => $request->area,
                'status' => $request->status
            ];
            Area::where('id',$id)->update($data);
            return redirect()->back()->with('message-success','Area details updated successfully . ');
        }
    }
    public function deleteArea($id){
        $area = Area::find($id);
        $area->delete();
        return redirect()->back()->with('message-success','Area deleted successfully .');
    }
    public function Listdeliveryzones(){
        $br = Branch::where('status','on')->latest()->get();
        $list = DeliveryZone::latest()->get();
        // dd($list);
        return view('backEnd.admin.zone.list',compact('list','br'));
    }
    public function createDeliveryZone(){
        $branches = Branch::where('status','on')->latest()->get();
        $country = Country::where('status',0)->latest()->get();
        return view('backEnd.admin.zone.page.detail',compact('branches','country'));
    }
    
    public function SaveDeliveryZone(Request $request){
        $validator = Validator::make($request->all(),
        [
            'label' => 'required',
            'branches' => 'required',
            'minorder' => 'required',
            'max_period' => 'required',
            'type' => 'required|not_in:0',
            'fee' => 'required',
            'country' => 'required'
        ],[
            'label.required' => 'Please enter label',
            'branches.required' => 'Please select branch',
            'minorder.required' => 'Please add minimum order',
            'max_period.required' => 'Please add delivery time',
            'type.required' => 'Please add delivery type',
            'fee.required' => 'Please add delivery fee',
            'country.required' => 'Please select a country'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            // dd($request->all());
            $id = IdGenerator::generate(['table' => 'delivery_zones', 'length' => 6, 'prefix' => 'DZ-']);
            $data = new DeliveryZone();
            $data->id= $id;
            $data->label = $request->label;
            $data->min_order = $request->minorder;
            $data->delivery_time = $request->max_period;
            $data->delivery_type = $request->type;
            $data->delivery_fee = $request->fee;
            $data->status = $request->status;
            $data->branch_id =implode(',',$request->branches);
            $data->country_id = $request->country;
            $data->save();
            $data = DeliveryZone::find($id);
            
            return redirect()->route('zone-working-hours',['id'=>$id])->with('message-success','Zone Details added successfully.');
        }
    }
    public function addZoneWorkingHours($id){
        $zone = $id;
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
        return view('backEnd.admin.zone.page.workinghour',compact('zone','Days'));
    }
    public function SaveZoneWorkingHours(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'day' => 'required|array',
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
                        'zone_id' => $request->zid,
                        'day' => $day
                    ];
                    DeliveryZoneWorkingHour::insert($timing); 
                }
                
            }
            return redirect()->route('zone_location',['id'=>$request->zid])->with('message-success','Delivery zone working hours  added successfully.');

        }
    }
    public function addzonelocation($id){
        $zone = DeliveryZone::find($id);
        $zid = $id;
        $countries = Country::where('status',0)->latest()->get();
        return view('backend.admin.zone.page.zonearea',compact('countries','zone','zid'));
    }
    public function getCity(Request $request){
        $cities = City::where('country_id',$request->country_id)->where('status',0)->with('areas')->latest()->get(); 
        // dd($cities);
        $html = '';
        // foreach($cities as $city){
        //     $html .= '<hr>
        //     <h5 class="card-title">'.$city->name.'</h5>
        //     <div class="position-relative form-group">
        //         <div>';
        //         foreach($city->areas as $area){
        //             if($area->status==0){
        //             $html .= '<div class="custom-checkbox custom-control custom-control-inline">
        //                 <input type="checkbox" id="area_'.$area->id.'" name="area[]" class="custom-control-input" value="'.$area->id.'">
        //                 <label class="custom-control-label" for="area_'.$area->id.'">'.$area->name.'</label>
        //             </div>';
        //             }
        //         }
        //         $html .= '</div>
        //     </div>';
        // }
        $html .= '<label>City</label><br><select name="city" id="city" class="form-control">';
		$html .= '<option value="0">Select City</option>';
        foreach ($cities as $city) {
			
                

                // foreach($city->areas as $area){
                //     if($area->status==0){
                //         $html .= '<option value="'.$city->id.'_'.$area->id.'">'.$area->name.'</option>';
                //     }
                // }

                // $html .= '</optgroup></select>';
                $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            
		}
        $html .= '</select>';
        // print_r($html);
        return $html;
    }
    public function getArea(Request $request){
        $areas = Area::where('city_id',$request->city_id)->where('status',0)->latest()->get(); 
        $html = '';
        $html .= '<br><label>Area</label><br><select name="area[]" id="area" class="form-control" multiple style="overflow:hidden">';
        // $html .= '<option value="0">Select Area</option>';
		foreach ($areas as $area) {
			$html .= '<option value="'.$area->id.'">'.$area->name.'';
		}
        $html .= '</select>';
        return $html;
    }
    public function getAreaEdit(Request $request){
        $locs = DeliveryZoneArea::where('zone_id',$request->zid)->get();
        $areas = Area::where('city_id',$request->city_id)->where('status',0)->latest()->get(); 
        $html = '';
        $html .= '<br><label>Area</label><br><div id="scrollMe" class="col-md-12"><select name="area[]" id="area" class="form-control" multiple size="'.count($areas).'" style="overflow:hidden">';
        // $html .= '<option value="0">Select Area</option>';
		foreach ($areas as $area) {
			$html .= '<option value="'.$area->id.'"';
            foreach($locs as $loc){
                if($loc->area_id==$area->id){
                    $html .= 'selected';
                }else{
                    $html .= '';
                }
            }
            $html .='>'.$area->name.'';
		}
        $html .= '</select></div>';
        return $html;
    }
    public function saveZoneLocation(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'country' => 'required|not_in:0',
            'city' => 'required|not_in:0',
            'area' => 'required'
        ],[
            'country.required' => 'Please select country',
            'country.not_in' => 'Please select country',
            'city.required' => 'Please select city',
            'city.not_in' => 'Please select city',
            'area.required' => 'Please choose delivery location',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();
            // dd($messages);
            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            // dd($request->all());
            foreach($request->area as $area){
                // dd($area);
                // $City = Area::find($area);
                $new = new DeliveryZoneArea();
                $new->country_id = $request->country;
                $new->zone_id = $request->zid;
                $new->city_id = $request->city;
                $new->area_id = $area;
                $new->status = 0;
                $new->save();
            }
            return redirect()->route('Delivery-Zones')->with('message-success','Delivery Locations added successfully');
        }
    }
    public function editzoneDetails($id){
        $data = DeliveryZone::find($id);
        // dd($data);
        $branches = Branch::where('status','on')->latest()->get();
        $country = Country::where('status',0)->latest()->get();
        return view('backEnd.admin.zone.edit.detail',compact('data','branches','country'));
    }
    public function UpdatezoneDetails(Request $request){
        $validator = Validator::make($request->all(),
        [
            'label' => 'required',
            'branches' => 'required',
            'minorder' => 'required',
            'max_period' => 'required',
            'type' => 'required|not_in:0',
            'fee' => 'required',
            'country' => 'required'
        ],[
            'label.required' => 'Please enter label',
            'branches.required' => 'Please select branch',
            'minorder.required' => 'Please add minimum order',
            'max_period.required' => 'Please add delivery time',
            'type.required' => 'Please add delivery type',
            'fee.required' => 'Please add delivery fee',
            'country.required' => 'Please select a country'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = DeliveryZone::find($request->dzid);
            // dd($data);
            if($data->country_id!=$request->country){
                $areas = DeliveryZoneArea::where('zone_id',$request->dzid)->get();
                foreach($areas as $area){
                    $area->delete();
                }
            }
            $update = [
                'label' => $request->label,
                'min_order' => $request->minorder,
                'delivery_time' => $request->max_period,
                'delivery_type' => $request->type,
                'delivery_fee' => $request->fee,
                'status' => $request->status,
                'branch_id' => implode(',',$request->branches),
                'country_id' => $request->country
            ];
            // dd($request->dzid);
            $updates = DeliveryZone::where('id',$request->dzid)->update($update);
            if($updates==true){
                return redirect()->route('Edit-Zone-Working-Hours',['id'=>$request->dzid])->with('message-success','Zone Details updated successfully.');
            }else{
                return redirect()->back()->with('message-danger','Something went wrong !!');
            }
        }
    }
    public function editZoneWorkingHours($id){
        $zone = $id;
        $workhours = DeliveryZoneWorkingHour::where('zone_id',$id)->get();
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
        return view('backEnd.admin.zone.edit.workinghour',compact('zone','Days','workhours'));
    
    }
    public function UpdateZonehWorkingHours(Request $request){
        $validator = Validator::make($request->all(),
        [
            'day' => 'required|array',
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
                DB::table('delivery_zone_working_hours')->where('zone_id',$request->zid)->delete();
                foreach($request->day as $key => $day) 
                {  
                    $timing[] = [
                        'work_start_time' => $Hours_start_time[$day],
                        'work_end_time' => $Hours_end_time[$day],
                        'break_start_time' => $Break_start_time[$day],
                        'break_end_time' => $Break_end_time[$day],
                        'zone_id' => $request->zid,
                        'day' => $day
                    ];
                    DeliveryZoneWorkingHour::insert($timing); 
                }
                
            }
            return redirect()->route('Edit-Zone-Location',['id'=>$request->zid])->with('message-success','Delivery zone working hours updated successfully.');

        }
    }
    public function editZoneLocation($id){
        $zone = DeliveryZone::find($id);
        $zid = $id;
        $countries = Country::where('status',0)->latest()->get();
        $cities = City::where('country_id',$zone->country_id)->where('status',0)->latest()->get();
        $areas = DeliveryZoneArea::where('zone_id',$id)->get();
        // dd($areas->area);
        
        return view('backend.admin.zone.edit.zonearea',compact('areas','countries','zone','zid','cities'));
    }
    public function updateZoneLocation(Request $request){
        $validator = Validator::make($request->all(),
        [
            'country' => 'required|not_in:0',
            'city' => 'required|not_in:0',
            'area' => 'required'
        ],[
            'country.required' => 'Please select country',
            'country.not_in' => 'Please select country',
            'city.required' => 'Please select city',
            'city.not_in' => 'Please select city',
            'area.required' => 'Please choose delivery location',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();
            // dd($messages);
            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            // dd($request->all());
            if($request->area){
                DB::table('delivery_zone_areas')->where('zone_id',$request->zid)->delete();
                foreach($request->area as $area){
                    $new = new DeliveryZoneArea();
                    $new->country_id = $request->country;
                    $new->zone_id = $request->zid;
                    $new->city_id = $request->city;
                    $new->area_id = $area;
                    $new->status = 0;
                    $new->save();
                }
            }
            
            return redirect()->route('Delivery-Zones')->with('message-success','Delivery Locations added successfully');
        }
    }
    public function categorylist(){
        $list = Category::all();
        return view('backEnd.admin.category.list',compact('list'));
    }
    public function addCategory(Request $request){
        $validator = Validator::make($request->all(),
        [
            'category' => 'required'
        ],[
            'category.required' => 'Please enter category name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $new = new Category();
            $new->name = $request->category;
            $new->status = 0 ;
            $new->save();
            return redirect()->back()->with('message-success','Category added successfully .');
        }
    }
    public function updateCategory($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'category' => 'required'
        ],[
            'category.required' => 'Please enter category name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = [
                'name' => $request->category,
                'status' => $request->status
            ];
            Category::where('id',$id)->update($data);
            return redirect()->back()->with('message-success','Category details updated successfully . ');
        }
    }
    public function subcategory($id){
        $category = Category::find($id);
        $list = SubCategory::where('cat_id',$id)->latest()->get();
        return view('backEnd.admin.category.sublist',compact('list','category'));
    }
    public function addSubCategory(Request $request){
        $validator = Validator::make($request->all(),
        [
            'category' => 'required'
        ],[
            'category.required' => 'Please enter category name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $new = new SubCategory();
            $new->cat_id = $request->cat_id;
            $new->name = $request->category;
            $new->status = 0 ;
            $new->save();
            return redirect()->back()->with('message-success','Sub category added successfully .');
        }
    }
    public function updateSubCategory($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'category' => 'required'
        ],[
            'category.required' => 'Please enter category name'
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            $data = [
                'cat_id' => $request->cat_id,
                'name' => $request->category,
                'status' => $request->status
            ];
            SubCategory::where('id',$id)->update($data);
            return redirect()->back()->with('message-success','sub category details updated successfully . ');
        }
    }
    public function ListProducts(){
        $list = Product::orderBy('order','asc')->get();
        // dd($list);
        return view('backEnd.admin.product.list',compact('list'));
    }
    public function createProduct(){
        $categories = Category::where('status',0)->latest()->get();
        return view('backEnd.admin.product.pages.detail',compact('categories'));
    }
    public function getSubcategory(Request $request){
        $sub = SubCategory::where('cat_id',$request->cat_id)->where('status',0)->get();
        $html = '';
		foreach ($sub as $subclass) {
			$html .= '<option value="'.$subclass->id.'">'.$subclass->name.'';
		}
        return $html;
    }
    public function SaveProduct(Request $request){
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'titlear' => 'required',
            'category' => 'required|not_in:0',
            'subcategory' => 'required',
            'description' => 'required',
            'descriptionar' => 'required',
            'sort' => 'required',
            'time' => 'required',
            'type' => 'required',
            'unit' => 'required',
            'tags' => 'required',
            'files' =>'required',
            'link' => 'required',
        ],[
            'title.required' => 'Please enter title',
            'titlear.required' => 'Please enter title Arabic',
            'category.required' => 'Please select category',
            'subcategory.required' => 'Please select sub category',
            'description.required' => 'Please add description',
            'descriptionar.required' => 'Please add description arabic',
            'sort.required' => 'Please add sort order',
            'time.required' => 'Please add preparation time',
            'type.required' => 'Please add preparation type',
            'unit.required' => 'Please add unit',
            'tags.required' => 'Please add tags',
            'files.required' =>'Please add product images',
            'files.dimensions' => 'Please upload image with specified size',
            'link.required' => 'Please add youtube link ID',
        ]);
        if ($validator->fails()) {

            $messages = $validator->messages();
            // dd($messages);
            return redirect()->back()->withErrors($messages)->withInput();

        } else  {
            // dd($request->all());
            $id = IdGenerator::generate(['table' => 'products', 'length' => 6, 'prefix' => 'PRO-']);
            $data = new Product();
            $data->id = $id;
            $data->title = $request->title;
            $data->title_ar = $request->titlear;
            $data->cat_id = $request->category;
            $data->sub_cat_id = $request->subcategory;
            $data->order = $request->sort;
            $data->prep_time =$request->time;
            $data->prep_type = $request->type;
            $data->unit = $request->unit;
            $data->link = $request->link;
            $data->description = $request->description;
            $data->description_ar = $request->descriptionar;
            $data->status = $request->status;
            $data->save();
            $tagData = new ProductTags();
            $tagData->product_id = $id;
            $tagData->tags = implode(',',$request->tags);
            $tagData->save();
            // $i = 0;
            foreach ($request->file('files') as $value) {
            
                $imageName = time(). '.' . $value->getClientOriginalExtension();
                $destination = public_path() . '/product/images/';
                $value->move($destination, $imageName);
                $fileName = $request->root().'/public/product/images/'.$imageName;
                $Image = new ProductImage();
                $Image->product_id = $id;
                $Image->image= $fileName;
                $Image->save();
                // $i++;
            }
            return redirect()->route('Products')->with('message-success','New Product added successfully');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();Session::flush();
        return redirect('admin/login');

    }
}
