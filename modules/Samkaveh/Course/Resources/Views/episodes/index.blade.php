<div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
            <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0">
                <p class="mlg-15">{{ $course->title }}</p>
                <a class="color-2b4a83" href="{{ route('episodes.create',$course->slug) }}">آپلود جلسه جدید</a>
            </div>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>عنوان جلسه</th>
                        <th>عنوان فصل</th>
                        <th>مدت زمان جلسه</th>
                        <th>وضعیت تایید</th>
                        <th>سطح دسترسی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->episodes as $episode)
                        <tr role="row" class="" data-row-id="{{ $episode->id }}">
                            <td><a href="">{{ $episode->id }}</a></td>
                            <td><a href="">{{ $episode->title }}</a></td>
                            <td>{{ $episode->season->title }}</td>
                            <td>{{ $episode->time }} دقیقه</td>
                            <td class="confirmation_status">@lang($episode->confirmation_status)</td>
                            <td class="status">@lang($episode->status)</td>
                            <td>
                                @can(Samkaveh\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSES) 
                                    
                                <a href="" class="item-delete mlg-15" data-id="{{ $episode->id }}"
                                    onclick="deleteItem(event,'{{ route('episodes.destroy',[$course->slug ,$episode->slug]) }}')"
                                   title="حذف"></a>
                                   
                                @if ($episode->status == \Samkaveh\Course\Models\Episode::STATUS_LOCKED)
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('episodes.unlock', $episode->slug) }}',
                                    'آیا از باز کردن این آیتم اطمینان دارید؟' , 'باز شده', 'status')"
                                    class="item-lock mlg-15" title="باز کردن">
                                </a>
                                @elseif ($episode->status == \Samkaveh\Course\Models\Episode::STATUS_OPENED)
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('episodes.lock', $episode->slug) }}',
                                    'آیا از قفل کردن این آیتم اطمینان دارید؟' , 'قفل شده', 'status')"
                                    class="item-lock mlg-15" title="قفل کردن">
                                </a>
                                @endif 
                                
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('episodes.accept', $episode->slug) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                                    class="item-confirm mlg-15" title="تایید">
                                </a>
                               
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('episodes.reject', $episode->slug) }}',
                                    'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                                    class="item-reject mlg-15" title="رد">
                                </a>
                                
                                @endcan
                                <a href="{{ route('episodes.edit', [$course->slug ,$episode->slug]) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

