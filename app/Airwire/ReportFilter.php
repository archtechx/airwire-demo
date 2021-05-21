<?php

namespace App\Airwire;

use Airwire\Attributes\Wired;
use Airwire\Component;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class ReportFilter extends Component
{
    public function rules()
    {
        return [
            'search' => ['nullable', 'string', 'max:10'],
            'assignee' => ['required', 'exists:users,id'],
            'category' => ['nullable', Rule::in([1, 2, 3])],
            'status' => ['nullable', Rule::in(['pending', 'resolved', 'invalid'])],
        ];
    }

    #[Wired]
    public string $search = '';

    #[Wired]
    public int $assignee;

    #[Wired]
    public int $category;

    #[Wired]
    public string $status;

    #[Wired(default: [], readonly: true, type: 'Report[]')]
    public Collection $reports;

    public function mount(): array
    {
        return [
            'readonly' => [
                'users' => User::all()->values()->toArray(),
            ],
        ];
    }

    #[Wired]
    public function changeStatus(Report $report): string
    {
        $report->update([
            // We shift the status to the next one
            'status' => [
                'pending' => 'resolved',
                'resolved' => 'invalid',
                'invalid' => 'pending'
            ][$report->status]
        ]);

        $this->meta('notification', __('reports.status_changed', ['status' => $report->status]));

        return $report->status;
    }

    public function dehydrate()
    {
        $this->reports = Report::query()
            ->where('name', 'LIKE', "%{$this->search}%")->with('assignee')
            ->when(isset($this->assignee), fn (Builder $query) => $query->where('assignee_id', $this->assignee))
            ->when(isset($this->category), fn (Builder $query) => $query->where('category', $this->category))
            ->when(isset($this->status), fn (Builder $query) => $query->where('status', $this->status))
            ->get();
    }
}
