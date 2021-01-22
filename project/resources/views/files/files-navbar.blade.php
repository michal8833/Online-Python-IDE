@section('filesNav')
    @if(!empty($project))
        <!-- Divider -->
        <hr class="my-3">
        <!-- title -->
        <h6 class="navbar-heading text-muted">{{$project->name.' files'}}</h6>
        <!-- file list -->
        <ul class="navbar-nav mb-md-3">
            @foreach($project->files as $f)

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('projects.files.edit', [$project, $f]) }}">

                        @if(!empty($file) && ($file->id === $f->id))
                            <i class="fas fa-file"></i>
                        @else
                            <i class="far fa-file"></i>
                        @endif
                        {{ $f->name }}
                    </a>
                </li>

            @endforeach
        </ul>
    @endif
@endsection
