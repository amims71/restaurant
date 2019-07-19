<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function process($id){
        $con=mysqli_connect('localhost','root','','restaurant');
        $result=mysqli_query($con,"UPDATE orders SET state='Under Process' WHERE oid='".$id."'");
        return back();
    }

    public function complete($id){
        $con=mysqli_connect('localhost','root','','restaurant');
        $result=mysqli_query($con,"UPDATE orders SET state='Completed' WHERE oid='".$id."'");
        return back();
    }

    public function signup(Request $request){
        $name=$request->input('name');
        $phone=$request->input('phone');
        $email=$request->input('email');
        $pass=md5($request->input('pass'));
        $address=$request->input('address');
        $con=mysqli_connect('localhost','root','','restaurant');
        $res=mysqli_query($con,"SELECT * FROM users WHERE email='".$email."'");
        if(mysqli_num_rows($res)>0){
            echo "already exists";
        } else{
            $result=mysqli_query($con,"INSERT INTO users VALUES ('','$name','$email','$phone','$pass','$address')");
            return back();
        }
    }

    public function login(Request $request){
        $email=$request->email;
        $pass=md5($request->pass);
        $con=mysqli_connect('localhost','root','','restaurant');
        $result=mysqli_query($con,"SELECT * FROM users WHERE email='".$email."' AND pass='".$pass."'");
        $row=mysqli_fetch_assoc($result);
        if($row){
            $request->session()->put('uid',$row['uid']);
            $request->session()->put('name',$row['name']);
            return back();
        }
    }
    public function test(Request $request){
        echo $request->session()->get('name');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return back();
    }
    public function cart($id, Request $request){
        $uid=$request->session()->get('uid');
        $fid=$id;
        $con=mysqli_connect('localhost','root','','restaurant');
        $sql="INSERT INTO cart VALUES ('','$uid','$fid')";
        mysqli_query($con,$sql);
        return back();
    }
    public function cartRemove($id){
        $con=mysqli_connect('localhost','root','','restaurant');
        mysqli_query($con,"DELETE FROM cart WHERE cid='".$id."'");
        return back();
    }

    public function order(Request $request){
        $uid=$request->uid;
        $items=$request->items;
        $table_no=$request->table_no;
        $price=$request->price;
        $state='Ordered';

        $con=mysqli_connect('localhost','root','','restaurant');
        $res=mysqli_query($con,"SELECT * FROM orders WHERE uid='".$uid."' AND state='".$state."' AND items='".$items."'");
        if(mysqli_num_rows($res)>0){
            echo "Same Order is already pending";
        } else{
            $result=mysqli_query($con,"INSERT INTO orders VALUES ('','$items','$uid','$state','$table_no','$price')");
            mysqli_query($con,"DELETE FROM cart WHERE uid='".$uid."'");
            return back();
        }
    }

    public function book(Request $request){
        $uid=$request->uid;
        $name=$request->name;
        $date=$request->date;
        $time=$request->time;
        $count=$request->people;
        $state='Under Review';
        $table_no='Not Assigned';

        $con=mysqli_connect('localhost','root','','restaurant');
        $result=mysqli_query($con,"INSERT INTO book VALUES ('','$uid','$name','$date','$time','$count','$table_no','$state')");
        return back();
        // echo $date;
    }

    public function confirm(Request $request){
        $bid=$request->bid;
        $table_no=$request->table_no;
        $status="Confirmed";
        $con=mysqli_connect('localhost','root','','restaurant');
        $result=mysqli_query($con,"UPDATE book SET status='".$status."', table_no='".$table_no."' WHERE bid='".$bid."'");
        return back();
    }
}
