<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;





class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:عرض مستخدم', ['only' => ['index']]);
        $this->middleware('permission:اضافة مستخدم', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل مستخدم', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف مستخدم', ['only' => ['destroy']]);
    }

    /**
     * عرض قائمة المستخدمين
     */
    public function index(Request $request)
    {

        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.show_users', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * عرض صفحة إضافة مستخدم جديد
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.Add_user', compact('roles'));
    }

    /**
     * حفظ المستخدم الجديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));

        return redirect()->route('users.index')
            ->with('success', 'تم إضافة المستخدم بنجاح');
    }

    /**
     * عرض تفاصيل مستخدم معين
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * عرض صفحة تعديل المستخدم
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name')->toArray();


        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * تحديث بيانات المستخدم
     */
    public function update(Request $request, $id)
    {
         $request->validate([
        'name' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($id),
        ],
        'password' => 'nullable|same:confirm-password',
        'roles' => 'required'
         ]);

        $input = $request->all();

        // تشفير كلمة المرور إذا تم إدخالها
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        $user = User::findOrFail($id);
        $user->update($input);

        // تحديث الأدوار بطريقة حديثة
        $user->syncRoles($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'تم تحديث معلومات المستخدم بنجاح');
    }

    /**
     * حذف مستخدم
     */
    public function destroy(Request $request)
    {
        User::findOrFail($request->user_id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }

}
