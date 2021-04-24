<div class="col-4 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{ route('categories.store') }}" method="post" class="padding-30">
        @csrf
        <input type="text" name="title" placeholder="نام دسته بندی" class="text" required autofocus >
        <p class="box__title margin-bottom-15">انتخاب دسته</p>
        <select name="parent_id" id="parent_id">
            <option value="">بدون دسته اصلی</option>
            @foreach (\Samkaveh\Category\Models\Category::orderBy('id','asc')->where('parent_id',null)->get() as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
        <button class="btn btn-webamooz_net">افزودن</button>
    </form>
</div>
