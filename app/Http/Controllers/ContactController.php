<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('user_id', auth()->id())->paginate(10);
        return view('frontend.profile.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('frontend.profile.contacts.create');
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'type'  => ['required', Rule::in(['email', 'phone', 'address', 'whatsapp'])],
            'value' => $this->valueRules($type),
        ]);

        Contact::create(array_merge($validated, ['user_id' => auth()->id()]));

        return redirect()->route('user.contacts.index')->with('success', 'Contact added.');
    }

    public function edit($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.profile.contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'type'  => ['required', Rule::in(['email', 'phone', 'address', 'whatsapp'])],
            'value' => $this->valueRules($type),
        ]);

        Contact::where('user_id', auth()->id())->findOrFail($id)->update($validated);

        return redirect()->route('user.contacts.index')->with('success', 'Contact updated.');
    }

    public function destroy($id)
    {
        Contact::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->route('user.contacts.index')->with('success', 'Contact deleted.');
    }

    private function valueRules(?string $type): array
    {
        return match ($type) {
            'email'             => ['required', 'email', 'max:255'],
            'phone', 'whatsapp' => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            default             => ['required', 'string', 'max:500'],
        };
    }
}
