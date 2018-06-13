<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Contact;
use App\Address;

use App\Helpers\Contracts\PaginationPageContract;

class ContactController extends Controller
{
    private $resultsPerPage = 4;
    private $numResults;
    private $numPages;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->numResults = Contact::count();
        $this->numPages = round($this->numResults/$this->resultsPerPage);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request, PaginationPageContract $paginationPageContract)
     {
         if($request->input('num_items') !== null){ // a conditional - that's a bad sign!
             $this->resultsPerPage = $request->input('num_items');
         }

         if($request->input('search_terms')){ // another one!
             $contacts = Contact::search($request->input('search_terms'))->paginate($this->resultsPerPage);
         } else {
             $contacts = Contact::orderBy('last_name','asc')->paginate($this->resultsPerPage);
         }

         $paginationPageContract->setPaginationPage($contacts->currentPage());

         return view('contacts.index')->with([
             'contacts' => $contacts,
             'page' => $contacts->currentPage(),
             'num_items' => $this->resultsPerPage,
             'search_terms' => ''
         ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact = new Contact; // empty instance to prevent 'non-oject' error in form conditional
        $address = new Address;
        return view('contacts.create')->with([
            'contact'=>$contact,
            'address'=>$address
        ]);

        // $income_bands = IncomeBand::all()->pluck('textual');
        // $organisation_types = OrganisationType::all();
        // $organisation = new Organisation; // empty instance to prevent 'non-oject' error in form conditional
        // $address = new Address; // ditto. NB you can do conditionals in the form, but that is a serious PITA
        // return view('organisations.create')->with([
        //     'organisation'=>$organisation,
        //     'address'=>$address,
        //     'income_bands'=>$income_bands,
        //     'organisation_types'=>$organisation_types
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {

         $this->validate($request, [
             'first_name' => 'required',
             'last_name' => 'required',
             'postcode' => 'required'
         ]);

         $user_id = Auth::id();

         $contact = new Contact;
         $contact->first_name = $request->input('first_name');
         $contact->last_name = $request->input('last_name');
         $contact->birth_date = $request->input('birth_date');
         $contact->save();

         $address = new Address;
         $address->line_1 = $request->input('line_1');
         $address->line_2 = $request->input('line_2');
         $address->city = $request->input('city');
         $address->postcode = $request->input('postcode');
         $address->save();

         $contact->addresses()->attach($address,['is_default' => 1]);

         // $attach_data = [];
         // foreach($request->input('organisation_type') as $orgtype){
         //     if(isset($orgtype['id'])){
         //         $attach_data[$orgtype['id']] = array('reg_num'=>$orgtype['reg_num']);
         //     }
         // }
         // $organisation->organisation_types()->attach($attach_data);

         return redirect('/contacts')->with('success', 'Added contact ' . $contact->first_name . " "  . $contact->last_name);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
