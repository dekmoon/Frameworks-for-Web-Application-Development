@props(['task'])

<div>
    <h3>{{ $task['title'] }}</h3>
    <p>{{ $task['description'] ?? 'No description available' }}</p>
    <small>Created at: {{ $task['created_at'] ?? 'N/A' }}</small>
    <small>Updated at: {{ $task['updated_at'] ?? 'N/A' }}</small>
    <!-- Add more task details here -->
</div>
