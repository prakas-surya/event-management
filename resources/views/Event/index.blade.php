<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Create Event</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<div id="main">
    <div id="add-event-div">
        <button id="add-event" class="btn btn-primary">
            Add Event
        </button>
    </div>
    <div id="event-div">
        <div>
            @if($events->isEmpty())
                There are no Upcoming Event
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td> {{ $event->title }} </td>
                            <td> {{ $event->description }} </td>
                            <td> {{ $event->date }} </td>
                            <td> {{ $event->location }} </td>
                            <td> {{ $event->status }} </td>
                            <td >
                                <form action="{{ route('events.destroy', $event->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            <td >
                                <form action="{{ route('events.edit', $event->id)}}" method="GET">
                                    @csrf

                                    <button class="btn btn-info" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
</body>
</html>

<script>
    let addEvent = document.getElementById('add-event');
    addEvent.addEventListener('click', function() {
        window.location.href = "{{ route('events.create') }}";
    });
</script>

<style>
    #event-div {
        display: flex;
        justify-content: center;
        padding-top: 20px;
    }

    #add-event-div {
        display: flex;
        justify-content: center;
    }

    #main {
        padding-top: 20px;
    }
</style>
