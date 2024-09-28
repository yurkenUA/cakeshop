<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('status'))
                    <article id="notification" class="message is-success">
                        <div class="message-header">
                        <p>Success</p>
                        <button class="delete" aria-label="delete"></button>
                        </div>
                        <div class="message-body">
                            {{ session('status') }}
                        </div>
                    </article>

                    <script>
                        const notification = document.getElementById('notification');
                        const closeButton = notification.querySelector('.delete');
                        closeButton.addEventListener('click', () => {
                            notification.style.display = 'none';
                        });
                        setTimeout(function() {
                            if (notification) {
                                notification.style.display = 'none';
                            }
                        }, 7000);
                    </script>
                @endif
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
