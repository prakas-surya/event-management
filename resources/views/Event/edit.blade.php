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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="form">
    <form method="POST" data-action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data" id="update-event">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter the Title" minlength="3" required value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" placeholder="Description" value="{{ $event->description }}">
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" required value="{{ $event->date }}">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" placeholder="location" minlength="5" value="{{ $event->location }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="completed" value="completed" {{ $event->status == 'completed'? 'checked' : '' }}>
                <label class="form-check-label" for="completed">
                    Completed
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="pending" value="pending" {{ $event->status == 'pending'? 'checked' : '' }}>
                <label class="form-check-label" for="pending">
                    Pending
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#update-event').on('submit', function (event) {
            event.preventDefault();

            let url = $(this).attr('data-action');

            let title = $('#title').val();
            let description = $('#description').val();
            let date = $('#date').val();
            let location = $('#location').val();
            let status = $('input[name="status"]:checked').val();

            if(title.length < 2) {
                alert('title should have at least 3 characters');
                return;
            }

            if(!date) {
                alert('please select the date');
                return;
            }

            if(location.length < 4) {
                alert('location should have at least 3 characters');
                return;
            }

            if(!status) {
                alert('Please select any one of the statuses');
                return;
            }

            let formData = new FormData(this);

            formData.append('title', title);
            formData.append('description', description);
            formData.append('date', date);
            formData.append('location', location);
            formData.append('status', status);

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    if(response.errors) {
                        alert(response.errors);
                        return;
                    }

                    window.location.href='http://127.0.0.1:8000/events';
                },
                error: function(response) {
                    console.log('error');
                    console.log(response);
                }
            });
        });
    });
</script>

<style>
    #form {
        display: flex;
        justify-content: left;
        margin-left: 20px;
        padding-top: 20px;
        width: 400px;
    }
</style>
