<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::paginate(15);
        return view('admin.student.students', compact('students'));
    }

    public function create() {
        return view('admin.student.create');
    }


    public function store(Request $request)
    {
        // Parse the incoming data string into an array
        parse_str($request->input('data'), $formData);

        $validator = Validator::make($formData, [
            'fname'     => 'required|string|max:255',
            'lname'     => 'required|string|max:255',
            'gender'    => 'required|in:male,female',
            'dob'       => 'nullable',
            // 'phone'     => 'nullable|string|max:20',
            // 'email'     => 'nullable|email|max:255',
            'village'   => 'nullable|string|max:255',
            'commune'   => 'nullable|string|max:255',
            'district'  => 'nullable|string|max:255',
            'province'  => 'nullable|string|max:255',
            // 'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 800KB
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        // $imageName = time() . '.' . $formData['image']->extension();
        // $formData['image']->move(public_path('uploads/students/'), $imageName);
        // Create student
        $student = new Student();
        $student->fname = $formData['fname'];
        $student->lname = $formData['lname'] ?? null;
        $student->gender = $formData['gender'];
        $student->dob = $formData['dob'] ?? null;
        // $student->phone = $formData['phone'];
        // $student->email = $formData['email'];
        // $student->image = $imageName;
        $student->save();

        // Create address (polymorphic)
        $student->address()->create([
            'village'  => $formData['village'] ?? null,
            'commune'  => $formData['commune'] ?? null,
            'district' => $formData['district'] ?? null,
            'province' => $formData['province'] ?? null,
        ]);

        // Create address (polymorphic)
        $student->class()->create([
            'name'  => 2 ?? null,
            'section'  => 2 ?? null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully!',
            'student' => $student
        ], 201);
    }


    public function edit(Request $request)
    {
        $student = Student::with('address')->find($request->id);
    
        if (!$student) {
            return response()->json(['error' => 'Student not found.'], 404);
        }
    
        return response()->json([
            'id'       => $student->id,
            'fname'    => $student->fname,
            'lname'    => $student->lname,
            'dob'      => $student->dob,
            // 'email'    => $student->email,
            'gender'   => $student->gender,
            'class_id' => $student->class_id,
            'address'  => [
                'village'  => $student->address->village ?? '',
                'commune'  => $student->address->commune ?? '',
                'district' => $student->address->district ?? '',
                'province' => $student->address->province ?? '',
            ]
        ]);
    }
    

    public function delete(Request $request)
    {
        return Student::find($request->id);
    }

    /*--------------- Destroy --------------*/
    public function destroy(Request $request)
    {
        parse_str($request->input('data'), $formData);
        return Student::where('id', $formData['id'])->delete();
    }
}
