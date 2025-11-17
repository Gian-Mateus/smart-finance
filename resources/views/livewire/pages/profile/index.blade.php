<div>
    <div class="flex gap-4 mt-4">
        <img src="https://picsum.photos/200/300" alt="" class="rounded-full max-w-sm max-h-sm h-24 w-24 ">
        <h1 class="font-bold text-2xl flex items-center">{{ $name }}</h1>
    </div>
    <x-menu-separator />
    <div>
        <div class="flex flex-col">
            <div x-data="{ isEditing: false, originalName: @js($name) }">      
                <x-input 
                    label="Nome" 
                    x-bind:disabled="!isEditing"
                    wire:model="name"
                    class="disabled:text-base-content cursor-default w-min"
                >
                    <x-slot:append>
                        <div class="flex join-item">
                            <x-button 
                                icon="o-pencil" 
                                x-show="!isEditing" 
                                @click="isEditing = true"
                                class="btn-secondary"
                            />
                            <x-button 
                                icon="o-check" 
                                x-show="isEditing"
                                class="btn-success"
                                wire:click="updateName"
                                @click="isEditing = false"
                            />
                            <x-button 
                                icon="o-x-mark" 
                                x-show="isEditing" 
                                @click="isEditing = false; $wire.set('name', originalName)"
                                class="btn-error"
                            />
                        </div>
                    </x-slot:append>
                </x-input>
            </div>
            
            <div x-data="{ isEditing: false, originalEmail: @js($email) }">    
                <x-input 
                    label="E-mail" 
                    x-bind:disabled="!isEditing"
                    wire:model="email"
                    class="disabled:text-base-content cursor-default w-min"
                >
                    <x-slot:append>
                        <div class="flex join-item">
                            <x-button 
                                icon="o-pencil" 
                                x-show="!isEditing" 
                                @click="isEditing = true"
                                class="btn-secondary"
                            />
                            <x-button 
                                icon="o-check" 
                                x-show="isEditing"
                                class="btn-success"
                                wire:click="updateEmail"
                                @click="isEditing = false"
                            />
                            <x-button 
                                icon="o-x-mark" 
                                x-show="isEditing" 
                                @click="isEditing = false; $wire.set('email', originalEmail)"
                                class="btn-error"
                            />
                        </div>
                    </x-slot:append>
                </x-input>
            </div>
        </div>
        
        <div class="mt-10">
            <x-button label="Redefinir senha" class="btn-primary" icon="o-key"/>
        </div>
    </div>
</div>
