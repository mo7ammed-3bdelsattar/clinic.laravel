<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Patient;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Enums\UserGendersEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    use UserTrait;
    public function index()
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('patients.view'), 403);
        $patients = Patient::with('user','user.image')->paginate(10);
        return view('admin.pages.patients.index', compact('patients','auth'));
    }

    public function create()
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('patients.create'), 403);
        $genders = UserGendersEnum::all();
        return view('admin.pages.patients.create' , compact('genders'));
    }

    public function store(PatientRequest $request)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('patients.create'), 403);
        $data = $request->validated();
        $user = $this->createUser($request, $data);
        $patient = Patient::create([
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('patients.update'), 403);
        $genders = UserGendersEnum::all();
        return view('admin.pages.patients.edit', compact('patient', 'genders'));
    }

    public function update(PatientRequest $request, Patient $patient)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('patients.update'), 403);
        $this->updateUser($request, $patient->user);
        $patient->update([
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully');
    }

    public function destroy(Patient $patient)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('patients.delete'), 403);
        if($patient->user->image){
            Storage::delete('public/'.$patient->user->image->path);
            $patient->user->image()->delete();
        }
        $patient->user->delete();
        return redirect()->route('admin.patients.index')->with('success', 'Patient deleted successfully');
    }
}
