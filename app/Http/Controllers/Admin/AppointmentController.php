<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Appointment";
        $page_breadcrumbs = array(
            array('title' => $page_title, 'url' => 'javascript:void(0)', 'active' => false),
            array('title' => 'Manage', 'url' => '', 'active' => true),
        );
        return view('admin.appointment.list', compact('page_title', 'page_breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Appointment";
        $page_breadcrumbs = array(
            array('title' => $page_title, 'url' => route('admin.appointment'), 'active' => false),
            array('title' => 'Create', 'url' => '', 'active' => true),
        );
        $user = User::all();
        return view('admin.appointment.form', compact('page_title', 'page_breadcrumbs', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "user_id" => 'required',
            "appointment_date" => 'required'
        ], [
            "user_id" => "The User field is required.",
            "appointment_date" => "The Appointment Date field is required.",
        ]);

        try {
            $appointment = new Appointments();
            $appointment->user_id = $request->user_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->status = $request->status;
            $appointment->save();
            $notification = array(
                'message' => config("messages.appointment.create"),
                'type' => 'success'
            );
        } catch (Throwable $e) {
            $notification = array(
                'message' => config("messages.error.wrong"),
                'type' => 'error'
            );
        }
        return redirect()->route("admin.appointment")->with($notification);
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

        $page_title = "Appointment";
        $page_breadcrumbs = array(
            array('title' => $page_title, 'url' => route('admin.appointment'), 'active' => false),
            array('title' => 'Update', 'url' => '', 'active' => true),
        );
        $user = User::all();
        $appointment = Appointments::where('id', $id)->first();


        return view('admin.appointment.edit', compact('page_title', 'page_breadcrumbs', 'user', 'appointment', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            "user_id" => 'required',
            "appointment_date" => 'required'
        ], [
            "user_id" => "The User field is required.",
            "appointment_date" => "The Appointment Date field is required.",
        ]);

        try {
            $appointment = Appointments::where('id', $id)->first();
            $appointment->user_id = $request->user_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->status = $request->status;
            $appointment->save();
            $notification = array(
                'message' => config("messages.appointment.updated"),
                'type' => 'success'
            );
        } catch (Throwable $e) {
            $notification = array(
                'message' => config("messages.error.wrong"),
                'type' => 'error'
            );
        }
        return redirect()->route("admin.appointment")->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Appointments::where('id', $id)->delete();
            $notification = array(
                'message' => config("messages.appointment.deleted"),
                'type' => 'success'
            );
        } catch (Throwable $e) {
            $notification = array(
                'message' => config("messages.error.wrong"),
                'type' => 'error'
            );
        }
        return redirect()->route("admin.appointment")->with($notification);
    }

    public function appointmentFetch(Request $request)
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

        // Build query
        $query = Appointments::query();
        // $query = DB::table('appointments')
        //     ->leftJoin('users', 'appointment.user_id', 'users.id')
        //     ->select('appointments.*', 'users.name as user_id')
        //     ->get();
        // ->orderBy($columns[$dir[0]['column'])], $request->input(['order'][0]['dir']));


        if (!empty($search)) {
            if (isset($search['value'])) {
                $query = $query->where('name', 'like', '%' . $search['value'] . '%');
            }
        }

        $paginated_items = $query->paginate($per_page, ['*'], 'page', $current_page);

        $current_page = $current_page == '' ? $paginated_items->currentPage() : $current_page;
        $total_items = $paginated_items->total();
        $total_pages = $per_page > 0 ? $total_items / $per_page : 0;

        //Meta Data For Items
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

        return response()->json($data);

        // $query = DB::table('appointments')
        //     ->leftJoin('users', 'appointment.user_id', 'users.id')
        //     ->select('appointment.*', 'users.name as user_id')
        //     ->get();
    }
}
