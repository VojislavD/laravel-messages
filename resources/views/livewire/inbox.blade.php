<div class="max-w-7xl mx-auto flex space-x-4 h-[720px]">
    <div class="w-1/4 h-full border border-gray-300 rounded-lg shadow-2xl">
        <div class="h-[60px] flex items-center p-4 space-x-2 border-b-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            <span class="font-semibold">Conversations</span>
        </div>
        <div class="h-[650px] overflow-y-auto">
            <button class="w-full py-3 flex items-center justify-between px-2 my-2 hover:bg-blue-500 hover:bg-opacity-20 cursor-pointer">
                <div class="flex items-center">
                    <img src="https://images.unsplash.com/photo-1552162864-987ac51d1177?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="rounded-full w-10">
                    <span class="ml-3">Annie Baker</span>
                    <span class="w-3 h-3 bg-green-600 ml-2 rounded-full" title="Online"></span>
                </div>
                <div class="flex flex-col items-end justify-start">
                    <span class="text-sm text-gray-500">10:54PM</span>
                    <span class="bg-blue-600 text-gray-100 text-sm px-2 py-0.5 mt-0.5 rounded-full font-semibold">1</span>
                </div>
            </button>
            <button class="w-full py-3 flex items-center justify-between px-2 my-2 hover:bg-blue-500 hover:bg-opacity-20 cursor-pointer">
                <div class="flex items-center">
                    <img src="https://images.unsplash.com/photo-1552162864-987ac51d1177?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="rounded-full w-10">
                    <span class="ml-3">Annie Baker</span>
                    <span class="w-3 h-3 bg-green-600 ml-2 rounded-full" title="Online"></span>
                </div>
                <div class="flex flex-col items-end justify-start">
                    <span class="text-sm text-gray-500">10:54PM</span>
                    <span class="bg-blue-600 text-gray-100 text-sm px-2 py-0.5 mt-0.5 rounded-full font-semibold">1</span>
                </div>
            </button>
            <button class="w-full py-3 flex items-center justify-between px-2 my-2 hover:bg-blue-500 hover:bg-opacity-20 cursor-pointer">
                <div class="flex items-center">
                    <img src="https://images.unsplash.com/photo-1552162864-987ac51d1177?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="rounded-full w-10">
                    <span class="ml-3">Annie Baker</span>
                    <span class="w-3 h-3 bg-green-600 ml-2 rounded-full" title="Online"></span>
                </div>
                <div class="flex flex-col items-end justify-start">
                    <span class="text-sm text-gray-500">10:54PM</span>
                    <span class="bg-blue-600 text-gray-100 text-sm px-2 py-0.5 mt-0.5 rounded-full font-semibold">1</span>
                </div>
            </button>
        </div>
    </div>
    <div class="w-3/4 h-full border border-gray-300 rounded-xl flex flex-col justify-between block shadow-xl" :class="activeMessage === 1 ? 'block' : 'hidden'">
        <h5 class="h-[60px] text-lg p-3.5 border-b-2 font-semibold">To: Annie Baker</h5>
        <div class="h-[650] flex-1 p-4 border-b-2 space-y-8 overflow-y-auto custom-scrollbar">
            <div class="flex flex-col items-end">
                <div class="w-3/4 2xl:w-1/2 flex justify-end  space-x-1">
                    <div>
                        <div class="bg-blue-100 p-4 rounded-lg">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae corporis optio, perferendis soluta quos natus quasi officiis ratione ea, necessitatibus tenetur, vero eligendi quidem quo pariatur repellendus voluptatem enim. Dicta!
                        </div>
                        <div class="flex mt-0.5">
                            <span class="text-gray-400 text-sm">08:04 am</span>
                            <div class="flex items-center justify-center text-green-600 ml-1" title="Seen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1552162864-987ac51d1177?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="w-10 h-10 rounded-full">
                </div>
            </div>
            <div class="flex flex-col">
                <div class="w-3/4 2xl:w-1/2 flex space-x-1">
                    <img src="https://images.unsplash.com/photo-1552162864-987ac51d1177?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="w-10 h-10 rounded-full">
                    <div>
                        <div class="bg-blue-100 p-4 rounded-lg">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.
                        </div>
                        <div class="flex justify-end mt-0.5">
                            <span class="text-gray-400 text-sm">09:15 am</span>
                            <div class="flex items-center justify-center text-green-600 ml-1" title="Seen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-end">
                <div class="w-3/4 2xl:w-1/2 flex justify-end  space-x-1">
                    <div>
                        <div class="bg-blue-100 p-4 rounded-lg">
                            Nemo enim ipsam voluptatem quia voluptas sit
                        </div>
                        <div class="flex mt-0.5">
                            <span class="text-gray-400 text-sm">09:20 am</span>
                            <div class="flex items-center justify-center text-gray-500 ml-1" title="Sent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1552162864-987ac51d1177?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="w-10 h-10 rounded-full">
                </div>
            </div>
        </div>
        <div class="p-4">
            <textarea id="textarea_default" class="w-full h-24 mt-2 border p-2 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 rounded-lg resize-none" placeholder="Write your message here..."></textarea>
            <div class="flex items-center justify-end">
                <button class="bg-blue-600 hover:bg-blue-800 rounded-lg mt-4 px-10 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">Send</button>
            </div>
        </div>
    </div>
</div>