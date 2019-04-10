<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Users;
use App\Role;
use App\Cart;
use App\ProductType;
use App\Image;
use App\Product;
use Session;
class UserController extends Controller
{

    public function index() {
        $users = Users::all();
        $role = Role::all();
        return view('admin.user.index',['users'=>$users,'role'=>$role]);
     }

    public function create() {
        $users = Users::all();
        return view('admin.user.create',['users'=>$users]);
     }
     public function store() {
        $users = Users::all();
        return view('admin.user.create',['users'=>$users]);
     }

     public function edit($id) {
        $users = Users::find($id);
        $roles = Role::all();
        return view('admin.user.edit',['users'=>$users,'roles'=>$roles]);
     }
     
     public function update(UserRequest $request, $id)
     {
         $user = Users::find($id);
         $user->id_role=$request->id_role;
         $user->name=$request->name;
         $user->phone_number=$request->phone_number;
         $user->email=$request->email;
         $user->password=$request->password;
         $user->address=$request->address;
         $user->save();
         return redirect('admin/user/index')->with('messages','Sua thanh cong');
     }
     
     public function show($id) {
      $users = Users::where('id',$id)->get();
      return view('admin.user.show',['users'=>$users]);
     }

     public function destroy($id) {
        $users = Users::destroy($id);
        return redirect('admin.user.index')->with('thongbao','Xóa người dùng thành công');
    
     }
     public function search(Request $req)
     {
       $img = Image::all();
       $keyword = $req->keyword;
       $pro = Product::where('product_name','like','%'.$keyword.'%')->get();
       return view('customer.page.search',['product' => $pro,'img'=>$img,'keyword'=>$keyword]);
     }
 

    public function login()
    {
        return view('loginadmin');
    }

    public function checkLogin(Request $req)
        {
            if (Auth::attempt(['email' => $req->email, 
                'password' => $req->password, 
                'id_role' => 1]))
            {
                return redirect('home');
            }
            elseif (Auth::attempt(['email' => $req->email, 
                'password' => $req->password,
                'id_role' => 2]))
            {
                return redirect('admin/user/index');
            }
            else{
                return redirect('login')->with('login_errors','Đăng nhập không thành công, Vui lòng kiểm tra lại');
            }
        }



    public function register(){
        return view('register');
    }
    
    public function checkregister(Request $rq){
        $this->validate($rq,
        [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone_number'=>'required',
            'address'=>'required',
            'password'=>'required|min:3|max:20',
            're_password'=>'required|same:password'
        ],
        [
            'name.required'=>'Vui lòng nhập tên của bạn',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email này đã có người sử dụng',
            'phone_number.required'=>'Vui lòng nhập số điện thoại của bạn',
            'address.required'=>'Vui lòng nhập địa chỉ của bạn',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'Password ít nhất 5 kí tự',
            'password.max'=>'Password tối đa 20 kí tự',
            're_password.required'=>'Vui lòng xác nhận lại password',
            're_password.same'=>'Password không giống nhau'
        ]
        );
        $users = new Users();
        $users->name = $rq->name;
        $users->email = $rq->email;
        $users->phone_number = $rq->phone_number;
        $users->address = $rq->address;
        $users->password = bcrypt($rq->password);
        $users->id_role = '1';
        $users->save();
        return redirect()->back()->with('thongbao', 'Tạo tài khoản thành công');
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('cart');
        return redirect()->route('home');
    }
 }
