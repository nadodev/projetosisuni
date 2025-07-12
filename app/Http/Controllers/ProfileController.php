<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $showAddressAlert = !$user->hasCompleteAddress();

        return view('profile.edit', [
            'user' => $user,
            'showAddressAlert' => $showAddressAlert,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateInstitution(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:instituicoes,id'
        ]);

        $user = auth()->user();
        $user->update([
            'institution_id' => $request->institution_id
        ]);

        session()->forget('needs_institution_update');

        return redirect()->back()
            ->with('success', 'Instituição atualizada com sucesso!');
    }

    public function updateAddress(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cep' => ['required', 'string', 'size:8'],
            'endereco' => ['required', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'size:2'],
            'numero' => ['required', 'integer'],
            'complemento' => ['nullable', 'string', 'max:255'],
        ]);

        $request->user()->update($validated);

        return Redirect::route('profile.edit')
            ->with('status', 'address-updated');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:1024'], // 1MB Max
        ]);

        $user = $request->user();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }

            // Store the new photo
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->update(['photo_path' => $path]);
        }

        return Redirect::route('profile.edit')
            ->with('status', 'photo-updated');
    }
}
