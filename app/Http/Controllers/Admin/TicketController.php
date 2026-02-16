<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('order')->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        // Handle checkbox - if not checked, it won't be in request
        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('tickets', 'public');
        }

        Ticket::create($validated);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket created successfully!');
    }

    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        // Handle checkbox - if not checked, it won't be in request
        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($ticket->image) {
                Storage::disk('public')->delete($ticket->image);
            }
            $validated['image'] = $request->file('image')->store('tickets', 'public');
        }

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->image) {
            Storage::disk('public')->delete($ticket->image);
        }
        
        $ticket->delete();

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted successfully!');
    }
}
