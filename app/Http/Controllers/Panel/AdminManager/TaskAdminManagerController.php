<?php
namespace App\Http\Controllers\Panel\AdminManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AdminManager\UpdateTaskPriorityRequest;
use App\Services\AdminManager\TaskAdminManagerService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
class TaskAdminManagerController extends Controller
{
    public function __construct(private TaskAdminManagerService $service) {}

    public function index()
    {
        return $this->service->index();
    }

    public function performance()
    {
        return $this->service->performance();
    }

    public function updatePriority(UpdateTaskPriorityRequest $request, $id)
    {
        return $this->service->updatePriority($request, $id);
    }

    public function weeklyReport()
    {
        return $this->service->weeklyReport();
    }
}
