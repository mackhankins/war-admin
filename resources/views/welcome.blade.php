@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            @if(!Auth::user())
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body justify-content-center text-center">
                            <p>Please complete this form in its entirety if you are interested in participating in New
                                World invasions or wars run by Pandamonium, Pandaloons, or Pandalysium <a
                                    href="https://pandaguild.io">(https://pandaguild.io).</a></p>
                            <p>This app requires that you login to create or update your New World character.</p>
                            <p><a href="{{ route('discord-login') }}"><i class="fab fa-discord"></i> Login with Discord</a>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                @if(!auth::user()->character)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body justify-content-center text-center">
                                <p>You need to create a character first.</p>
                                <a href="{{ action('App\Http\Controllers\CharacterController@create') }}"
                                   class="btn btn-panda btn-lg">Create Character</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col">
                        <table id="character-table" class="table table-sm table-bordered">
                            <thead>
                            <th></th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Level</th>
                            <th>Role</th>
                            <th>Primary</th>
                            <th>Secondary</th>
                            <th>Actions</th>
                            </thead>
                        </table>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

        /* Formatting function for row details - modify as you need */
        function format ( d ) {

            // `d` is the original data object for the row
            return '<ul class="details">'+
                '<li>Discord: '+d.discord+'</li>'+
                '<li>Guilded: '+d.guilded_name+'</li>'+
                '<li>Gear Score: '+d.gear_score+'</li>'+
                '<li>Primary Weapon Level: '+d.primary_weapon_level+'</li>'+
                '<li>Secondary Weapon Level: '+d.second_weapon_level+'</li>'+
                '<li>Third Weapon: '+d.third_weapon+'</li>'+
                '<li>Fourth Weapon: '+d.fourth_weapon+'</li>'+
                '<li>Fifth Weapon: '+d.fifth_weapon+'</li>'+
                '<li>Share Information: '+d.share_information+'</li>'+
                '<li>Created: '+d.created_at+'</li>'+
                '<li>Updated: '+d.updated_at+'</li>'+
                '</ul>';
        }

        $(function () {
            var table = $('#character-table').DataTable( {
                processing: true,
                serverSide: true,
                ajax: "{{ action('App\Http\Controllers\CharacterController@getdata') }}",
                rowId: 'user_id',
                "columns": [
                    {
                        className:      'dt-control',
                        orderable:      false,
                        data:           null,
                        searchable: false,
                        defaultContent: ''
                    },
                    { "data": "character_name" },
                    { "data": "character_company" },
                    { "data": "character_level" },
                    { 'data': "primary_role" },
                    { 'data': "primary_weapon" },
                    { 'data': "second_weapon" },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },

                ],
                "order": [[1, 'asc']]
            } );

            // Add event listener for opening and closing details
            $('#character-table tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var rowid = tr.attr('id');
                var playerurl = "{{ action('App\Http\Controllers\CharacterController@getplayer' ) }}"+ '/' + rowid;

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    $.ajax({
                        type: "GET",
                        url: playerurl,
                        async: true,
                        success : function(data) {
                            var player = JSON.parse(data);
                            // Open this row
                            row.child( format(player) ).show();
                            tr.addClass('shown');
                        }
                    });
                }
            } );
        });



    </script>
@endpush


