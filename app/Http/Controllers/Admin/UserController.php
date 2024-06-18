<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = new User();
        // $user->name = "Super Admin";
        // $user->email = "admin@wdcoders.com";
        // $user->password = Hash::make("123456");
        // $user->save();
        $page_title = "Users";
        $page_breadcrumbs = array(
            array('title' => $page_title, 'url' => 'javascript:void(0)', 'active' => false),
            array('title' => 'Manage', 'url' => '', 'active' => true),
        );
        return view('admin.user.list', compact('page_title', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Users";
        $page_breadcrumbs = array(
            array('title' => $page_title, 'url' => route('admin.user'), 'active' => false),
            array('title' => 'Create', 'url' => '', 'active' => true),
        );
        $user = null;
        return view('admin.user.form', compact('page_title', 'page_breadcrumbs', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => 'required',
            "email" => 'required',
            "password" => 'required'
        ], [
            "name" => "The user field is required."
        ]);

        try {
            $user = new User();
            $user->name = ucfirst($request->name);
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->save();
            // dd($user);
            // die;

            $notification = array(
                'message' => config("messages.user.create"),
                'type' => 'success'
            );
            return redirect()->route("admin.user")->with($notification);
        } catch (Throwable $e) {
            $notification = array(
                'message' => config("messages.error.wrong"),
                'type' => 'error'
            );
        }
        return redirect()->route("admin.user.create")->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_title = "Users";
        $page_breadcrumbs = array(
            array('title' => 'Users', 'url' => route('admin.user'), 'active' => false),
            array('title' => 'Update', 'url' => '', 'active' => true),
        );
        $user = user::where('id', $id)->first();
        return view('admin.user.edit', compact('page_title', 'page_breadcrumbs', 'user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();

        $this->validate($request, [
            "name" => 'required',
            "email" => 'required',
            "password" => 'required'
        ], [
            "name" => "The user field is required."
        ]);

        try {
            $user->name = ucfirst($request->name);
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->save();
            // dd($user);
            // die;

            $notification = array(
                'message' => config("messages.user.updated"),
                'type' => 'success'
            );
            return redirect()->route("admin.user")->with($notification);
        } catch (Throwable $e) {
            $notification = array(
                'message' => config("messages.error.wrong"),
                'type' => 'error'
            );
        }
        return redirect()->route("admin.user.edit")->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::where('id', $id)->delete();
            $notification = array(
                'message' => config("messages.user.deleted"),
                'type' => 'success'
            );
        } catch (Throwable $e) {
            $notification = array(
                'message' => config("messages.error.wrong"),
                'type' => 'error'
            );
        }
        return redirect()->route("admin.user")->with($notification);
    }

    public function userFetch(Request $request)
    {
        $data = array();

        $columns = array(
            0 => 'title',
            1 => 'name',
            2 => 'order',
        );
        $dir = $request->input('order');

        $search = $request->input('search');
        $draw = $request->input('draw');
        $pagination = $request->input('pagination');
        $start = $request->input('start');
        $length = $request->input('length');
        $current_page = ($start / $length) + 1;
        $per_page = (isset($length)) ? $length : env('BACKEND_PAGINATION');

        // build Query
        $query = User::query();

        if (!empty($search)) {
            if (isset($search['value'])) {
                $query = $query->where('name', 'like', '%' . $search['value'] . '%');
            }
        }

        $paginated_items = $query->paginate($per_page, ['*'], 'page', $current_page);

        $current_page = $current_page == '' ? $paginated_items->currentPage() : $current_page;
        $total_items = $paginated_items->total();
        $total_pages = $per_page > 0 ? $total_items / $per_page : 0;

        $meta = array(
            'page' => $current_page,
            'perpage' => $per_page,
            'pages' => $total_pages,
            'total' => $total_items,
        );

        //Paginated Items
        $data = $paginated_items->toArray();
        $data['meta'] = $meta;
        $data['draw'] = $draw;
        $data['recordsTotal'] = $total_items;
        $data['recordsFiltered'] = $total_items;

        // dd($data);
        return response()->json($data);
    }
}
