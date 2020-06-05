@if ($errors->any())
<ul>
    @foreach ($errors->all() as $item)
    <li>
<strong class="text-danger">{{$item}}</strong>
        </li>
        
    @endforeach
    
</ul>
    
@endif