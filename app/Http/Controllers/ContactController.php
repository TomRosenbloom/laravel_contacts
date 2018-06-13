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
             $contacts = Contact::orderBy('order_name','asc')->paginate($this->resultsPerPage);
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
        //
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
