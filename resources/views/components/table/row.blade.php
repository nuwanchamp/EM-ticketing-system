@props(['isNew' => false])

<tr class="odd:dark:bg-zinc-700 cursor-pointer {{$isNew ? 'bg-secondary! new' : ''}}" {{$attributes}}>
    {{ $slot }}
</tr>
