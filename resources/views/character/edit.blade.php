@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p>Please complete this form in its entirety if you are interested in participating in New World
                            invasions or wars run by Pandamonium, Pandaloons, or Pandalysium <a
                                href="https://pandaguild.io">(https://pandaguild.io).</a></p>
                        <p class="reqform">* Required</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ action('App\Http\Controllers\CharacterController@update') }}">
                            <div class="form-group">
                                <label for="character_name">What is your character name? <span class="reqform">*</span></label>
                                <input type="text" class="form-control" name="character_name" value="{{ old('character_name', $character->character_name) }}"
                                       aria-describedby="characterNameHelp" placeholder="Character Name">
                            </div>
                            <div class="form-group">
                                <label for="character_company">What is your company name? <span class="reqform">*</span></label>
                                <input type="text" class="form-control" name="character_company" value="{{ old('character_company', $character->character_company) }}"
                                       aria-describedby="characterCompanyHelp" placeholder="Company Name">
                                <small id="characterCompanyHelp" class="form-text text-muted">Put N/A if you are not a
                                    member of a company.</small>
                            </div>
                            <div class="form-group">
                                <label for="guilded_name">What is your Guilded.gg name? <span
                                        class="reqform">*</span></label>
                                <input type="text" class="form-control" name="guilded_name" value="{{ old('guilded_name', $character->guilded_name) }}"
                                       aria-describedby="emailHelp" placeholder="Guilded.gg Name">
                                <small id="guildedHelp" class="form-text text-muted">This is required to participate in
                                    Panda wars. If you do not have a Guilded account, set one up.</small>
                            </div>
                            <div class="form-group">
                                <label for="character_level">What is your current character level? <span
                                        class="reqform">*</span></label>
                                <input type="text" class="form-control" name="character_level" value="{{ old('character_level', $character->character_level) }}"
                                       aria-describedby="characterLevelHelp" placeholder="Character Level">
                                <small id="characterLevelHelp" class="form-text text-muted">This input accepts numeric
                                    values only (ie: 1-60).</small>
                            </div>
                            <div class="form-group">
                                <label for="primary_role">What is your primary role? <span
                                        class="reqform">*</span></label>
                                <select name="primary_role" class="custom-select">
                                    <option value="" {{ old('primary_role', $character->primary_role) === "" ? "selected" : "" }}>Choose</option>
                                    @foreach(config('custom.roles') as $name => $key)
                                        <option value="{{ $key }}" {{ old('primary_role', $character->primary_role) === $key ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primary_weapon">What is your primary weapon? <span class="reqform">*</span></label>
                                <select name="primary_weapon" class="custom-select">
                                    <option value="" {{ old('primary_weapon', $character->primary_weapon) === "" ? "selected" : "" }}>Choose</option>
                                    @foreach(config('custom.weapons') as $name => $key)
                                        <option value="{{ $key }}" {{ old('primary_weapon', $character->primary_weapon) === $key ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primary_weapon_level">What is your primary weapon level? <span
                                        class="reqform">*</span></label>
                                <input type="text" class="form-control" name="primary_weapon_level" value="{{ old('primary_weapon_level', $character->primary_weapon_level) }}"
                                       aria-describedby="primaryWeaponLevelHelp" placeholder="Primary Weapon Level">
                                <small id="primaryWeaponLevelHelp" class="form-text text-muted">This input accepts
                                    numeric values only.</small>
                            </div>
                            <div class="form-group">
                                <label for="second_weapon">What is your secondary weapon? <span
                                        class="reqform">*</span></label>
                                <select name="second_weapon" class="custom-select">
                                    <option value="" {{ old('second_weapon', $character->second_weapon) === "" ? "selected" : "" }} value="">Choose</option>
                                    @foreach(config('custom.weapons') as $name => $key)
                                        <option value="{{ $key }}" {{ old('second_weapon', $character->second_weapon) === $key ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="second_weapon_level">What is your secondary weapon level? <span
                                        class="reqform">*</span></label>
                                <input type="text" class="form-control" name="second_weapon_level" value="{{ old('second_weapon_level', $character->second_weapon_level) }}"
                                       aria-describedby="secondWeaponLevelHelp" placeholder="Secondary Weapon Level">
                                <small id="secondLevelHelp" class="form-text text-muted">This input accepts numeric
                                    values only.</small>
                            </div>
                            <div class="form-group">
                                <label for="character_company">What is your gear score? <span
                                        class="reqform">*</span></label>
                                <input type="text" class="form-control" name="gear_score" value="{{ old('gear_score', $character->gear_score) }}"
                                       aria-describedby="gearScoreHelp" placeholder="Gear Score">
                                <small id="gearScoreHelp" class="form-text text-muted">Hit Tab to access your inventory.
                                    Your Gear Score is in the lower left corner.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="third_weapon">What is your third weapon?</label>
                                <select name="third_weapon" aria-describedby="thirdWeaponHelp"
                                        class="custom-select">
                                    <option value="" {{ old('third_weapon', $character->third_weapon) === "" ? "selected" : "" }} value="">NA</option>
                                    @foreach(config('custom.weapons') as $name => $key)
                                        <option value="{{ $key }}" {{ old('third_weapon', $character->third_weapon) === $key ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <small id="thirdWeaponHelp" class="form-text text-muted">Select N/A if you do not use a
                                    3rd weapon.</small>
                            </div>
                            <div class="form-group">
                                <label for="fourth_weapon">What is your fourth weapon?</label>
                                <select name="fourth_weapon" aria-describedby="fourthWeaponHelp" class="custom-select">
                                    <option value="" {{ old('fourth_weapon', $character->fourth_weapon) === "" ? "selected" : "" }} value="">NA</option>
                                    @foreach(config('custom.weapons') as $name => $key)
                                        <option value="{{ $key }}" {{ old('fourth_weapon', $character->fourth_weapon) === $key ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <small id="fourthWeaponHelp" class="form-text text-muted">Select N/A if you do not use a
                                    4th weapon.</small>
                            </div>
                            <div class="form-group">
                                <label for="fifth_weapon">What is your fifth weapon?</label>
                                <select name="fifth_weapon" aria-describedby="fifthWeaponHelp" class="custom-select">
                                    <option value="" {{ old('fifth_weapon', $character->fifth_weapon) === "" ? "selected" : "" }} value="">NA</option>
                                    @foreach(config('custom.weapons') as $name => $key)
                                        <option value="{{ $key }}" {{ old('fifth_weapon', $character->fifth_weapon) === $key ? "selected" : "" }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <small id="fifthWeaponHelp" class="form-text text-muted">Select N/A if you do not use a
                                    5th weapon.</small>
                            </div>
                            <div class="form-group">
                                <label for="share_information">Can we share your information with Pandamonium allies?
                                    <span class="reqform">*</span></label>
                                <select name="share_information" class="custom-select">
                                    <option {{ old('share_information', $character->share_information) === "" ? "selected" : "" }}>Choose</option>
                                    <option value="1" {{ intval(old('share_information', $character->share_information)) === 1 ? "selected" : "" }}>Yes</option>
                                    <option value="0" {{ intval(old('share_information', $character->share_information)) === 0 ? "selected" : "" }}>No</option>
                                </select>
                            </div>
                            <input type="hidden" name="user_id" value="{{ $character->user->id }}"/>
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary navbar-panda" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
