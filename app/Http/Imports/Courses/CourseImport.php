<?php
namespace App\Http\Imports\Courses;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CourseImport implements ToModel, WithHeadingRow, WithUpserts {

    public function model(array $row): Course
    {
        return new Course([
            'name' => $row['name'],
            'summary' => $row['summary'],
            'url' => $row['url'],
            'type' => $row['type'],
            'learning_location' => $row['learning_location'],
            'delivery_method' => $row['delivery_method'],
            'lowest_cost' => $row['lowest_cost'],
            'highest_cost' => $row['highest_cost'],
            'currency' => $row['currency'],
            'education_credits' => $row['education_credits'],
            'hours' => $row['hours'],
            'awarded' => $row['awarded'],
            'next_date' => $row['next_date'],
            'next_date_string' => $row['next_date_string'],
            'finish_date' => $row['finish_date'],
            'open_enrollment' => $row['open_enrollment'],
            'length' => $row['length'],
            'self_paced' => $row['self_paced'],
            'image' => $row['image'],
            'featured' => $row['featured'],
        ]);
    }

    public function uniqueBy(): array
    {
        return ['name'];
    }

    public function rules() {
        return [
            'name' => 'string',
            'summary' => 'longText',
            'url' => 'string',
            'type' => 'string',
            'learning_location' => 'string',
            'delivery_method' => 'string',
            'lowest_cost' => 'int',
            'highest_cost' => 'int',
            'currency' => 'string',
            'education_credits' => 'string',
            'hours' => 'string',
            'awarded' => 'string',
            'next_date' => 'date',
            'next_date_string' => 'string',
            'finish_date' => 'date',
            'open_enrollment' => 'bool',
            'length' => 'string',
            'self_paced' => 'bool',
            'image' => 'string',
            'featured' => 'bool',
        ];
    }
}
