<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\HealthFacility;
use App\Models\Municipality;
use App\Models\Patient;
use App\Models\PatientStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            $patients = Patient::orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $health_id = $user->health_facility_id;

            $patients = Patient::where('health_facility_id', $health_id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }


        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_user = Auth::user();
        $health_id = $auth_user->health_facility_id;

        $beds = Patient::BEDS;
        $hospitals = HealthFacility::all();
        $case_definitions = Patient::CASE_DEFINITIONS;
        $symptoms_classifications = Patient::SYMPTOMS_CLASSIFICATIONS;
        $patient_statuses = PatientStatus::all();
        $municipalities = Municipality::all();
        $genders = Patient::GENDER;
        $groupedHospitals = $hospitals->groupBy('municipality.name');
        return view('patients.create', compact('groupedHospitals', 'genders', 'beds', 'municipalities', 'case_definitions', 'symptoms_classifications', 'patient_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $auth_user = Auth::user();
        
        $health_id = $auth_user->health_facility_id;
        
        if ($patient->health_facility_id !== $health_id && !$auth_user->isSuperAdmin())  {
            abort(403, "Access denied");
        }

        $beds = Patient::BEDS;
        $hospitals = HealthFacility::all();
        $case_definitions = Patient::CASE_DEFINITIONS;
        $symptoms_classifications = Patient::SYMPTOMS_CLASSIFICATIONS;
        // $case_definitions = CaseDefinition::all();
        // $symptoms_classifications = SymptomsClassification::all();
        $patient_statuses = PatientStatus::all();
        $municipalities = Municipality::all();
        $genders = Patient::GENDER;
        // $genders = Gender::all();
        $groupedHospitals = $hospitals->groupBy('municipality.name');

        return view('patients.edit', compact('groupedHospitals', 'genders', 'patient', 'municipalities', 'beds', 'case_definitions', 'symptoms_classifications', 'patient_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selectedHospital = $request->health_facility_id;
        $selectedBedID = $request->bed_id;
        $hospital = HealthFacility::find($selectedHospital);

        //1 ward
        //2 isolation
        //3 icu
        //refactor this - create this as a new validation rule - !important to fix the STORE bug
        // paraan para maiwasan yung STORE bug - pansamantala
        if ($hospital) {
            if ($selectedBedID == 1 && $hospital->getRemainingWardCapacity() <= 0) {
                return redirect()->back()
                    ->withErrors('There is no available Ward bed in ' . $hospital->name)
                    ->withInput();
            }

            if ($selectedBedID == 2 && $hospital->getRemainingIsolationCapacity() <= 0) {
                return redirect()->back()
                    ->withErrors('There is no available Isolation bed in ' . $hospital->name)
                    ->withInput();
            }

            if ($selectedBedID == 3 && $hospital->getRemainingIcuCapacity() <= 0) {
                return redirect()->back()
                    ->withErrors('There is no available ICU bed in ' . $hospital->name)
                    ->withInput();
            }
        }

        $validated = $request->validate([
            "case_definition_id" => 'required',
            "symptoms_classification_id" => 'required',
            "patient_status_id" => 'required',
            "health_facility_id" => 'required',
            "bed_id" => 'required',

            "first_name" => 'nullable',
            "middle_name" => 'nullable',
            "last_name" => 'nullable',
            "municipality_id" => 'required',
            "gender_id" => 'required|in:1,2',
            "barangay" => 'required',
            "age" => 'required',
            "birthday" => 'nullable',
            "remarks" => 'nullable',
        ]);
        $validated['date_admitted'] = now();
        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', $request->first_name . ' successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $selectedHospital = $request->health_facility_id;
        $selectedBedID = $request->bed_id;
        $hospital = HealthFacility::find($selectedHospital);
        // $patient = Patient::find($request->id);

        // dd($patient);

        //1 ward
        //2 isolation
        //3 icu
        //refactor this - create this as new validation rule - !important to fix the STORE bug
        // paraan para maiwasan yung STORE bug - pansamantala
        if ($hospital) {
            if ($selectedBedID == 1 && $hospital->getRemainingWardCapacity() <= 0 && $patient->health_facility_id != $request->health_facility_id) {
                return redirect()->back()->withErrors('There is no available Ward bed in ' . $hospital->name)->withInput();
            }

            if ($selectedBedID == 2 && $hospital->getRemainingIsolationCapacity() <= 0 && $patient->health_facility_id != $request->health_facility_id) {
                return redirect()->back()->withErrors('There is no available Isolation bed in ' . $hospital->name)->withInput();
            }

            if ($selectedBedID == 3 && $hospital->getRemainingIcuCapacity() <= 0 && $patient->health_facility_id != $request->health_facility_id) {
                return redirect()->back()->withErrors('There is no available ICU bed in ' . $hospital->name)->withInput();
            }
        }

        $validated = $request->validate([
            "case_definition_id" => 'required',
            "symptoms_classification_id" => 'required',
            "patient_status_id" => 'required',
            "health_facility_id" => 'required',
            "bed_id" => 'required',

            "first_name" => 'nullable',
            "middle_name" => 'nullable',
            "last_name" => 'nullable',
            "municipality_id" => 'required',
            "gender_id" => "required|in:1,2",
            "barangay" => 'required',
            "age" => 'required',
            "birthday" => 'nullable',
            "remarks" => 'nullable',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.edit', $patient)->with('success', $patient->first_name . ' successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $name = $patient->first_name;
        $auth_user = Auth::user();  
        $health_id = $auth_user->health_facility_id;
        
        //not sure if needed - I think this is not necessary for destroy
        if ($patient->health_facility_id !== $health_id && !$auth_user->isSuperAdmin())  {
            abort(403, "Access denied");
        }

        $patient->delete();

        return redirect()->back()->with('deleted', $name . ' is successfully deleted!');;
    }
}
