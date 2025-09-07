<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $type;
    protected $model;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->type = getUserType();
            return $next($request);
        });
        $this->model = new Contact();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = $this->model->where('user_id', auth()->id())->paginate(10);
        return view('profile.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'  => 'required|in:email,phone,address',
            'value' => 'required|string|max:255',
        ]);

        $contact = new Contact();
        $contact->user_id = auth()->id();
        $contact->type = $validated['type'];
        $contact->value = $validated['value'];
        $contact->save();

        return redirect()->route('profile.contacts.index')
            ->with('success', 'Contact added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = $this->model->where('user_id', auth()->id())->findOrFail($id);
        return view('profile.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type'  => 'required|in:email,phone,address',
            'value' => 'required|string|max:255',
        ]);

        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->update($validated);

        return redirect()->route('profile.contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->delete();

        return redirect()->route('profile.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
