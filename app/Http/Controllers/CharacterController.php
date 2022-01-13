<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CharacterController extends Controller
{

    /**
     * CharacterController constructor.
     */
    public function __construct(User $user, Character $character)
    {
        $this->user = $user;
        $this->character = $character;
    }

    public function create() {
        $character = Character::where('user_id',Auth::user()->id)->first();

        if($character) {
            return \redirect()->action('App\Http\Controllers\CharacterController@edit', $character->user_id);
        }

        return view('character.create');
    }

    public function save(StoreCharacterRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = $request->input('user_id');

        $character = Character::create($validated);

        return \redirect('/');

    }

    public function edit($user_id) {
        $user = Auth::user();
        if( ($user_id != $user->id AND !$user->hasRole('administrator') ) ) {
            \abort('404');
        }

        $character = Character::where('user_id',$user_id)->first();

        return view('character.edit')->with(\compact('character'));
    }

    public function update(UpdateCharacterRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = $request->input('user_id');

        $character = Character::where('user_id',$validated['user_id'])->first();
        $character->update([$validated]);

        return \redirect('/');
    }

    public function getdata() {
        $user = Auth::user();
        if(!$user) {
            abort('404');
        }
        $characters = Character::select(
            'character_name',
            'character_company',
            'character_level',
            'primary_role',
            'primary_weapon',
            'second_weapon',
            'user_id',
        );

        if( ! $user->hasRole(['organizer','administrator'] ) ) {
            $characters->where('user_id',$user->id);
        }

        return DataTables::eloquent($characters)
            ->addColumn(
                'action',
                function($character) use ($user) {
                    $actions = '<a href="' . action('App\Http\Controllers\CharacterController@edit', $character->user_id) . '" title="Edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                    if($user->hasRole(['administrator'])) {
                        $actions .= '<a href="' . action('App\Http\Controllers\RoleController@edit', $character->user_id) . '" title="Permissions"><i class="fas fa-dungeon"></i></a>';
                    }
                    return $actions;
                }
            )
            ->make(true);
    }

    public function getplayer($id) {
        $user = User::where('id',$id)->first();
        $character = $user->character()->get()->toArray();
        $character[0]['share_information'] = ($character[0]['share_information'] === 1) ? 'Yes' : 'No';
        $character[0]['third_weapon'] = ($character[0]['third_weapon'] === null) ? 'N/A' : $character[0]['third_weapon'];
        $character[0]['fourth_weapon'] = ($character[0]['fourth_weapon'] === null) ? 'N/A' : $character[0]['fourth_weapon'];
        $character[0]['fifth_weapon'] = ($character[0]['fifth_weapon'] === null) ? 'N/A' : $character[0]['fifth_weapon'];
        $character[0]['discord'] = $user->discord;
        return json_encode($character[0]);


    }
}
