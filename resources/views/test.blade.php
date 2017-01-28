

{{--@foreach($roles as $role)--}}
    {{--{{ $role->pivot->user_id }}--}}
{{--@endforeach--}}


@foreach($user as $item)
{{ $item->name }}
@endforeach