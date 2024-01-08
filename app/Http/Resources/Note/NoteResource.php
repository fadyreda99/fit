<?php

namespace App\Http\Resources\Note;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'note' => $this->note,
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
