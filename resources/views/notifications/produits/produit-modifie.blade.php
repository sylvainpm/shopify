@component('mail::message')
# Du nouveau sur Shopify

Un nouveau produit vient d'etre ajouté sur votre plateforme shopify.
n'hésitez pas à le consulter en cliquant sur le bouton ci-dessous:


@component('mail::button', ['url' => ''])
Voir le produit
@endcomponent

Merci d'avoir choisi shopify ,<br>
{{ config('app.name') }}
@endcomponent
