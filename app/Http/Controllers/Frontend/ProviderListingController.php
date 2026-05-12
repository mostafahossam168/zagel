<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProviderListing;
use Illuminate\Http\Request;

class ProviderListingController extends Controller
{
    public function index()
    {
        $user     = auth()->user();
        $listings = $user->providerListings()->with('category')->latest()->get();
        $categories = Category::all();
        return view('front.user.my-listings', compact('listings', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('front.user.submit-service', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'image'           => 'nullable|image|max:3072',
            'category_id'     => 'nullable|exists:categories,id',
            'price'           => 'nullable|numeric|min:0',
            'currency'        => 'nullable|string|max:10',
            'contact_phone'   => 'required|string|max:20',
            'contact_whatsapp'=> 'nullable|string|max:20',
            'contact_email'   => 'nullable|email|max:255',
            'contact_facebook'=> 'nullable|url|max:255',
            'contact_twitter' => 'nullable|url|max:255',
            'contact_linkedin'=> 'nullable|url|max:255',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = store_file($request->file('image'), 'provider-listings');
        }

        $contactLinks = array_filter([
            'facebook' => $request->contact_facebook,
            'twitter'  => $request->contact_twitter,
            'linkedin' => $request->contact_linkedin,
        ]);

        ProviderListing::create([
            'user_id'          => auth()->id(),
            'title'            => $request->title,
            'description'      => $request->description,
            'image'            => $image,
            'category_id'      => $request->category_id,
            'price'            => $request->price,
            'currency'         => $request->currency ?? 'ر.س',
            'contact_phone'    => $request->contact_phone,
            'contact_whatsapp' => $request->contact_whatsapp,
            'contact_email'    => $request->contact_email,
            'contact_links'    => $contactLinks ?: null,
            'status'           => 'pending',
        ]);

        return redirect()->route('user.listings.index')
            ->with('success', 'تم إرسال خدمتك بنجاح، سيتم مراجعتها من قبل الفريق قريباً');
    }

    public function edit(ProviderListing $listing)
    {
        abort_if($listing->user_id !== auth()->id(), 403);
        $categories = Category::all();
        return view('front.user.my-listings', [
            'listings'   => auth()->user()->providerListings()->with('category')->latest()->get(),
            'categories' => $categories,
            'editListing' => $listing,
        ]);
    }

    public function update(Request $request, ProviderListing $listing)
    {
        abort_if($listing->user_id !== auth()->id(), 403);

        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'image'           => 'nullable|image|max:3072',
            'category_id'     => 'nullable|exists:categories,id',
            'price'           => 'nullable|numeric|min:0',
            'currency'        => 'nullable|string|max:10',
            'contact_phone'   => 'required|string|max:20',
            'contact_whatsapp'=> 'nullable|string|max:20',
            'contact_email'   => 'nullable|email|max:255',
            'contact_facebook'=> 'nullable|url|max:255',
            'contact_twitter' => 'nullable|url|max:255',
            'contact_linkedin'=> 'nullable|url|max:255',
        ]);

        $data = [
            'title'            => $request->title,
            'description'      => $request->description,
            'category_id'      => $request->category_id,
            'price'            => $request->price,
            'currency'         => $request->currency ?? 'ر.س',
            'contact_phone'    => $request->contact_phone,
            'contact_whatsapp' => $request->contact_whatsapp,
            'contact_email'    => $request->contact_email,
            'contact_links'    => array_filter([
                'facebook' => $request->contact_facebook,
                'twitter'  => $request->contact_twitter,
                'linkedin' => $request->contact_linkedin,
            ]) ?: null,
            'status'           => 'pending',
        ];

        if ($request->hasFile('image')) {
            if ($listing->image) delete_file($listing->image);
            $data['image'] = store_file($request->file('image'), 'provider-listings');
        }

        $listing->update($data);

        return redirect()->route('user.listings.index')
            ->with('success', 'تم تحديث الخدمة وأُعيدت للمراجعة. سيتم إشعارك عند الموافقة.');
    }

    public function destroy(ProviderListing $listing)
    {
        abort_if($listing->user_id !== auth()->id(), 403);
        if ($listing->image) delete_file($listing->image);
        $listing->delete();
        return back()->with('success', 'تم حذف الخدمة بنجاح');
    }
}
