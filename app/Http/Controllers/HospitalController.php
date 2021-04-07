<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Http\Requests\CreateHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Repositories\HospitalRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class HospitalController extends Controller
{
    /**
     * @var HospitalRepository
     */
    private $hospitalRepository;

    public function __construct(
        HospitalRepository $hospitalRepository
    )
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function index()
    {
        $hasRecords = count($this->hospitalRepository->all());
        return view('admin.hospitals.index', compact(['hasRecords']));
    }

    /**
     * Hospital Create Form View
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.hospitals.create');
    }

    /**
     * Store Hospital Record
     *
     * @param CreateHospitalRequest $request
     * @return RedirectResponse
     */
    public function store(CreateHospitalRequest $request)
    {
        if ($this->hospitalRepository->getBySerialNum($request->serial_number)) {
            return redirect()->back()->with(['error' => 'Hospital with ' . $request->serial_number . ' already exists.']);
        }

        $postData = $request->toArray();

        return $this->hospitalRepository->store($postData) ? redirect()->back()->with(['success' => Message::DB_RECORD_CREATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Show Hospital record list with Actions links
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function management()
    {
        $hospitals = $this->hospitalRepository->all();
        return count($hospitals) ? view('admin.hospitals.management', compact(['hospitals'])) :
            redirect()->route('hospitals.index')->with(['info' => Message::DB_EMPTY_TABLE]);
    }

    /**
     * View Hospital Profile Details
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function view($id)
    {
        $hospital = $this->hospitalRepository->getById($id);
        return $hospital ? view('admin.hospitals.profile', compact(['hospital'])) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Hospital Edit Form View
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        $hospital = $this->hospitalRepository->getById($id);
        return $hospital ? view('admin.hospitals.edit', compact(['hospital'])) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Update Hospital records
     *
     * @param UpdateHospitalRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateHospitalRequest $request)
    {
        $postData = $request->toArray();
        return $this->hospitalRepository->update($postData) ? redirect()->back()->with(['success' => Message::DB_RECORD_UPDATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Delete Hospital record from database
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        return $this->hospitalRepository->destroy($id) ? redirect()->back()->with(['warning' => Message::DB_RECORD_DELETED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

}
