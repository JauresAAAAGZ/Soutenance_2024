@component('mail::message')
# New Depot Created

A new depot has been created.

Here are the details:
- Depot Nom: {{ $depot->nomDepot }}
- Description: {{ $depot->description }}
- Date Fermeture: {{$depot->dateFermeture}}

Thank you,<br>
{{ config('app.name') }}
@endcomponent
