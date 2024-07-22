<x-app-layout>
<?php $role=Auth::user()->role_id; ?>
@if($role == '1')
@include('top_nav_bar')
@elseif($role == '2')
@include('top_nav_bar_applicant')
@elseif($role == '6')
@include('top_nav_bar_edd')
@elseif($role == '7')
@include('admin_nav_bar')
@endif
@if($role == '1')
<x-welcome />
@elseif($role == '2')
<x-welcome-entrepreneur />
@elseif($role == '3')
<x-welcome-bank />
@elseif($role == '4')
<x-welcome-acounthead />
@elseif($role == '5')
<x-welcome-associatedirector />
@elseif($role == '6')
<x-welcome-department />
@elseif($role == '7')
<x-welcome-systemadmin />
@elseif($role == '12')
<x-welcome-associatedirector />
@endif


<!-- @if($role == '1')
<x-jet-welcome />
@elseif($role == '2')
<x-jet-welcome_entrepreneur />
@elseif($role == '3')
<x-jet-welcome_bank />
@elseif($role == '4')
<x-jet-welcome_acounthead />
@elseif($role == '5')
<x-jet-welcome_associatedirector />
@elseif($role == '6')
<x-jet-welcome_department />
@elseif($role == '7')
<x-jet-welcome_systemadmin />
@elseif($role == '12')
<x-jet-welcome_associatedirector />
@endif -->


</x-app-layout>





