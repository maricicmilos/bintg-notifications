<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Hospital;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\HospitalRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SpecialtyRepository;
use App\Repositories\UserRepository;
use App\Role;
use App\Specialty;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @var SpecialtyRepository
     */
    private $specialtyRepository;
    /**
     * @var HospitalRepository
     */
    private $hospitalRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(
        SpecialtyRepository $specialtyRepository,
        HospitalRepository $hospitalRepository,
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->specialtyRepository = $specialtyRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * User Create Form View
     *
     * @return Factory|View
     */
    public function create()
    {
        $specialties = $this->specialtyRepository->all()->pluck('name', 'id');
        $hospitals = $this->hospitalRepository->all()->pluck('name', 'id');

        return view('admin.users.create', compact(['specialties', 'hospitals']));
    }

    /**
     * Store User Record
     *
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $postData = $request->post();
        return $this->userRepository->store($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_USER_CREATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Returns Users Management Page
     *
     * @return Factory|View
     */
    public function management()
    {
        $users = $this->userRepository->all();

        return view('admin.users.management', compact(['users']));
    }

    /**
     * Return User Profile Details Page
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function view($id)
    {
        try {
            $user = $this->userRepository->getById($id);
            $hospital = $user->hospitals->first;

            return view('admin.users.profile', compact(['user', 'hospital']));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }

    }

    /**
     * User Edit Form View
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        try {
            $user = $this->userRepository->getById($id);
            $roles = $this->roleRepository->all()->pluck('name', 'id');
            $specialties = $this->specialtyRepository->all()->pluck('name', 'id');
            $hospitals = $this->hospitalRepository->all()->pluck('name', 'id');
            $userHospital = $this->hospitalRepository->getByUserId($user->id);

            return view('admin.users.edit', compact(
                [
                    'user',
                    'roles',
                    'specialties',
                    'userHospital',
                    'hospitals'
                ]
            ));

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }
    }

    /**
     * Update User records
     *
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $postData = $request->post();
        return $this->userRepository->update($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_UPDATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Delete User records
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);

            if (strtolower($user->role->name) === 'doctor') {
                DB::table('hospital_user')
                    ->where('user_id', $id)
                    ->delete();
            }

            $test = DB::table('notification_user')
                ->where('user_id', $id)
                ->delete();

            User::destroy($id);


            return redirect()->back()->with(['success' => Message::DB_RECORD_DELETED]);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::DB_RECORD_NOT_FOUND]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }
    }

    /**
     * Get Hospital By User Id
     *
     * @param $id
     * @return bool
     */
    private function getHospitalByUserId($id)
    {
        $hospital = DB::table('hospital_user')
            ->where('user_id', $id)
            ->first();

        if ($hospital) {
            $hospitalId = $hospital->hospital_id;
            return Hospital::findOrFail($hospitalId);
        }

        return false;
    }


}
