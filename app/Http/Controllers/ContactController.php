<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          Contact::where('status', 'unread')->update([
        'status' => 'read'
    ]);
 $contact = Contact::latest()->paginate(7);

        return view('admin.contact.index',compact('contact'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->contactValidator($request->all())->validate();
        // return $request;
        $contact=new Contact();
       $contact->name= $request->name;
       $contact->email=$request->email;
       $contact->phone=$request->phone;
       $contact->message=$request->message;
       $contact->status="unread";
       $contact->save();
       return redirect()->back()->with('success','Send Message Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $contact = Contact::findOrFail($id);
         if ($contact->status == 'unread') {
        $contact->status = 'read';
        $contact->save();
            return view('admin.contact.show', compact('contact'));

    }

    }

      public function view($id)
    {
            $contact = Contact::findOrFail($id);

            return view('admin.contact.show', compact('contact'));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function viewMail($id){
        // return $id;
                $mail=Contact::findOrFail($id);
                return view('admin.contact.sendMail',compact('mail'));

    }

     public function sendMail(Request $request,$id)
    {
        $mail=Contact::findOrFail($id);
           $details = [
        'greeting' => $request->greeting,
        'body' => $request->body,
        'action_text' => $request->action_text,
        'action_url' => $request->action_url,
        'end_line' => $request->end_line,
        'subject' => 'Reply to your message'
    ];
    Mail::to($mail->email)->send(new SendMail($details));

    return redirect()->back()->with('success', 'Email sent to '.$mail->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=Contact::findOrFail($id);
        $id->delete();
        return redirect()->back();
    }

       protected function contactValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'string',


            ],
            'phone' => ['required', 'string'],
           'message'=>['required','string']

        ]);
    }
}
