<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketTier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketTierController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $tiers = TicketTier::orderBy('order')->get();
        return view('admin.ticket-tiers.index', compact('tiers'));
    }

    public function create()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        return view('admin.ticket-tiers.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'required|integer|min:0',
        ]);

        $imagePath = $request->file('image')->store('ticket-tiers', 'public');

        TicketTier::create([
            'name' => $request->name,
            'image' => $imagePath,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.ticket-tiers.index')
            ->with('success', 'Ticket tier created successfully.');
    }

    public function edit(TicketTier $ticketTier)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        return view('admin.ticket-tiers.edit', compact('ticketTier'));
    }

    public function update(Request $request, TicketTier $ticketTier)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => $request->name,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($ticketTier->image) {
                Storage::disk('public')->delete($ticketTier->image);
            }
            $data['image'] = $request->file('image')->store('ticket-tiers', 'public');
        }

        $ticketTier->update($data);

        return redirect()->route('admin.ticket-tiers.index')
            ->with('success', 'Ticket tier updated successfully.');
    }

    public function destroy(TicketTier $ticketTier)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        if ($ticketTier->image) {
            Storage::disk('public')->delete($ticketTier->image);
        }

        $ticketTier->delete();

        return redirect()->route('admin.ticket-tiers.index')
            ->with('success', 'Ticket tier deleted successfully.');
    }
}
