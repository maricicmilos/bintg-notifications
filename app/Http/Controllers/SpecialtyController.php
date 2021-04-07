<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Http\Requests\CreateSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Repositories\SpecialtyRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SpecialtyController extends Controller
{

    /**
     * @var SpecialtyRepository
     */
    private $specialtyRepository;

    /**
     * @param SpecialtyRepository $specialtyRepository
     */
    public function __construct(
        SpecialtyRepository $specialtyRepository
    )
    {
        $this->specialtyRepository = $specialtyRepository;
    }

    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function index()
    {
        $hasRecords = count($this->specialtyRepository->all()) ? true : false;

        return view('admin.specialties.index', compact(['hasRecords']));
    }

    /**
     * Specialty Create Form View
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.specialties.create');
    }

    /**
     * Store Specialty Record
     *
     * @param CreateSpecialtyRequest $request
     * @return RedirectResponse
     */
    public function store(CreateSpecialtyRequest $request)
    {
        if ($this->specialtyRepository->getByName($request->name)) {
            return redirect()->back()->with(['error' => 'Specialty with name: ' . $request->name . ' already exists.']);
        }

        return $this->specialtyRepository->store($request->post()) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_CREATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Show Specialties record list with Actions links
     *
     * @return Factory|View
     */
    public function management()
    {
        $specialties = $this->specialtyRepository->all();

        return view('admin.specialties.management', compact(['specialties']));
    }

    /**
     * Specialty Edit Form View
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        $specialty = $this->specialtyRepository->getById($id);
        return $specialty ? view('admin.specialties.edit', compact(['specialty'])) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Update Specialty records
     *
     * @param UpdateSpecialtyRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateSpecialtyRequest $request)
    {
        $postData = $request->post();

        return $this->specialtyRepository->update($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_UPDATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Delete Specialty record from database
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        return $this->specialtyRepository->destroy($id) ?
            redirect()->back()->with(['warning' => Message::DB_RECORD_DELETED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }
}
