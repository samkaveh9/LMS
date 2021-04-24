<div class="col-4 bg-white">
    <p class="box__title">ایجاد نقش کاربری</p>
    <form action="{{ route('role-permissions.store') }}" method="post" class="padding-30">
        @csrf
        <input type="text" name="name" placeholder="نام نقش کاربری" class="text" value="{{ old('name') }}" required autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror


        <p class="box__title margin-bottom-15">انتخاب مجوز ها</p>

        @foreach ($permissions as $permission)
        <label class="ui-checkbox" style="margin-top: 16px">
            <input type="checkbox" class="sub-checkbox" name="permissions[{{ $permission->name }}]" data-id="1" value="{{ $permission->name }}"
                {{ is_array(old('permissions')) && array_key_exists($permission->name, old('permissions')) ? 'checked' : ''  }}
                >
            <span class="checkmark"></span>
            @lang($permission->name)
        </label>
        @endforeach

        <br>
        @error('permissions')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <br>

        <button class="btn btn-webamooz_net" style="margin-top: 16px">افزودن</button>
    </form>
</div>
