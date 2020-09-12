
    **Hello {{$name}}!**

    Here are this weeks changes:

    @foreach($notifications as $notification)
        {!! $notification->message !!}

    @endforeach

    You will receive your next update next week.

    Have a great week.

    Your Neuly-Team
