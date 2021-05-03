<form action="{{ route('users.profilePhoto') }}" method="post" enctype="multipart/form-data">
<div class="profile__info border cursor-pointer text-center">
    @csrf
    <div class="avatar__img"><img src="{{ auth()->user()->thumb }}" class="avatar___img">
        <input type="file" accept="image/*" class="hidden avatar-img__input"
        name="photo" onchange="this.form.submit()"
        >
        <div class="v-dialog__container" style="display: block;"></div>
        <div class="box__camera default__avatar"></div>
    </div>  
    <span class="profile__name" style="font-size: 0.83em; margin-top: 16px;">کاربر : {{ auth()->user()->name }}</span>
</div>
</form>