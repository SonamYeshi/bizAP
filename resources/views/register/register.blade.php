<x-app-layout>
    <x-jet-authentication-card>  

@include('flash-message')
        <x-jet-validation-errors class="mb-4" />
<img class="img-responsive" src="{{URL::asset('/bizap.png')}}"style="height:50px;width:100px; "></img>
        <form method="POST" action="{{ route('add_user') }}">
            @csrf
<p style="color: #2b5281;text-align: center;">Register</p>

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                          @if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                          @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
            </div>

             <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select onchange="checkOptions(this)" id="role" class="form-select rounded-md shadow-sm mt-1 block w-full" name="role" :value="old('role')" required="required">
                   <option value="">Choose...</option>
                   @foreach($roles as $roles)
                   <option value="{{$roles->id}}">{{$roles->role_name}}</option>
                   @endforeach
                </select>
                        @if ($errors->has('role'))
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                        @endif
            </div>



            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
            </div>

            
            <div class="flex items-center justify-end mt-4">
 <x-jet-button style="background-color:gray;"><a href="{{ route('dashboard') }}">back</a></x-jet-button>
                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
<script type="text/javascript">
    var school;
function checkOptions(select) {
  school = document.getElementById('school');
  if (select.options[select.selectedIndex].value != "6") {
    school.style.display = 'block';
    
  }
  else {
    school.style.display = 'none';
  }
}
</script>