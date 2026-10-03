<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        @if (session('success'))
            <p class="text-green-600 mb-3">{{ session('success') }}</p>
        @endif

        <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ New Task</a>

        @forelse ($tasks as $task)
            <div class="border rounded p-3 mt-4 flex justify-between bg-white">
                <div>
                    <b class="{{ $task->is_done ? 'line-through' : '' }}">{{ $task->title }}</b>
                    <p class="text-sm text-gray-600">{{ $task->description }}</p>
                </div>
                <div class="flex gap-3 items-center">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600">Edit</a>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="mt-4">Koi task nahi hai.</p>
        @endforelse
    </div>
</x-app-layout>