<?php

namespace App\Exports;

use App\Models\Project;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProjectDocumentationTemplateExport
{
    public function __construct(public Project $project) {}

    public function download(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $spreadsheet = IOFactory::load(storage_path('app/excel-templates/project-plan-template.xlsx'));

        // ✅ Only modify this sheet
        $sheet = $spreadsheet->getSheetByName('Project Details');
        $startRow = 2;

        // 🧼 Optional: clear old data from Project Details (only rows below headers)
        $highestRow = $sheet->getHighestDataRow();
        if ($highestRow > $startRow - 1) {
            $sheet->removeRow($startRow, $highestRow - $startRow + 1);
        }

        // 🔁 Inject updated project documentation rows
        foreach ($this->project->projectDocumentation as $index => $doc) {
            $sheet->fromArray([
                $doc->page,
                $doc->section_number,
                $doc->section_name,
                $doc->section_type,
                $doc->elements,
                $doc->placeholder,
                $doc->functionality,
                $doc->deliverable,
                $doc->video_manual,
            ], null, 'A' . ($startRow + $index));
        }

        // ✅ Save to temp file for download
        $tempFile = tempnam(sys_get_temp_dir(), 'project_export_') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, 'project-plan-export.xlsx')->deleteFileAfterSend(true);
    }
}
