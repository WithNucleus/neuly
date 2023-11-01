<?php
namespace App\Imports\Courses;

use App\Models\Company;
use App\Models\Course;
use App\Models\ImportResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyRelationshipImport implements ToCollection, WithHeadingRow {

    public function collection(Collection $collection)
    {
        $importResult = ImportResult::create([
            'type' => ImportResult::TYPE_COURSES_WITH_RELATIONSHIPS,
            'entity' => Course::class,
            'data' => $collection,
            'user_id' => Auth::id(),
            'rows' => count($collection)
        ]);

        $status = null;
        $errors = [];

        $companyMessages = [];

        foreach($collection as $row) {
            $course = Course::where('name', $row['name'])->first();

            if ($course) {
                $company = Company::where('name', $row['company_name'])->first();

                if ($company) {
                    $course->companies()->syncWithoutDetaching([$company->id]);
                } else {
                    $companyMessages[$row['company_name']]['courses'][] = $course->id;

                    if (isset($row['company_url'])) {
                        $companyMessages[$row['company_name']]['url'] = $row['company_url'];
                    } else {
                        $companyMessages[$row['company_name']]['url'] = null;
                    }

                    $status = ImportResult::STATUS_SUCCESS_WITH_ERRORS;
                }

            } else {
                $errors['No course found'][] = $row['name'];
                $status = ImportResult::STATUS_SUCCESS_WITH_ERRORS;
            }
        }

        $importResult->company_messages = $companyMessages;
        $importResult->errors = $errors;
        $importResult->status = $status;
        $importResult->save();
    }

    public function uniqueBy(): array
    {
        return ['name'];
    }
}
