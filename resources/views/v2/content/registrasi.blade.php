@extends('v2.layout.page')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse exercitationem repudiandae quisquam, maxime deserunt necessitatibus animi natus ullam at vitae voluptates sequi doloribus consequuntur a tenetur non rerum. Dignissimos, velit.
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        import axios from 'axios';
        document.addEventListener('DOMContentLoaded', () => {
            // axios({
            //     url: 'registrasi/ambil',
            //     method: 'get',
            // }).then((response) => {
            //     console.log('response ===', response);
            // })
            axios.get('registrasi/ambil').then((response) => {
                console.log(response);
            })
        })
    </script>
@endpush
