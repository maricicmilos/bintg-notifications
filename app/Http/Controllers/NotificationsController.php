<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Repositories\NotificationRepository;
use App\Repositories\SpecialtyRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationsController extends Controller
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;
    /**
     * @var SpecialtyRepository
     */
    private $specialtyRepository;

    public function __construct(
        NotificationRepository $notificationRepository,
        SpecialtyRepository $specialtyRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->specialtyRepository = $specialtyRepository;
    }

    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function index()
    {
        $hasRecords = count($this->notificationRepository->all()) ? true : false;

        return view('admin.notifications.index', compact(['hasRecords']));
    }

    /**
     * Notification Create Form View
     *
     * @return Factory|View
     */
    public function create()
    {
        $specialties = $this->specialtyRepository->all()->pluck('name', 'id');

        return view('admin.notifications.create', compact(['specialties']));
    }

    /**
     * Store Notification Record
     *
     * @param CreateNotificationRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNotificationRequest $request)
    {
        $postData = $request->post();
        return $this->notificationRepository->store($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_CREATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Show Notifications record list with Actions links
     *
     * @return Factory|View
     */
    public function management()
    {
        $notifications = $this->notificationRepository->all();
        return view('admin.notifications.management', compact(['notifications']));
    }

    /**
     * View Notification Details
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function view($id)
    {
        $notification = $this->notificationRepository->getById($id);
        return $notification ? view('admin.notifications.details', compact(['notification'])) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Notification Edit Form View
     *
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        try {
            $notification = $this->notificationRepository->getById($id);
            $notificationsRecipientGroups = $notification->specialties;
            $specialtiesFounded = [];

            foreach ($notificationsRecipientGroups as $notificationsRecipientGroup) {
                $specialtiesFounded[] = $notificationsRecipientGroup->name;
            }

            $specialities = $this->specialtyRepository->all()->pluck('name', 'id');

            return view('admin.notifications.edit', compact(['notification', 'specialtiesFounded', 'specialities']));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }

    }

    /**
     * Update Notification records
     *
     * @param UpdateNotificationRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateNotificationRequest $request)
    {
        $postData = $request->post();
        return $this->notificationRepository->update($postData) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_UPDATED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }

    /**
     * Delete Notification record from database
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        return $this->notificationRepository->destroy($id) ?
            redirect()->back()->with(['success' => Message::DB_RECORD_DELETED]) :
            redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
    }
}
