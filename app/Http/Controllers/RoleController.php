<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(
        RoleRepository $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function index()
    {
        $hasRecords = count($this->roleRepository->all()) ? true : false;

        return view('admin.roles.index', compact(['hasRecords']));
    }

    /**
     * Role Create Form View
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store Role Record
     *
     * @param CreateRoleRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRoleRequest $request)
    {
        if ($this->roleRepository->getByName($request->name)) {
            return redirect()->back()->with(['error' => 'Role with name: ' . $request['name'] . ' already exists.']);
        }
        $postData = $request->post();
        return $this->roleRepository->store($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_CREATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Show Roles record list with Actions links
     *
     * @return Factory|View
     */
    public function management()
    {
        $roles = $this->roleRepository->all();

        return view('admin.roles.management', compact(['roles']));
    }

    /**
     * Role Edit Form View
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);
        return  $role ? view('admin.roles.edit', compact(['role'])) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Role Hospital records
     *
     * @param UpdateRoleRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request)
    {
        $postData = $request->post();
        return $this->roleRepository->update($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_UPDATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Delete Role record from database
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        return $this->roleRepository->destroy($id) ?
            redirect()->back()->with(['warning' => Message::DB_RECORD_DELETED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }
}
