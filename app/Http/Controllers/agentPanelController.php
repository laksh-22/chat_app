<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userdetail;
use App\Models\Chatdetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class agentPanelController extends Controller
{
    public function reset(Request $req)
    {
        $userdetail = Userdetail::where('email',$req->email)->get()->first();
        if($userdetail)
        {
            $passwordHashStatus = Hash::check($req->oldpassword,$userdetail->password);
            if($passwordHashStatus)
            {
                if($req->newpassword == $req->confirmpassword)
                {
                    $id = $userdetail->id;
                    $rowToBeUpdated = Userdetail::find($id);
                    $rowToBeUpdated->password = Hash::make($req->newpassword);
                    
                    $rowToBeUpdated->firstTimeLogin = 1;
                    $rowToBeUpdated->save();
                    
                    session()->pull('role',null);

                    // return view('agentResetPass',['successMessage' => 'Password changed successfully']);
                    return redirect('login')->with('password','Password changed successfully');
                }
                else
                {
                    $error = "Password and confirm password are not same";
                }
            }
            else
            {
                $error = "Please enter the same password as sent on your registered mail";
            }
        }
        else
        {
            $error = "Please enter your registered email";
        }

        return view('agentResetPass',['errorMessage' => $error]);
    }


    public function viewAgents()
    {
        // $userdetail = Userdetail::where('role','Agent')->get();
        $userdetail = Userdetail::all();
        return ['status' => true ,'lists' => $userdetail];
        // return view('/agentpanel',['lists' => $userdetail]);
    }

    public function loadChat($id)
    {

        $loggedInUser = session('id');
        $receiverUser = $id;
        

        $chatMessage = Chatdetail::orderBy('created_at')
                 ->get()->toArray();

                //  $lastMessage = count($chatMessage);
                //  $messageCount = 1;

        $messages = [];
        foreach($chatMessage as $message)
        {
            if( ($message['senderId'] == $loggedInUser) && ($message['receiverId'] == $receiverUser) )
            {
                $message['type']='outgoing';

                $name = Userdetail::find($loggedInUser);
                $message['personname'] = $name->name;

                $time = $message['created_at'];
                $chattime = date("h:i:A",strtotime($time));
                // $chattime = Carbon::now->addMinutes('330')->timestamp;
                $message['time'] = $chattime;                
            }
            else{
                if( ($message['senderId'] == $receiverUser) && ($message['receiverId'] == $loggedInUser) ){
                    $message['type']='incoming';

                    $name = Userdetail::find($receiverUser);
                    $message['personname'] = $name->name;
                    

                    $time = $message['created_at'];
                    $chattime = date("h:i:A",strtotime($time));
                    // $chattime = Carbon::now->addMinutes('330')->timestamp;
                    $message['time'] = $chattime;
                    
                }else{
                    unset($message);
                }
            }
                // $array = [];

                // if(isset($message) && $messageCount == $lastMessage){
                //     $message['lastMessage'] = 1; 
                // }

            if(isset($message)){
                unset($message['senderId'],$message['receiverId'],$message['id'],$message['updated_at']);

                $messages[] = $message;
            }

            // $messageCount++;
        }

        return ['status' => 200, 'name'=> Userdetail::find($receiverUser)->name , 'messages' => $messages];

        // return view('chatpage',['messages' => $messages]);
    }

    public function saveChat(Request $req)
    {
        $chatdetail = new Chatdetail;
        $chatdetail->senderId = $req->sender;
        $chatdetail->receiverId = $req->receiver;
        $chatdetail->message = $req->message;
        
        // date("h:i:A",strtotime($time));
        $chatdetail->created_at = Carbon::now()->addminutes('330');

        $chatdetail->save();

        return response()->json([

            'status'=>'200',

            'message'=>'Message sent successfully'

        ]);
        // return ['response' => 'Message Sent'];

        // return redirect('/showchat');
        // return view('agentpanel');
        // return redirect('/loadchat');

    }
    public function createfile(Request $req)
    {
        $loggedInUser = session('id');
        $receiverUser = $req->backupid;
        Storage::disk('local')->put("$loggedInUser-$receiverUser.csv", 'Backup');

        $chatMessage = Chatdetail::orderBy('created_at')->get();
        $msg = [];
        foreach($chatMessage as $message)
        {
            if( ($message['senderId'] == $loggedInUser) && ($message['receiverId'] == $receiverUser) )
            {
                $message['type']='outgoing';
                $message['message'] = Crypt::encryptString($message['message']);

                


                // Storage::append("$loggedInUser$receiverUser.csv", $message['senderId']);
                // Storage::append("$loggedInUser$receiverUser.csv", $message['receiverId']);
                Storage::append("$loggedInUser-$receiverUser.csv",$message);
                // Storage::append("$loggedInUser$receiverUser.csv", $message['senderId'],$message['receiverId'],$message['message']);

            }
            else if( ($message['senderId'] == $receiverUser) && ($message['receiverId'] == $loggedInUser) )
            {
                $message['type']='incoming';
                $message['message'] = Crypt::encryptString($message['message']);

               

                // Storage::append("$loggedInUser$receiverUser.csv", $message['senderId'],$message['receiverId'],$message['message']);
                // Storage::append("$loggedInUser$receiverUser.csv", $message['senderId']);

                // Storage::append("$loggedInUser$receiverUser.csv", $message['receiverId']);
                Storage::append("$loggedInUser-$receiverUser.csv", $message);
            }
        }
        
        // return $senderData;
        // Storage::put('back.txt','lakshya');

        return redirect('agentpanel');
    }
    // public function appendToFile()
    // {
    //     Storage::put('back.txt','lakshya');
    // }
    public function DeleteChat(Request $req)
    {
        $senderData = Chatdetail::where('senderId',session('id'))->Where('receiverId',$req->idd);
        $senderData->delete();
        $receiverData = Chatdetail::where('senderId',$req->idd)->Where('receiverId',session('id'));
        $receiverData->delete();
        return redirect('agentpanel');
    }
    public function RestoreChat(Request $req)
    {
        $loggedInUser = session('id');
        $receiverUser = $req->restoreid;
        $contents = Storage::get("$loggedInUser-$receiverUser.csv");
        // $con = JSON.parse($contents);
        // $con = $contents->toJson();
        // $contentss = file("$loggedInUser$receiverUser.txt");
        // $contents = json_encode($contents);
        // $contents->get(message);
        // foreach($contents as $content)g
        // {
            $location = "app";
            $filename = "$loggedInUser-$receiverUser.csv";
            $filepath = storage_path($location."/".$filename);
            $file = fopen($filepath,"r");
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
                
                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                   $i++;
                   continue; 
                }       
                for ($c=0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
             }
             fclose($file);
             foreach($importData_arr as $importData){
            //    explode(',', $importData);
            // dd( array_values($importData) );
            // array_values($importData);
                $chatdetail = new Chatdetail();
                // dd(explode(":",$importData[3]));
                // return array_values(explode(',',$importData[1]));
                // $chatdetail->senderId = array_values(explode(',',$importData[1]));
                $import = explode(":",$importData[1]);
                // trim($import[1],'""');
                // dd($import[1]);
                $chatdetail->senderId = $import[1];
                
                $import = explode(":",$importData[2]);

                $chatdetail->receiverId = $import[1];
                $import = explode(":",$importData[3]);
                // dd(substr($import[1], 1, -1));
                // dd($import[1]);
                $r = substr($import[1], 1, -1);
                // dd($r);
                $chatdetail->message = Crypt::decryptString($r);

                // $import = explode(":",$importData[4]);
                // $c = substr($importData[4], 1, -1);
                $c = substr($importData[4], 11, -1);

                // echo $c;
                // echo "-------------";
                $e = str_replace("T", " ", $c);
                // echo $e;
                // echo "-------------";
                $e = substr($e, 0, strpos($e, "."));
                // echo $e;
                // echo "-------------";
                $e = substr($e,1,-1);
                // echo $e;


                // dd('test');
                $chatdetail->created_at = $e;
                
                $d = substr($importData[5], 11, -1);
                // echo $d;
                // echo "-------------";
                $f = str_replace("T", " ", $d);
                // echo $f;
                // echo "-------------";
                $f = substr($f, 0, strpos($f, "."));
                // echo $f;
                // echo "-------------";
                $f = substr($f,1,);
                // echo $f;

                $chatdetail->updated_at = $f;

                // dd('test');


                // $chatdetail->updated_at = $import[1];

                // $chatdetail->created_at =$importData[4];
                // $chatdetail->updated_at =$importData[5];
                $chatdetail->save();

    
              }
            // echo $contents;
        // }
        return redirect('agentpanel');
    }
}