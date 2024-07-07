<!DOCTYPE html>
<html>
<head>
    <title>Laravel Pusher</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body>
    <h1>Laravel Pusher</h1>
    <div id="messages"></div>
    <form id="message-form">
        <input type="text" id="message" placeholder="Enter message">
        <button type="submit">Send</button>
    </form>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('messages');
        channel.bind('message.sent', function(data) {
            var messagesDiv = document.getElementById('messages');
            var messageParagraph = document.createElement('p');
            messageParagraph.textContent = data.message;
            messagesDiv.appendChild(messageParagraph);
        });

        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var message = document.getElementById('message').value;

            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: message })
            }).then(response => response.json()).then(data => {
                console.log(data);
            });
        });
    </script>
</body>
</html>
