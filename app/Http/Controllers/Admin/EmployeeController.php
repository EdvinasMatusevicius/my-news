<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeStoreRequest;
use App\Http\Requests\Admin\EmployeeUpdateRequest;
use App\Repositories\AdminRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    private $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $admins = $this->adminRepository->getPaginatedList(null,['id','first_name','last_name','email']);
        return view('admin.list',['items'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        try {
            $this->adminRepository->createNew($request->getData());
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.employee.index')
            ->with('success', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\employee  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $employee): View
    {
        return view('admin.show',['item'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $employee): View
    {
        return view('admin.form',['item'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, Admin $employee): RedirectResponse
    {
        try {
            $employee->update($request->getData());
        } catch (Exception $exception) {
            return back()->with('danger',$exception->getMessage())->withInput();
        }
        return redirect()->route('admin.employee.index')
        ->with('success', __('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $employee)
    {
        try {
            $employee->delete();
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

        return redirect()->route('admin.employee.index')
            ->with('success', __('Deleted'));
    }
}
