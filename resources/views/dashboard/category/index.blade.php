index da category

@foreach($categories as $category)
    <br>
    {{$category->name}}
    <br>
    {{$category->description}}
@endforeach