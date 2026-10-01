<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use Illuminate\Http\Request;

class SchoolSettingController extends Controller
{
    public function index()
    {
        $school = SchoolSetting::first();
        return view('school.index', compact('school'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'school_name'   => 'required|string|max:255',
            'academic_year' => 'required|string',
            'semester'      => 'required|in:Odd,Even',
            'npsn'          => 'nullable|string',
            'phone'         => 'nullable|string',
            'email'         => 'nullable|email',
            'address'       => 'nullable|string',
        ]);

        $school = SchoolSetting::findOrFail($id);
        $school->update($request->all());

        return redirect()->back()->with('success', 'Data Profil & Periode Akademik Sekolah berhasil diperbarui!');
    }
}
