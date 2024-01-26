@extends('layouts.chat')

@section('title', 'Chat')

@section('username')
    @if (Auth::user()->role == 'admin')
        {{$room->user->name}}
    @else
    Admin Ganteng
        
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="bg-image-container">
            <div class="content-container" id="messages-container">
                <!-- Messages will be loaded here -->
            </div>
            <div class="input-container">
                <div class="position-relative">
                    <form id="chat-form" action="{{ route('chat.store', ['id' => $room->id]) }}" method="POST">
                        @csrf
                        @method('post')
                        <input name="message" class="form-control" placeholder="Type a New Message" id="chat-input">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            const messagesContainer = $('#messages-container');
            const chatForm = $('#chat-form');
            const chatInput = $('#chat-input');

            // Load initial messages via AJAX when the page loads
            $.ajax({
                type: 'GET',
                url: '{{ route('chat.chatinroom', ['id' => $room->id]) }}',
                success: function(data) {
                    console.log('Initial messages:', data);
                    renderMessages(data.data.message);
                },
                error: function(error) {
                    console.error('Error fetching initial messages:', error);
                }
            });

            chatForm.submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log('Message sent:', data);
                        if (data.success) {
                            // renderMessages([data.data]); 
                            // Render the new message
                            chatInput.val(''); // Clear the input field
                        } else {
                            console.error('Error:', data.message);
                        }
                    },
                    error: function(error) {
                        console.error('Error sending message:', error);
                    }
                });
            });

            // ... (existing code)

            window.Echo.private('message.{{ $room->id }}').listen('MessageEvent', function(data) {
                console.log('New message from Echo:', data);
                const newMessage = {
                    message: data.message,
                    user_id: data.userId, // Replace with the actual user_id
                    room_id: data.roomId // Replace with the actual user_id
                };

                addMessage(newMessage);

            });

            // ... (existing code)


            function renderMessages(messages) {
                if (!Array.isArray(messages)) {
                    console.error('Invalid messages array:', messages);
                    return;
                }

                const messagesContainer = $('#messages-container');

                messages.forEach(message => {
                    const messageContainer = $('<div class="message"></div>');
                    const cardDiv = $('<div class="d-flex w-lg-40"></div>');
                    const cardBodyDiv = $('<div class="card mt-2"></div>');
                    const cardBody = $('<div class="card-body p-3"></div>');
                    const messageParagraph = $('<p class="mb-0 text-dark"></p>');

                    if (message && message.hasOwnProperty('message')) {
                        messageParagraph.text(message.message);
                    } else {
                        console.error('Invalid message object:', message);
                        return; // Skip rendering invalid message
                    }

                    if (message.user_id !== {{ $userLogedIn->id }}) {
                        cardDiv.addClass('ms-3');
                        cardBodyDiv.addClass('border rounded-top-md-left-0');
                    } else {
                        cardDiv.addClass('me-3 text-end');
                        messageContainer.addClass('d-flex justify-content-end');
                        cardBodyDiv.addClass('bg-primary text-white rounded-top-md-end-0');
                    }

                    cardBody.append(messageParagraph);
                    cardBodyDiv.append(cardBody);
                    cardDiv.append(cardBodyDiv);
                    messageContainer.append(cardDiv);

                    messagesContainer.append(messageContainer);
                messagesContainer.scrollTop(messagesContainer[0].scrollHeight);

                });

                // Using the spread operator to concatenate new messages with existing messages
                // This ensures that the existing messages are preserved while adding new ones
                const allMessages = [...messagesContainer.children(), ...messages];

                // Empty the container and append all messages
                messagesContainer.empty().append(allMessages);
            }

            function addMessage(message) {
                if (!message || !message.hasOwnProperty('message')) {
                    console.error('Invalid message object:', message);
                    return;
                }

                const messagesContainer = $('#messages-container');

                // Check if the message already exists
                const existingMessage = messagesContainer.find('.message:contains("' + message.message + '")');
                if (existingMessage.length > 0) {
                    console.warn('Message already exists:', message);
                    return;
                }

                const messageContainer = $('<div class="message"></div>');
                const cardDiv = $('<div class="d-flex w-lg-40"></div>');
                const cardBodyDiv = $('<div class="card mt-2"></div>');
                const cardBody = $('<div class="card-body p-3"></div>');
                const messageParagraph = $('<p class="mb-0 text-dark"></p>');

                messageParagraph.text(message.message);

                if (message.user_id !== {{ $userLogedIn->id }}) {
                    cardDiv.addClass('ms-3');
                    cardBodyDiv.addClass('border rounded-top-md-left-0');
                } else {
                    cardDiv.addClass('me-3 text-end');
                    messageContainer.addClass('d-flex justify-content-end');
                    cardBodyDiv.addClass('bg-primary text-white rounded-top-md-end-0');
                }

                cardBody.append(messageParagraph);
                cardBodyDiv.append(cardBody);
                cardDiv.append(cardBodyDiv);
                messageContainer.append(cardDiv);

                messagesContainer.append(messageContainer);
                messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
            }





        });
    </script>

    <style>
        .bg-image-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 90px);
            background-image:  url('http://127.0.0.1:8000/assets/background/bg-wa.jpg');
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        .content-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .input-container {
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
@endsection
