<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use App\Models\Major;
use App\Models\Doctor;
use App\Traits\UserTrait;
use Yoeunes\Toastr\Toastr;
use App\Enums\UserTypesEnum;
use Illuminate\Http\Request;
use App\Enums\UserGendersEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    use UserTrait;
    public function index()
    {
        abort_if(Gate::allows('doctor'), 403);
        $doctors = Doctor::with('user', 'user.image', 'major','appointments')->orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.doctors.index', compact('doctors'));
    }
    public function edit(Doctor $doctor)
    {
        // abort_if(Gate::denies('admin'),403);
        $majors = Major::get();
        $genders = UserGendersEnum::all();
        $types = UserTypesEnum::all();
        return view('admin.pages.doctors.edit', compact(['doctor', 'majors', 'types', 'genders']));
    }
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        // dd($doctor);
        $user = $doctor->user;
        $data = $this->updateUser($request, $user);
        $doctordata = [
            'major_id' => $request->major_id,
            'price' => $request->price,
            'address' => $request->address,
            'updated_at' => now(),
        ];
        Doctor::where('id', $doctor->id)->update($doctordata);
        return redirect()->route('admin.doctors.index')->with('success', 'doctor updated successfully');
    }
    public function create()
    {
        abort_if(Gate::allows('doctor'), 403);
        $majors = Major::get();
        $genders = UserGendersEnum::all();
        $type = UserTypesEnum::DOCTOR;
        return view('admin.pages.doctors.create', compact(['majors', 'type', 'genders']));
    }
    public function store(DoctorRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $user = $this->createUser($request, $data);
        Doctor::create([
            'user_id' => $user->id,
            'major_id' => $data['major_id'],
            'price' => $data['price'],
            'address' => $data['address'],
        ]);
        return redirect()->route('admin.doctors.index')->with('success', 'doctor added successfully');
    }
    public function destroy(Doctor $doctor)
    {
        if ($doctor->user->image) {
            Storage::delete('public/' . $doctor->user->image->path);
            $doctor->user->image()->delete();
        }
        $doctor->user->delete();
        $doctor->delete();
        return redirect()->back()->with('success', 'admin deleted successfully');
    }
}
