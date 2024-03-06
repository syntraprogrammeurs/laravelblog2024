<x-mail::message>
<h1>Message from website:</h1>
<x-mail::panel>
Name:{{request()->name}}
E-mail:{{request()->email}}
Message:{{request()->message}}
</x-mail::panel>
<x-mail::button :url="'http://localhost/laravelblog2024/public'" color="success">
Visit our site
</x-mail::button>
See ya!,<br>
{{ config('app.name') }}
</x-mail::message>
