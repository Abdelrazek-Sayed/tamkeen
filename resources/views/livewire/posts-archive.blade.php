<div>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white-800">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="inset-0 bg-gray-900 flex items-center justify-center">
            <div class="w-full max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 overflow-hidden overflow-x-auto bg-white border-b border-gray-200">
                        <div class="w-full align-middle">
                            <table class="w-full border divide-y divide-gray-200 grid-cols-12">
                                <!-- Table Header -->
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                            <span
                                                class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">#</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                            <span
                                                class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Title</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                            <span
                                                class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Body</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                            <span
                                                class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Action</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                                </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                            {{ $post->title }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                            {{ $post->body }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                            <div class="flex justify-start space-x-2">
                                            <x-danger-button class="btn btn-danger"
                                                             wire:click="destroy({{ $post->id }})">
                                                <i class="fa fa-trash"></i>
                                            </x-danger-button>

                                            <x-primary-button class="btn btn-danger"
                                                              wire:click="restorePost({{ $post->id }})">
                                                {{ __('restore') }}
                                            </x-primary-button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                                            No products available.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
