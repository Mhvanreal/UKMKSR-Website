

    @extends('admin.layout.navbar')
    @section('content')
    <div class="py-12 bg-gray-200">
        <div class="mx-auto space-y-6 bg-white shadow-xl max-w-7xl sm:px-6 lg:px-8 rounded-3xl">
            <div class="p-4 text-black bg-white sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    @endsection
