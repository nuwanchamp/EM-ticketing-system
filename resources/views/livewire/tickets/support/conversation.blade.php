<div class="relative"
    data-test-id="conversation-box"
     x-data="{
        scrollToBottom: function(){
            this.$nextTick(()=>{
                this.$refs.conversationContainer.scrollTop = this.$refs.conversationContainer.scrollHeight;
            });
        }
    }"
     x-init="scrollToBottom()"
     @message-sent.window="scrollToBottom()"
     xmlns:flux="http://www.w3.org/1999/html">
    <div x-ref="conversationContainer" class="max-h-[60vh] overflow-auto pb-14 scroll-smooth">
        @if($messages)
            @foreach($messages as $message)
                <x-chat-item context="{{$message->content}}" type="{{$message->sender_type}}"/>
            @endforeach
        @endif
    </div>
    <div class="flex gap-2 py-2 px-3 absolute bg-zinc-800 bottom-0 left-0 right-0 w-full ">
        <flux:textarea rows="auto" wire:model="messageContent"/>
        <flux:button wire:click="sendMessage">Send</flux:button>
    </div>
</div>
