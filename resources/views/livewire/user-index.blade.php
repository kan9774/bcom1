<div>
    <x-mary-header title="{{__('Users')}}" subtitle="{{__('Check for users')}}">
        <x-slot:middle class="!justify-end xl:w-1/3">
            <x-mary-input icon="o-bolt" wire:model.live="search" placeholder="Search..."/>
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModal()"/>
        </x-slot:actions>
    </x-mary-header>
    @if($users->count())
        <x-mary-table :headers="$headers" :rows="$users" :sort-by="$sortBy" striped with-pagination>
            @scope('header_name', $header)
            {{ $header['label'] }}
            @endscope
            @scope('header_email', $header)
            {{ $header['label'] }}
            @endscope
            @scope('header_rol', $header)
            {{ $header['label'] }}
            @endscope
            @scope('actions', $user)
            <x-mary-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm bg-red-400"/>
            @endscope
        </x-mary-table>
    @else
        <div role="alert" class="alert alert-error">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>No hay registros!.</span>
        </div>
    @endif
    <x-mary-modal wire:model="usersModal" title="Crear..." subtitle="Crear nuevo usuaraio" separator>
        <x-mary-form wire:submit="save">
            <x-mary-input label="{{__('Name')}}" wire:model="form.name"/>
            <x-mary-input label="{{__('Email')}}" wire:model="form.email"/>
            <x-mary-password label="{{__('Password')}}" hint="No compartas la contraseña" wire:model="form.password"
                             clearable/>
            <x-mary-password label="{{__('Confirm Password')}}" hint="No compartas la contraseña"
                             wire:model="form.password_confirmation" clearable/>

            <x-mary-select label="Roles" icon="o-key" :options="$role" wire:model="form.role" option-value="id"
                           option-label="name" placeholder="Selecciona un rol"/>
            <x-slot:actions>
                <x-mary-button label="{{__('Cancel')}}" @click="$wire.usersModal=false"/>
                <x-mary-button label="{{__('Save')}}" class="btn-primary" type="submit" spinner="save"/>
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
