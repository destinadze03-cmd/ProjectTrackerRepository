<?php

namespace App\Imports;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class TasksImport implements ToModel, WithHeadingRow
{
    
public function model(array $row)
{
    // Convert Excel serial dates to Y-m-d
    $start_date = isset($row['start_date']) ? Date::excelToDateTimeObject($row['start_date'])->format('Y-m-d') : now()->format('Y-m-d');
    $end_date   = isset($row['end_date'])   ? Date::excelToDateTimeObject($row['end_date'])->format('Y-m-d') : now()->format('Y-m-d');

    return new Task([
        'title'         => $row['title'],
        'description'   => $row['description'] ?? 'No description',
        'status'        => $row['status'] ?? 'pending',
        'project_id'    => (int) $row['project_id'],
        'assigned_to'   => 5, // or Auth::id() for logged-in staff
        'start_date'    => $start_date,
        'end_date'      => $end_date,
        'duration'      => $row['duration'] ?? 1,
        'review_status' => $row['review_status'] ?? 'pending',
        'review_note'   => $row['review_note'] ?? '',
        'supervised_by' => $row['supervised_by'] ?? null,
    ]);
}

}


