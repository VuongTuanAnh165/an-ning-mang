{{-- resources/views/scores/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Danh sách điểm sinh viên') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-6 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-800 shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    
                    {{-- Ô tìm kiếm --}}
                    <form method="GET" action="{{ route('scores.index') }}" class="mb-4">
                        <input type="text" name="search"
                               placeholder="Tìm theo tên sinh viên hoặc môn học..."
                               value="{{ request('search') }}"
                               class="w-full px-4 py-2 text-gray-100 bg-gray-900 border border-gray-700 rounded-lg focus:ring focus:ring-indigo-500">
                    </form>

                    {{-- Bảng điểm --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-300">
                            <thead class="text-gray-100 bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Sinh viên</th>
                                    <th class="px-4 py-2">Môn học</th>
                                    <th class="px-4 py-2">Điểm</th>
                                    <th class="px-4 py-2">Ngày cập nhật</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse($scores as $score)
                                    <tr class="hover:bg-gray-700">
                                        <td class="px-4 py-2">{{ $score->id }}</td>
                                        <td class="px-4 py-2">{{ $score->name }}</td>
                                        <td class="px-4 py-2">{{ $score->subject }}</td>
                                        <td class="px-4 py-2">{{ $score->score }}</td>
                                        <td class="px-4 py-2">{{ $score->updated_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-400">
                                            Không có dữ liệu
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $scores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
