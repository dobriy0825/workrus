{{ $job->title }}
@foreach($job->workers as $worker)
    {{ $worker->name }}
    @endforeach
{{ $job->user->surname }}
