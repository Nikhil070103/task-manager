<x-app-layout>
    <form method="POST" action="{{ route('tasks.update', $task) }}" class="max-w-xl mx-auto p-6">
        @method('PUT')
        @include('tasks._form')
    </form>
</x-app-layout>