<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Mail;
use Image;
use App\Category;
use App\User;
use App\Subcategory;
use App\ShipAddress;
use App\Brand;
use App\Order;
use App\CustomerPeriodData;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class CustomerLoginController extends Controller
{
    public function customer_login(){


        $cartCollection = \Cart::getContent();

    	return view('front.customer_login',['cartCollection'=>$cartCollection]);

    }



    public function customer_register(){


        $cartCollection = \Cart::getContent();

    	return view('front.customer_register',['cartCollection'=>$cartCollection]);

    }


    public function customer_login_header(){


        $cartCollection = \Cart::getContent();

    	return view('front.customer_login_header',['cartCollection'=>$cartCollection]);

    }



    public function customer_register_header(){


        $cartCollection = \Cart::getContent();

    	return view('front.customer_register_header',['cartCollection'=>$cartCollection]);

    }

    public function customer_registration_post(Request $request){

        $this->validate($request, [
            'phone' => 'required',
            'name' => 'required',
            'email' => 'email | unique:users',
            'lname' => 'required',
            'password' => 'min:8',
        ]);

        $store_data = new User();
        $store_data->name = $request->name;
        $store_data->phone = $request->phone;
        $store_data->lname = $request->lname;
        $store_data->non_verified_email = $request->email;
        $store_data->password = Hash::make($request->password);
        $store_data->save();

                $customerId = $store_data->id;
                Session::put('customerId',$customerId);


                $fullName = $request->name.' '.$request->lname;

                $sub = "🌸 Welcome to Girly Bag - Your Personal Women"."'"."s Health and Shopping Companion! 🛍";


                Mail::send('emails.emailVerificationEmail', ['id' => $customerId,'email'=>$request->email,'name'=>$fullName], function($message) use($request,$sub){
                    $message->to($request->email);
                    $message->subject($sub);
                });

        Toastr::success('Check Mail For Verification :)' ,'Success');
        return redirect('customer_login')->with('success','Check Mail For Verification ');
    }


    public function customer_data_store(Request $request){

        $this->validate($request, [
            'phone' => 'required',
            'name' => 'required',
            'email' => 'email | unique:users',
            'lname' => 'required',
            'password' => 'min:3',
        ]);


        $store_data = new User();
        $store_data->phone = $request->phone;
        $store_data->name = $request->name;
        $store_data->lname = $request->lname;
        $store_data->non_verified_email = $request->email;
        $store_data->password = Hash::make($request->password);
        $store_data->save();

                $customerId = $store_data->id;
                Session::put('customerId',$customerId);

                 $fullName = $request->name.' '.$request->lname;

                $sub = "🌸 Welcome to Girly Bag - Your Personal Women"."'"."s Health and Shopping Companion! 🛍";


                Mail::send('emails.passwordResetEmail', ['id' => $customerId,'email'=>$request->email,'name'=>$fullName], function($message) use($request,$sub){
                    $message->to($request->email);
                    $message->subject($sub);
                });


                // Mail::send('emails.passwordResetEmail', ['id' => $customerId], function($message) use($request){
                //     $message->to($request->email);
                //     $message->subject('Confirmation Mail');
                // });

        Toastr::success('Check Mail For Verification :)' ,'Success');
        return redirect()->route('customer_dashoard.login')->with('success','Check Mail For Verification ');





    }


    public function customer_login_post(Request $request){
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);


			if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
				// Redirect to dashboard
				//Toastr::success('Successully login :)' ,'Success');
				return redirect('/home');
			} else {
				// Search using username

				// error
			  //Toastr::error('Invalid email and password :)' ,'Error');
				return redirect()->back();
			}

    }


    public function customer_login_check(Request $request){


        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);


			if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
				// Redirect to dashboard
				//Toastr::success('Successully login :)' ,'Success');
				return redirect('/shipping');
			} else {
				// Search using username

				// error
			  //Toastr::error('Invalid email and password :)' ,'Error');
				return redirect()->back();
			}
		}


       public function email_confirmation($id){

        $userList = User::where('id',$id)->value('non_verified_email');
        $store_data = User::find($id);
        $store_data->email = $userList;
        $store_data->save();

       Toastr::success('Successfully Confirmed,Now Login:)' ,'Success');
        return redirect()->route('customer_dashoard.login')->with('success','Successfully Confirmed,Now Login');

       }


       public function email_confirmation_account($id){

        $userList = User::where('id',$id)->value('non_verified_email');
        $store_data = User::find($id);
        $store_data->email = $userList;
        $store_data->save();

        Toastr::success('Successfully Confirmed,Now Login:)' ,'Success');
        return redirect('customer_login')->with('success','Successfully Confirmed,Now Login');
       }



        public function customer_information_edit(Request $request){




            $store_data = User::find($request->id);
            $store_data->name = $request->name;
            $store_data->phone = $request->phone;
            $store_data->lname = $request->lname;
            $store_data->email = $request->email;

            $store_data->save();



            //Toastr::success('Successfully Updated :)' ,'Success');
            return redirect()->back();





        }


        public function customer_addresss(){
            $auth = Auth::user()->id;
            $cartCollection = \Cart::getContent();
            $new_add = ShipAddress::where('user_id',$auth)->first();

           // dd(count($new_add));
            return view('front.customer_address',['cartCollection'=>$cartCollection,'new_add'=>$new_add]);
        }



        public function customer_history(){

            $cartCollection = \Cart::getContent();
            $auth = Auth::user()->id;
            $order_history = Order::where('user_id',$auth)->get();

            return view('front.customer_history',['cartCollection'=>$cartCollection,'order_history'=>$order_history]);

        }



        public function period_information(){

            $auth = Auth::user()->id;
            $periodHistory=CustomerPeriodData::where('user_id',$auth)->get();


            $periodDate =CustomerPeriodData::where('user_id',$auth)->value('period_date');









            return view('front.customer_period_information',[
                'periodHistory'=>$periodHistory,

            ]);


        }



        public function customer_addresss_edit(Request $request){




            $store_data = ShipAddress::find($request->id);
            $store_data->country = $request->country;
            $store_data->dis = $request->dis;
            $store_data->address = $request->address;
            $store_data->phone = $request->phone;

            $store_data->save();



           // Toastr::success('Successfully Updated :)' ,'Success');
            return redirect()->back();





        }


        public function customer_addresss_store(Request $request){




            $store_data = new ShipAddress();
            $store_data->country = $request->country;
            $store_data->dis = $request->dis;
            $store_data->address = $request->address;
            $store_data->phone = $request->phone;
            $store_data->user_id = Auth::user()->id;
            $store_data->save();



            Toastr::success('Successfully Added :)' ,'Success');
            return redirect()->back();





        }





}
