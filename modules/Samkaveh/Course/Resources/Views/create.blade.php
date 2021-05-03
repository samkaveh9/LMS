@extends('Dashboard::layouts.master')
@section('app')
    <p class="box__title">ایجاد دوره جدید</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{ route('courses.store') }}" method="POST" class="padding-30" enctype="multipart/form-data">
                @csrf
                <x-input type="text" name="title" placeholder="عنوان دوره" required />
    
                <div class="d-flex multi-text">
                    <x-input type="text" name="priority" class="text-left mlg-15" placeholder="ردیف دوره" required />
                    <x-input type="text" name="price" placeholder="مبلغ دوره" class="text-left mlg-15" required />
                    <x-input type="text" name="percent" placeholder="درصد مدرس" class="text-left" required />
                </div>
    
                <x-select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </x-select>
    
                <ul class="tags">
                    <li class="tagAdd taglist">
                        <x-input type="text" name="tags" id="search-field" class="mt-0" placeholder="برچسب ها" />
                    </li>
                </ul>
                
                <x-select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach (\Samkaveh\Course\Models\Course::$types as $type)
                    <option value="{{ $type }}">@lang($type)</option>
                    @endforeach
                </x-select>
    
                <x-select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach (\Samkaveh\Course\Models\Course::$statuses as $status)
                    <option value="{{ $status }}">@lang($status)</option>
                    @endforeach
                </x-select>
    
                <x-select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach (\Samkaveh\Category\Repository\CategoryRepository::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </x-select>
                
                <x-file-upload name="banner" placeholder="آپلود بنر دوره" />
    
                <x-textarea name="body" placeholder="توضیحات دوره" />
                
                <button type="submit" class="btn btn-webamooz_net">ایجاد دوره</button>
                <a href="{{ route('courses.index') }}" class="btn btn-github" style="float: left;color: white">انصراف</a>
            </form>
        </div>
    </div>
@endsection
@push('breadcrumb')
<li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li><li><a href="#" title="ایجاد دوره">ایجاد دوره</a></li>
@endpush

@push('styles')
@endpush

@push('scripts')
<script src="/panel/js/tagsInput.js"></script>
@endpush
