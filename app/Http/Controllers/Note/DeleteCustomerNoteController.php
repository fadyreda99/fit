<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\DeleteCustomerNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class DeleteCustomerNoteController extends Controller
{
    public function delete(DeleteCustomerNoteRequest $request){
        $note = Note::whereId($request->id)->delete();
        return true;
    }
}
