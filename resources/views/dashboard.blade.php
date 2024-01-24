<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto mt-8">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 rounded shadow">
                            <h2 class="text-2xl font-semibold mb-4">Book Appointment</h2>
                            
                            {!! Form::open(['route' => 'appointments.store']) !!}
                                @csrf

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Choose Tutor</label>
                                    {!! Form::select('tutor_id', $tutors, null, ['class' => 'tutor w-full border border-gray-300 p-2 rounded']) !!}
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Choose Date</label>
                                    {!! Form::text('date', null, ['class' => 'date w-full border border-gray-300 p-2 rounded']) !!}
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Choose Slot</label>
                                    {!! Form::select('slot_id', [], null, ['class' => 'slot w-full border border-gray-300 p-2 rounded']) !!}
                                </div>

                                <div class="mb-6">
                                    {!! Form::submit('Book Now', ['class' => 'bg-blue-500 text-white p-2 rounded hover:bg-blue-600']) !!}
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.date').datepicker({  
           format: 'yyyy-mm-dd',
        });

        $('.date').on('change', function(event) {
            var date = $(this).val();
            var tutor_id = $('.tutor').val();
            $('.slot').children().remove();

            $.ajax({
                url: '/get-appointment-slots',
                type: 'GET',
                data: {date: date, tutor_id :tutor_id},
                success: function(res){
                    if(res.type == 'success'){
                        $.each(res.data, function (i, item) {
                            $('.slot').append($('<option>', { 
                                value: item.id,
                                text : item.name
                            }));
                        });
                    }
                }
            });
            
            
        });
    </script> 
</x-app-layout>
