<div class="bg-blue w-full h-screen font-sans">
    <div class="flex p-2 bg-blue-dark">
        <div class="mx-0 justify-start">
            <h1 class="text-blue-lighter text-xl flex items-center font-sans italic">
                <svg class="fill-current h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M41 4H9C6.24 4 4 6.24 4 9v32c0 2.76 2.24 5 5 5h32c2.76 0 5-2.24 5-5V9c0-2.76-2.24-5-5-5zM21 36c0 1.1-.9 2-2 2h-7c-1.1 0-2-.9-2-2V12c0-1.1.9-2 2-2h7c1.1 0 2 .9 2 2v24zm19-12c0 1.1-.9 2-2 2h-7c-1.1 0-2-.9-2-2V12c0-1.1.9-2 2-2h7c1.1 0 2 .9 2 2v12z"/></svg>
                    Трелло
            </h1>
        </div>
        @if ($addGroupState)
            <div class="ml-auto">
                <form wire:submit.prevent='save'>
                    <input wire:model.defer='title' type='text' class="apperance-none rounded-none block relative bg-blue-light rounded p-2 w-full">
                </form>
            </div>
        @else
            
            <div class="flex items-center ml-auto">
                <button class="bg-blue-light rounded h-8 font-bold text-white text-sm mr-2" wire:click="addGroup" >Добавить</button>
            </div>
        @endif
        
    </div>
    <div class="flex m-4 justify-between">
        <div class="flex">
            <h3 class="text-white mr-4">Карточки</h3>
        </div>
    </div>
    <div wire:sortable="sorting" wire:sortable-group="sorting" wire:sortable.options="{ animation: 50 }" class="flex px-4 pb-8 items-start overflow-x-scroll">
        @foreach ($groups as $group)
            <div wire:key="group-{{ $group->id }}" wire:sortable.item="{{ $group->id }}" class="rounded bg-grey-light  flex-no-shrink w-64 p-2 mr-3">
                <div wire:sortable.handle class="flex justify-between py-1">
                    <h3 class="text-sm">{{$group->title}}</h3>

                    <a class="h-1 inline-flex text-red cursor-pointer" wire:click="deleteGroup({{ $group->id}})">X</a>
                </div>
                <div class="text-sm mt-2">
                    <div wire:sortable-group.item-group="{{ $group->id }}" wire:sortable-group.options="{ animation: 100 }">
                        @foreach ($group->cards as $card)
                            <div wire:sortable-group.item="{{ $card->id }}" wire:key="card-{{ $card->id }}" wire:sortable-group.handle class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer flex justify-between">
                                <span>{{$card->title}}</span>
                                
                                <a class="inline-flex text-red cursor-pointer" wire:click="deleteCard({{ $card->id}})">x</a>
                            </div>
                            
                        @endforeach
                    </div>
                    
                    @if ($addCardState == $group->id)
                        <form wire:submit.prevent='save'>
                            <input wire:model.defer='title' type='text' class="apperance-none rounded-none block relative bg-light rounded p-2 w-full">
                        </form>
                    @else
                        <p class="mt-3 text-grey-dark" wire:click="addCard({{ $group->id}})">
                            Add a card...
                        </p>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
</div>
