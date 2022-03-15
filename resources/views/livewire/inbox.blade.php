<div 
    x-data="{ threadSelected: true }"
    class="max-w-7xl mx-auto flex space-x-4 h-[720px]"
>
    <div class="w-1/4 h-full border border-gray-300 bg-white rounded-lg">
        <div class="h-[60px] flex items-center p-4 space-x-2 border-b-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            <button 
                @click="threadSelected = false" 
                class="font-semibold"
            >
                {{ __('Threads') }}
            </button>
        </div>
        <div class="h-[650px] overflow-y-auto">
            @forelse ($threads as $thread)
                <button
                    wire:click="selectThread({{ $thread }})"
                    @click="threadSelected = true" 
                    class="w-full py-3 flex items-center justify-between px-2 my-2 hover:bg-blue-500 hover:bg-opacity-20 cursor-pointer"
                >
                    <div class="flex items-center">
                        <img 
                            src="{{ $thread->otherParticipantProfileImage }}" 
                            class="rounded-full w-10"
                        >
                        <span class="ml-3">
                            {{ $thread->otherParticipantName }}
                        </span>
                    </div>
                    <div class="flex flex-col items-end justify-start">
                        <span class="text-xs text-gray-500">
                            {{ $thread->updated_at->toFormattedDateString() }}
                        </span>
                        @if ($thread->unreadMessagesCount())
                            <span class="bg-blue-600 text-gray-100 text-sm px-2 py-0.5 mt-0.5 rounded-full font-semibold">
                                {{ $thread->unreadMessagesCount() }}
                            </span>
                        @endif
                    </div>
                </button>
            @empty
                <p class="text-gray-600 p-4 text-center">
                    {{ __('There are no any threads yet.') }}
                </p>
            @endforelse
        </div>
    </div>
    <div class="w-3/4 border border-gray-300 bg-white rounded-xl">
        <div 
            class="w-full h-full flex items-center justify-center block" 
            :class="! threadSelected ? 'block' : 'hidden'"
        >
            <h5 class="text-2xl text-gray-400">
                {{ __('Select Thread') }}
            </h5>
        </div>
        <div 
            class="w-full h-full flex flex-col justify-between block"
            :class="threadSelected ? 'block' : 'hidden'"
        >
            @if($messages)
                <h5 class="h-[60px] text-lg p-3.5 border-b-2 font-semibold">
                    {{ __('To') }}: {{ $thread->otherParticipantName }}
                </h5>
                <div 
                    id="messages"
                    x-init="document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight"
                    class="h-[650] flex-1 p-4 border-b-2 space-y-8 overflow-y-auto custom-scrollbar" 
                >
                    @foreach ($messages as $messagesByDay)
                        <p class="text-center text-xs text-gray-500">
                            {{ $messagesByDay->first()->created_at->toFormattedDateString() }}
                        </p>
                        @foreach($messagesByDay as $message)
                            @if($message->user->id === auth()->id())
                                <div class="flex flex-col items-end">
                                    <div class="w-3/4 2xl:w-1/2 flex justify-end  space-x-1">
                                        <div>
                                            <div class="bg-blue-200 p-4 rounded-lg">
                                                {{ $message->body }}
                                            </div>
                                            <div class="flex mt-0.5">
                                                <span class="text-gray-400 text-sm">
                                                    {{ $message->created_at->format('H:i a') }}
                                                </span>
                                                <div 
                                                    class="flex items-center justify-center ml-1 @if($message->seen_at) text-green-600 @else text-gray-400 @endif" 
                                                    title="@if($message->seen_at) Seen @else Not Seen @endif"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <img 
                                            src="{{ $message->user->profile_photo_url }}" 
                                            class="w-10 h-10 rounded-full"
                                        >
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col">
                                    <div class="w-3/4 2xl:w-1/2 flex space-x-1">
                                        <img 
                                            src="{{ $message->user->profile_photo_url }}" 
                                            class="w-10 h-10 rounded-full"
                                        >
                                        <div>
                                            <div class="bg-gray-200 p-4 rounded-lg">
                                                {{ $message->body }}
                                            </div>
                                            <div class="flex justify-end mt-0.5">
                                                <span class="text-gray-400 text-sm">
                                                    {{ $message->created_at->format('H:i a') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <form class="p-4" wire:submit.prevent="submit">
                    <textarea 
                        wire:model.defer="state.body"
                        class="w-full h-24 mt-2 border p-2 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 rounded-lg resize-none" 
                        placeholder="Write your message here..."
                    ></textarea>
                    <div class="flex items-center justify-between">
                        <div class="flex-1 text-sm text-red-600">
                            @error('state.body')
                                {{ $message }}
                            @enderror
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-800 rounded-lg mt-4 px-10 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>