@extends($layout)
@section('content')
    <router-view></router-view>
    @if($layout == 'Admin.layouts.theme')
        @if($personal)
  <my-nav-bar/>
        @else
            <admin-nav-bar/>
        @endif
    @endif
@endsection
<script>
</script>
