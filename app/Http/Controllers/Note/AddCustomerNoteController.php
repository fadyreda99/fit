<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\AddCustomerNoteRequest;
use App\Http\Resources\Note\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class AddCustomerNoteController extends Controller
{
    public function addNote(AddCustomerNoteRequest $request){
        $note = Note::create([
            'user_id'=>$request->user_id,
            'note'=>$request->note
        ]);
        return new NoteResource($note);
    }
}
