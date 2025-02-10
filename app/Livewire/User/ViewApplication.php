<?php

namespace App\Livewire\User;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ViewApplication extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = Application::find($record);
    }


    public function downloadORCR(Request $request)
    {
        $zip = new \ZipArchive;
        $zipFileName = 'attachments.zip';
        $zipFilePath = storage_path($zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
            foreach ($this->record->getMedia() as $attachment) {
            $zip->addFile($attachment->getPath(), $attachment->file_name);
            }
            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.user.view-application');
    }
}
