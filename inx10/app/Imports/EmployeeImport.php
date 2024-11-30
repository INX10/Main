<?php

namespace App\Imports;

use App\Models\EmployeeAttendance; // Model for the employee attendance table
use Maatwebsite\Excel\Concerns\ToModel; // Interface for creating model instances
use Maatwebsite\Excel\Concerns\WithHeadingRow; // For working with headings in CSV files
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings; // For custom CSV settings (if required)
use Carbon\Carbon; // For working with date/time formats
use Illuminate\Support\Facades\Log; // For logging information and debugging

class EmployeeImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
     * Custom CSV settings for encoding, delimiter, etc.
     */
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
            'delimiter' => ',',
            'enclosure' => '"',
            'escape_char' => '\\',
        ];
    }

    /**
     * Convert each row from the CSV into a model instance.
     */
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
    public function model(array $row)
    {
        try {
            // Ensure row has the expected number of columns
            if (count($row) < 8){ // Adjusted to require a minimum of 8 columns
                Log::error('Skipping row due to insufficient columns', ['row' => $row]);
                return null; // Skip this row if it doesn't have enough columns
            }

            Log::info('Processing row', ['row' => $row]);

            // Ensure that all required fields are properly set and not null
            $attendance = new EmployeeAttendance([
                'employee_name' => trim($row['name'] ?? ''), // Trim any extra spaces
                'date' => !empty($row['date']) && $row['date'] !== 'NULL' ? Carbon::createFromFormat('Y-m-d', $row['date']) : null,
                'time_in' => isset($row['time_in']) && $row['time_in'] !== 'NULL' ? $row['time_in'] : '00:00:00',
                'time_out' => isset($row['time_out']) && $row['time_out'] !== 'NULL' ? $row['time_out'] : '00:00:00',
                'hours_required' => isset($row['hrs_req']) ? (float)$row['hrs_req'] : 0.0,
                'hours_worked' => isset($row['hrs_wor']) ? (float)$row['hrs_wor'] : 0.0,
                'hours_overtime' => isset($row['ot']) ? (float)$row['ot'] : 0.0,
                'hours_undertime' => isset($row['ut']) ? (float)$row['ut'] : 0.0,
                'if_resign' => isset($row[10]) && !empty($row[10]) ? $row[10] : null
            ]);

            // Save the record to the database
            $attendance->save();
        } catch (\Exception $e) {
            Log::error('Error processing row', ['row' => $row, 'error' => $e->getMessage()]);
            return null; // Skip this row if an error occurs
        }
    }
}