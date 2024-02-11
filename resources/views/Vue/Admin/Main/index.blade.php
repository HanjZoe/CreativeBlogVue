@extends($layout)
@section('content')
    <router-view></router-view>
    @if($layout == 'Admin.layouts.theme')
    <admin-nav-bar/>
    @endif
@endsection
