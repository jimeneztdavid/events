<?php

use Livewire\Volt\Component;

new class extends Component {
    public $title;
    public $location;
    public $price;
    public $attendeeLimit;
    public $description;
    public $dateAndTime;
    public $success;

    public function save(){
      $this->validate([
        'title'         => 'required|max:100',
        'location'      => 'required|max:100',
        'price'         => 'required|numeric',
        'attendeeLimit' => 'required|numeric',
        'description'   => 'required|max:260',
        'dateAndTime'   => 'required'
      ]);

      auth()->user()->events()->create([
        'title'         => $this->title,
        'location'      => $this->location,
        'price'         => $this->price,
        'attendee_limit' => $this->attendeeLimit,
        'date_and_time'   => $this->dateAndTime,
        'description' => $this->description
      ]);

     $this->reset(); 

     $this->success = true;
    }
}; ?>

<div class="flex justify-center"> 
    <form action="" class="w-80" wire:submit="save">      
      <p class="text-xl my-6">
        store a new event
      </p>
        <label class="block mb-2 text-sm font-medium text-black">Title</label>
        <input
          wire:model.live.debounce.500ms='title'
          placeholder="title"
          type="text"
          maxlength="40"
          class="border border-gray-500 text-black  placeholder-gray-400 text-sm rounded-lg block w-full p-2.5 mb-2mb-2">
          @error('title')
              <small class="text-red-400 text-bold mb-4">{{$message}}</small>
          @enderror

        <label class="block mb-2 text-sm font-medium text-black">Location</label>
          <input
          wire:model.live.debounce.500ms='location'
          placeholder="location"
          type="text"
          maxlength="40"
          class="border border-gray-500 text-black  placeholder-gray-400 text-sm rounded-lg block w-full p-2.5 mb-2">
          @error('location')
              <small class="text-red-400 text-bold mb-4">{{$message}}</small>
          @enderror


          <label class="block mb-2 text-sm font-medium text-black">Price</label>
          <input
          wire:model.live.debounce.500ms='price'
          placeholder="price"
          type="number"
          maxlength="40"
          class="border border-gray-500 text-black  placeholder-gray-400 text-sm rounded-lg block w-full p-2.5 mb-2">

          @error('price')
              <small class="text-red-400 text-bold mb-4">{{$message}}</small>
          @enderror

          <label class="block mb-2 text-sm font-medium text-black">Attendee limit</label>
          <input
          wire:model.live.debounce.500ms='attendeeLimit'
          placeholder="attendeeLimit"
          type="text"
          maxlength="40"
          class="border border-gray-500 text-black  placeholder-gray-400 text-sm rounded-lg block w-full p-2.5 mb-2">
          @error('attendeeLimit')
              <small class="text-red-400 text-bold mb-4">{{$message}}</small>
          @enderror

          <label class="block mb-2 text-sm font-medium text-black">Description</label>
         <textarea
            wire:model="description"
            class="border border-gray-500 text-black text-sm rounded-lg block w-full p-2.5 mb-2"></textarea>

          @error('description')
              <small class="text-red-400 text-bold mb-4">{{$message}}</small>
          @enderror

          <input
            wire:model="dateAndTime"
            class="border border-gray-500 text-black text-sm rounded-lg block w-full p-2.5 mb-2"
            type="datetime-local"
            value="2024-09-11T12:00"
            min="2024-01-01T00:00"
            max="2024-12-31T00:00"
          />

          @error('dateAndTime')
              <small class="text-red-400 text-bold mb-4">{{$message}}</small>
          @enderror

          @if ($success == true)
              <div class="p-4 my-8 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">Success!</span> You created a new event
              </div>
          @endif

          <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 p-2 mb-2 text-white rounded-md hover:bg-blue-400 hover:shadow-md mb-4"> 
            submit  </button>
          </div>
          

    
        </form>
</div>
