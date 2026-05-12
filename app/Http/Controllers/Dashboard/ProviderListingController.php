<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ProviderListingStatus;
use App\Models\ProviderListing;
use App\Notifications\ProviderListingStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProviderListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_provider_listings',   ['only' => ['index', 'show']]);
        $this->middleware('permission:update_provider_listings', ['only' => ['updateStatus']]);
        $this->middleware('permission:delete_provider_listings', ['only' => ['destroy']]);
    }

    public function index()
    {
        $listings = ProviderListing::with(['user', 'category'])
            ->orderBy('id', 'DESC')
            ->paginate(15);

        return view('dashboard.provider-listings.index', compact('listings'));
    }

    public function show(ProviderListing $providerListing)
    {
        $providerListing->load(['user', 'category']);
        return view('dashboard.provider-listings.show', compact('providerListing'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status'      => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $listing = ProviderListing::findOrFail($id);
        $listing->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        $listing->load('user');
        $listing->user?->notify(new ProviderListingStatusNotification($listing));

        $label = $request->status === 'approved' ? 'اعتمدت' : 'رُفضت';
        return back()->with('success', "تم تحديث حالة الخدمة: {$label}");
    }

    public function destroy(string $id)
    {
        $listing = ProviderListing::findOrFail($id);
        if ($listing->image) delete_file($listing->image);
        $listing->delete();
        return back()->with('success', 'تم حذف الخدمة');
    }
}
