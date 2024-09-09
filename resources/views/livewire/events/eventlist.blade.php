<?php

use App\Models\Event;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    public $search;
    public $success;
    public $error;

    use WithPagination;

    public function register(Event $event)
    {
        if($event->users->count() == $event->attendee_limit){
            $this->error = "attendee limit was reached";
            return;
        }

        if($event->date_and_time < now()){
            $this->error = "deadline was passed";
            return;
        }
        
        auth()->user()->user_events()->attach($event->id);
        $this->success = true;
       
    }

    public function with(): array
    {
        return [
            'events' => Event::search($this->search)->orderBy('created_at', 'DESC')->paginate()
        ];
    }
}; ?>

<div class="">
    <div class="mb-6">
        <label for="success" class="block mb-2 text-sm font-medium text-black">Search</label>
        <input wire:model.live.debounce.500ms='search' type="text" maxlength="40" class="max-w-80 border border-gray-500 text-black  placeholder-black text-sm rounded-lg  block w-full p-2.5 " placeholder="Search">
      </div>

        @if ($success)
              <div class="p-4 my-8 text-sm text-green-800 rounded-lg bg-green-50 " role="alert">
                <span class="font-medium">Success!</span> You reserved for this event
              </div>
        @endif

        @if ($error)
          <div class="p-4 my-8 text-sm text-red-800 rounded-lg bg-red-50 " role="alert">
            <span class="font-medium">error!</span> {{ $error }}
          </div>
        @endif

    @foreach ($events as $event)
      <div>
            <div class="border-b border-black mb-6">
                <h2 class="text-3xl text-bold mb-2">{{ $event->title }}</h2>
                <small> {{ Carbon\Carbon::parse($event->date_and_time)->format('Y-m-d h:i:s a') }}</small> 
                <br/>
                <small>location: {{ $event->location }}</small>
                <p class="my-2">{{ $event->description  }}</p>
                @if (in_array(auth()->user()->id, $event->users->pluck('id')->toArray()))
                    <button disabled class="bg-gray-500 p-2 mb-2 text-white rounded-md mb-4">Already registered</button>
                @else
                    <button 
                    wire:click='register({{$event}})'
                    class="bg-blue-500 p-2 mb-2 text-white rounded-md hover:bg-blue-400 hover:shadow-md mb-4"
                    > Register for {{ $event->price }}$ 
                    </button>
                @endif
                
            </div>
      </div>
       
    @endforeach

    <div>
        {{ $events->links() }}
    </div>
</div>
