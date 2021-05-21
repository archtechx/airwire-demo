<?php

namespace App\Airwire;

use Airwire\Attributes\Wired;
use Airwire\Component;
use App\Models\Report;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;

class CreateReport extends Component
{
    #[Wired]
    public string $name;

    #[Wired]
    public int $assignee;

    #[Wired]
    public int $category;

    public function rules()
    {
        return [
            'name' => ['required', 'min:10', 'max:35'],
            'assignee' => ['required', 'exists:users,id'],
            'category' => ['required', Rule::in([1, 2, 3])],
        ];
    }

    public function mount(): array
    {
        return [
            'readonly' => [
                'users' => User::all()->values()->toArray(),
            ],
        ];
    }

    public function updatedAssignee(int $assignee)
    {
        if (isset($this->changes['name'])) {
            // Don't override user-initiated name changes
            return;
        }

        $this->name = 'Report for ' . User::find($assignee)->name;
    }

    #[Wired]
    public function create(): Report
    {
        if ($found = Report::firstWhere('name', $this->name)) {
            throw new Exception('Report with this name already exists. Please see report ' . $found->id);
        }

        $report = Report::create([
            'name' => $this->name,
            'assignee_id' => $this->assignee,
            'category' => $this->category,
        ]);

        $this->meta('notification', __('reports.created', ['id' => $report->id, 'name' => $report->name]));

        $this->reset();

        return $report;
    }
}
